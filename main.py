import re
from fastapi import FastAPI, Request
from fastapi.responses import JSONResponse
from datetime import datetime
import db_helper
import generic_helper

app = FastAPI()

inprogress_orders = {}
session_user_ids = {}  # Khai báo biến để lưu trữ user_id theo session_id

@app.post("/")
async def handle_request(request: Request):
    payload = await request.json()

    intent = payload['queryResult']['intent']['displayName']
    parameters = payload['queryResult']['parameters']
    output_contexts = payload['queryResult']['outputContexts']

    # Kiểm tra output_contexts trước khi truy cập
    if not output_contexts:
        return JSONResponse(content={
            "fulfillmentText": "Error: No output contexts found."
        })

    session_id = generic_helper.extract_session_id(output_contexts[0]['name'])

    intent_handler_dict = {
        'new.order': start_new_order,
        'get.user - context:ongoing-order': get_user_name,
        'order.add - context: ongoing-order': lambda params, sid: add_to_order(params, sid, session_user_ids.get(sid)),
        'order.remove - context: ongoing-order': lambda params, sid: remove_from_order(params, sid),
        'order.complete - context: ongoing.order': lambda params, sid: complete_order(params, sid, session_user_ids.get(sid)),
        'track.order - context: ongoing-tracking': track_order
    }

    handler = intent_handler_dict.get(intent)
    if handler:
        return await handler(parameters, session_id)
    else:
        return JSONResponse(content={
            "fulfillmentText": "Error: Intent handler not found."
        })



def save_to_db(order: dict, user_id: int):
    next_order_id = db_helper.get_next_order_id()

    for product_id, quantity in order.items():
        # Lấy thông tin sản phẩm từ bảng products
        product_details = db_helper.get_product_details(product_id)

        if product_details:
            product_name, product_image, product_price = product_details

            rcode = db_helper.insert_order_item(
                next_order_id,
                product_id,
                product_name,
                product_image,
                product_price,
                quantity,
                user_id,
                None  # Để order_date tự động được thiết lập với current_timestamp()
            )


            if rcode == -1:
                return -1

    return next_order_id



def remove_from_order(parameters: dict, session_id: str):
    if session_id not in inprogress_orders:
        return JSONResponse(content={
            "fulfillmentText": "I'm having trouble finding your order. Sorry! Can you place a new order?"
        })

    current_order = inprogress_orders[session_id]
    food_items = parameters.get("food-item", [])

    removed_items = []
    no_such_items = []

    for item in food_items:
        if item not in current_order:
            no_such_items.append(item)
        else:
            removed_items.append(item)
            del current_order[item]

    if removed_items:
        fulfillment_text = f'Removed {", ".join(removed_items)} from your order!'
    else:
        fulfillment_text = ''

    if no_such_items:
        fulfillment_text += f' Your current order does not have {", ".join(no_such_items)}.'

    if not current_order:
        fulfillment_text += " Your order is empty!"
    else:
        order_str = generic_helper.get_str_from_product_dict(current_order)
        fulfillment_text += f" Here is what is left in your order: {order_str}"

    return JSONResponse(content={
        "fulfillmentText": fulfillment_text
    })


async def add_to_order(parameters: dict, session_id: str, user_id: int):
    # Lấy danh sách các món ăn và số lượng từ tham số
    food_items = parameters.get("food-item", [])
    quantities = parameters.get("number", [])

    # Kiểm tra xem danh sách món ăn và số lượng có cùng chiều dài không
    if len(food_items) != len(quantities):
        fulfillment_text = "Sorry, I didn't understand. Can you please specify products and quantity?"
    else:
        # Tạo từ điển các món ăn và số lượng
        new_product_dict = dict(zip(food_items, quantities))

        # Cập nhật đơn hàng
        if session_id in inprogress_orders:
            current_product_dict = inprogress_orders[session_id]
            current_product_dict.update(new_product_dict)
            inprogress_orders[session_id] = current_product_dict
        else:
            inprogress_orders[session_id] = new_product_dict

        # Tạo chuỗi mô tả đơn hàng hiện tại
        order_str = generic_helper.get_str_from_product_dict(inprogress_orders[session_id])
        fulfillment_text = f"So far you have: {order_str}. Do you need anything else?"

    return JSONResponse(content={
        "fulfillmentText": fulfillment_text
    })


async def complete_order(parameters: dict, session_id: str, user_id: int):
    # Kiểm tra xem đơn hàng có tồn tại không
    if session_id not in inprogress_orders:
        return JSONResponse(content={
            "fulfillmentText": "I'm having trouble finding your order. Sorry! Can you place a new order?"
        })
    else:
        # Lấy đơn hàng từ session
        order = inprogress_orders[session_id]

        # Lưu đơn hàng vào cơ sở dữ liệu và nhận ID đơn hàng
        order_id = save_to_db(order, user_id)



        # Xử lý lỗi khi lưu đơn hàng
        if order_id == -1:
            fulfillment_text = "Sorry, I couldn't process your order due to a backend error. Please place a new order again."
        else:
            # Lấy tổng giá trị đơn hàng từ cơ sở dữ liệu
            order_total = db_helper.get_total_order_price(order_id)
            fulfillment_text = f"Awesome. We have placed your order. Here is your order id # {order_id}. Your order total is {order_total} which you can pay at the time of delivery!"

        # Xóa đơn hàng khỏi session
        del inprogress_orders[session_id]

    return JSONResponse(content={
        "fulfillmentText": fulfillment_text
    })




async def track_order(parameters: dict, session_id: str):
    order_id = int(parameters.get('order_id', 0))
    order_status = db_helper.get_order_status(order_id)

    if order_status:
        fulfillment_text = f"The order status for order id: {order_id} is: {order_status}"
    else:
        fulfillment_text = f"No order found with order id: {order_id}"

    return JSONResponse(content={
        "fulfillmentText": fulfillment_text
    })


async def start_new_order(parameters: dict, session_id: str):
    return JSONResponse(content={
        "fulfillmentText": "Great! To start your order, please tell me your name."
    })


async def get_user_name(parameters: dict, session_id: str):
    # Kiểm tra xem tham số 'person' có tồn tại và không rỗng không
    if "person" in parameters and len(parameters["person"]) > 0:
        # Lấy tên người dùng từ tham số 'person'
        user_name = parameters["person"][0]["name"]

        if user_name:
            # Gọi hàm để lấy user_id từ cơ sở dữ liệu
            user_id = db_helper.get_user_id_from_db(user_name)
            if user_id:
                # Lưu user_id vào session_user_ids
                session_user_ids[session_id] = user_id
                return JSONResponse(content={
                    "fulfillmentText": f"Thanks, {user_name}! Your user ID has been saved. You can now add items to your order."
                })
            else:
                return JSONResponse(content={
                    "fulfillmentText": "Sorry, I couldn't find your user ID. Please try again with a different name."
                })
        else:
            return JSONResponse(content={
                "fulfillmentText": "I didn't catch your name. Can you please provide it?"
            })
    else:
        return JSONResponse(content={
            "fulfillmentText": "I didn't catch your name. Can you please provide it?"
        })
