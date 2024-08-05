import mysql.connector
global cnx
cnx = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',
        database='php_project'
)






def get_total_order_price(order_id: int):
    cursor = cnx.cursor()

    # Thực thi truy vấn SQL để tính tổng giá trị đơn hàng
    query = """
    SELECT SUM(product_price * product_quantity) 
    FROM order_items 
    WHERE order_id = %s
    """
    cursor.execute(query, (order_id,))

    # Lấy kết quả từ truy vấn
    result = cursor.fetchone()[0]

    cursor.close()

    # Trả về tổng giá trị đơn hàng
    if result is None:
        return 0  # Trường hợp đơn hàng không có sản phẩm nào
    else:
        return result


def get_next_order_id():
    cursor = cnx.cursor()

    #Executing the SQL query to get the next available order_id
    query = "SELECT MAX(order_id) FROM orders"
    cursor.execute(query)

    #Fetching the result
    result = cursor.fetchone()[0]

    #Closing the cursor
    cursor.close()

    #Returning the next available order_id
    if result is None:
        return 1
    else:
        return result + 1


def insert_order_tracking(order_id, status):
    cursor = cnx.cursor()

    insert_query = "INSERT INTO orders (order_id, order_status) VALUES (%s, %s)"
    cursor.execute(insert_query, (order_id, status))

    cnx.commit()
    cursor.close()

def get_order_status(order_id: int):
    # Create a cursor object
    cursor = cnx.cursor()

    # Write the SQL query
    query = ("SELECT order_status FROM orders WHERE order_id = %s")

    # Execute the query
    cursor.execute(query, (order_id,))

    # Fetch the result
    result = cursor.fetchone()

    # Close the cursor and connection
    cursor.close()


    if result is not None:
        return result[0]
    else:
        return None

def get_product_details(product_id: int):
    cursor = cnx.cursor()
    query = "SELECT product_name, product_image, product_price FROM products WHERE product_id = %s"
    cursor.execute(query, (product_id,))
    result = cursor.fetchone()
    if result:
        return result
    else:
        return None


def insert_order_item(order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date=None):
    cursor = cnx.cursor()
    query = """
    INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
    """
    values = (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
    try:
        cursor.execute(query, values)
        cnx.commit()
        print(f"Successfully inserted: {values}")
        return 0
    except Exception as e:
        print(f"Error inserting order item: {e}")
        return -1
    finally:
        cursor.close()




def get_user_id_from_db(user_name: str):
    cursor = cnx.cursor()
    query = "SELECT user_id FROM users WHERE user_name = %s"
    cursor.execute(query, (user_name,))
    result = cursor.fetchone()
    cursor.close()
    return result[0] if result else None




