<?php

session_start();

if( !empty($_SESSION['cart'])){


    //let user in

    //send user to home page
}else{
    header('location: index.php');
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
                    <li><a class="active" href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li id="lg-user"><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                    <!-- <a href="#" id="close"><i class="far fa-times"></i></a> -->
                </ul>
            </div>
        </section>

       
   

        
        

        <section class="">
            <div class="container text-center mt-3 pt-5">
                <h2 class="font-weight-bold">Check Out</h2>
                <hr class="nx-auto">
            </div>
            <div class="mx-auto container">
                <form id="checkout-form" method="POST" action="server/place_order.php">
                    <p class="text-center" style="color: red;">
                        <?php if(isset($_GET['message'])){ echo $_GET['message'];} ?>
                        <?php if(isset($_GET['message'])) {?>

                            <a href="login.php" class="btn">Login</a>

                        <?php } ?>
                    </p>
                    <div class="form-group checkout-small-element">
                        <label>Name</label>
                        <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Email</label>
                        <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>Phone</label>
                        <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label>City</label>
                        <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
                    </div>
                    <div class="form-group checkout-large-element">
                        <label>Address</label>
                        <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
                    </div>
                    <div class="form-group checkout-btn-container">
                        <p>Total amount: $ <?php echo $_SESSION['total']; ?></p>
                        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
                        
                    </div>
                    
                </form>
            </div>
        </section>


        <section id="newsletter" class="section-p1 section-m1">
            <div class="newstext">
                <h4>Sign Up For Newsletter</h4>
                <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
            </div>
            <div class="form">
                <input type="text" placeholder="Your email acdress">
                <button class="normal">Sign Up</button>
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