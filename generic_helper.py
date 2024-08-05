import re
import db_helper


def extract_session_id(session_str: str):
    match = re.search(r"/sessions/(.*?)/contexts/", session_str)
    if match:
        extracted_string = match.group(1)
        return extracted_string

    return ""

def get_str_from_product_dict(food_dict: dict):
    return ", ".join([f"{int(value)} {key}" for key, value in food_dict.items()])

# def get_str_from_product_dict(product_dict):
#     product_list = []
#     for product_id, quantity in product_dict.items():
#         product_details = db_helper.get_product_details(product_id)
#         if product_details:
#             product_name, _, product_price = product_details
#             product_list.append(f"{quantity} x {product_name} at ${product_price}")
#
#     return ", ".join(product_list)


if __name__=="__main__":
    print(get_str_from_food_dict({"samosa": 2, "chole": 5}))
    #print(extract_session_id("projects/clover-chatbot-for-food-d-bruf/agent/sessions/8586b9ba-d622-66a5-d06f-b1d9c6047253/contexts/ongoing-order"))