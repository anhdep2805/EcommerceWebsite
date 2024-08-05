<?php
include_once "../config/dbconnect.php";

if(isset($_POST['upload']))
{
    $ProductName = $_POST['product_name'];
    $desc = $_POST['product_description'];
    $price = $_POST['product_price'];
    $category = $_POST['product_category'];
    
    $name = $_FILES['product_image']['name'];
    $temp = $_FILES['product_image']['tmp_name'];
    
    // Đường dẫn lưu trữ hình ảnh
    $location = "../img/products/";
    $finalImage = $location . $name;

    // Di chuyển file ảnh từ temporary location đến thư mục đích
    move_uploaded_file($temp, $finalImage);

    // Thực hiện câu lệnh INSERT với dữ liệu từ form
    $insert = mysqli_query($conn, "INSERT INTO products
    (product_name, product_image, product_price, product_description, product_category) 
    VALUES ('$ProductName', '$finalImage', $price, '$desc', '$category')");

    if(!$insert)
    {
        echo mysqli_error($conn);
    }
    else
    {
        echo "Records added successfully.";
    }
}
?>
