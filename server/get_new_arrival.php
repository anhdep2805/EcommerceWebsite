<?php

include('connection.php');

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='new' LIMIT 10");

$stmt->execute();

$new_products = $stmt->get_result();








?>