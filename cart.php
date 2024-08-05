<?php

session_start();

if(isset($_POST['add_to_cart'])){

    //if user has already added a product to cart
    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'],"product_id");
        //if product has already been added to cart or not
        if(!in_array($_POST['product_id'], $products_array_ids) ){

            $product_id = $_POST['product_id'];

            $product_array = array(
                                'product_id' => $_POST['product_id'],
                                'product_name' => $_POST['product_name'],
                                'product_price' => $_POST['product_price'],
                                'product_image' => $_POST['product_image'],
                                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;


            //product has already been added
        }else{
            echo '<script>alert("Product was already added to cart")</script>';
            

        }




        //if this is the first product
    }else{

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
                            'product_id' => $product_id,
                            'product_name' => $product_name,
                            'product_price' => $product_price,
                            'product_image' => $product_image,
                            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;

    }


    //calculate total
    calculateTotalCart();

//remove product from cart
}else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculate total
    calculateTotalCart();


}else if( isset($_POST['edit_quantity']) ){
    //we get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back its place
    $_SESSION['cart'][$product_id] = $product_array;

    //calculate total
    calculateTotalCart();


}else{
    //header('location: index.php');
}




function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}



?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width", initial-scale="1.0">
        <title>Ecommerce website</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <section id="header">
            <a href="#"><img src="img/logo.png" class="logo" alt=""></a>


            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li id="lg-bag"><a class="active" href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li id="lg-user"><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                    <!-- <a href="#" id="close"><i class="far fa-times"></i></a> -->
                </ul>
            </div>
        </section>

        <section id="page-header" class="about-header">
            
            <h2>#YOUR BILL</h2>
            
            <p>Remember to apply our coupon to save up your money!</p>
            
        </section>  

        <section id="cart" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Remove</td>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($_SESSION['cart'] as $key => $value){ ?>

                    <tr>
                        <form method="POST" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"> 
                                <td><input type="submit" name="remove_product" value="remove"></td>
                        </form>
                        
                        <td><img src="img/products/<?php echo $value['product_image']; ?>" alt=""></td>
                        <td><?php echo $value['product_name']; ?></td>
                        <td>$<?php echo $value['product_price']; ?></td>
                        <td>
                            
                            <form method="POST" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                                <input type="submit" value="edit" name="edit_quantity"/>
                            </form>
                        </td>
                        <td><?php echo $value['product_quantity'] * $value['product_price']; ?></td>
                    </tr>
                    

                    <?php } ?>
                </tbody>
            </table>
        </section>
        
        <section id="cart-add" class="section-p1">
            <div id="coupon">
                <h3>Apply Coupon</h3>
                <div>
                    <input type="text" placeholder="Enter Your Coupon">
                    <button class="normal">Apply</button>
                </div>
            </div>

            <div id="subtotal">
                <h3>Cart Totals</h3>
                <table>
                    <!-- <tr>
                        <td>Cart subtotal</td>
                        <td>$8</td>
                    </tr> -->
                    <tr>
                        <td>Shipping</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>$ <?php echo $_SESSION['total']; ?></strong></td>
                    </tr>
                </table>

                <form method="POST" action="checkout.php">
                        <input type="submit" class="btn" value="Checkout" name="checkout">
                </form>
                
            </div>
        </section>

        <footer class="section-p1">
            <div class="col">
                <img class="logo" src="img/logo.png" alt="">
                <h4>Contact</h4>
                <p><strong>Address: </strong>97 Man thien, Thu Duc, Ho Chi Minh</p>
                <p><strong>Phone: </strong>(+81) 857700502</p>
                <p><strong>Hours: </strong>10:00 - 18:00, Mon - Sat</p>
                <div class="follow">
                    <h4>Follow Us</h4>
                    <div class="icon">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-pinterest-p"></i>
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <h4>About</h4>
                <a href="#">About us</a>
                <a href="#">Delivery Information</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Contact us</a>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <a href="#">Sign In</a>
                <a href="#">View Cart</a>
                <a href="#">My Wishlist</a>
                <a href="#">Track My Orders</a>
                <a href="#">Help</a>
            </div>

            <div class="col install">
                <h4>Install App</h4>
                <p>From App store or Google Play</p>
                <div class="row">
                    <img src="img/pay/app.jpg" alt="">
                    <img src="img/pay/play.jpg" alt="">
                </div>
                <p>Secured Payment Gateways</p>
                <img src="img/pay/pay.png" alt="">
            </div>

            <div class="copyright">
                <p>Hoc sinh Pro</p>
            </div>
        </footer>

        <script src="script.js"></script>
    </body>
</html>