<?php

session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}


if(isset($_POST['change_password'])){

            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $user_email = $_SESSION['user_email'];

            //if passwords dont match
            if($password !== $confirmPassword){
                header('location: account.php?error=passwords dont match');

            
            //if password is less than 6 char
            }else if(strlen($password) < 6){
                header('location: account.php?error=password must be at least 6 characters');
            
            //no errors
            }else{
                
                $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
                $stmt->bind_param('ss',md5($password),$user_email);

                if($stmt->execute()){
                    header('location: account.php?message=Password has been updated successfully');
                }else{
                    header('location: account.php?message=Could not update password');
                }
            }

}

//get orders
if($_SESSION['logged_in']){

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();
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
                    <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li id="lg-user"><a class="active" href="logo.html"><i class="fa-solid fa-user"></i></a></li>
                    <!-- <a href="#" id="close"><i class="far fa-times"></i></a> -->
                </ul>
            </div>
        </section>

        <section class="">
            <div class="row container">
                <?php if(isset($_GET['payment_message'])){ ?>
                    <p class="mt-5 text-center" style="color:green" ><?php echo $_GET['payment_message']; ?></p>
                <?php } ?>
                <div class="text-center col-lg-6 col-md-12 col-sm-12">
                    <h3>Account info</h3>
                    <hr class="mx-auto">
                    <div class="account-info">
                        <p>Name: <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];} ?></span></p>
                        <p>Email: <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];} ?></span></p>
                        <p><a href="#orders" id="orders-btn">Your orders</a></p>
                        <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                    </div>
                </div>
                
            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                    <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                    <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){ echo $_GET['message']; }?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="account-password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmPassword" id="account-password-confirm" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
            </div>
        </section>

        <section id="orders" class="orders container2 my-5 py-3">
            <div class="container2 mt-2">
                <h2 class="font-weight-bold text-center">Your Orders</h2>
                <hr class="mx-auto">
            </div>
            <table class="mt-5 pt-5">
                <tr>
                    <th>Order id</th>
                    <th>Order cost</th>
                    <th>Order status</th>
                    <th>Order Date</th>
                    <th>Order detail</th>
                </tr>

                <?php while($row = $orders->fetch_assoc() ){ ?>
                            <tr>
                                <!-- <td>
                                    <div>
                                        <img src="img/featured.jpeg"/>
                                        <div>
                                            <p class="mt-3"><?php echo $row['order_id']; ?></p>
                                        </div>
                                    </div>
                                </td> -->

                                <td>
                                    <span><?php echo $row['order_id']; ?></span>
                                </td>

                                <td>
                                    <span><?php echo $row['order_cost']; ?></span>
                                </td>

                                <td>
                                    <span><?php echo $row['order_status']; ?></span>
                                </td>

                                <td>
                                    <span><?php echo $row['order_date']; ?></span>
                                </td>

                                <td>
                                    <form method="POST" action="order_details.php">
                                        <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                                        <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                                        <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details">
                                    </form>
                                </td>
                                
                            </tr>
                <?php } ?>

            </table>
                
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