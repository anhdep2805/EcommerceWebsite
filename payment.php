<?php

session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
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
        

        <section class="">
            <div class="container text-center mt-3 pt-5">
                <h2 class="font-weight-bold">Payment</h2>
                <hr class="nx-auto">
            </div>
            <div class="mx-auto container">


                <?php  if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){ ?>
                    <?php $ammount = strval($_POST['order_total_price']); ?>    
                    <?php $order_id = $_POST['order_id']; ?>
                    <p>Total payment: $<?php echo $_POST['order_total_price']; ?></p>
                        <!-- <input class="btn" type="submit" value="Pay now"> -->
                         <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>


                <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0) {?>
                    <?php $ammount = strval($_SESSION['total']); ?>
                    <?php $order_id = $_SESSION['order_id']; ?>
                    <p>Total payment: $ <?php echo $_SESSION['total']; ?></p>
                 <!-- <input class="btn" type="submit" value="Pay now"> -->
                  <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
                

                

                <?php } else { ?>

                    <p>You do not have an order</p>
                <?php } ?>
                
                
                
               



            </div>
        </section>

        
        <!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AYiDeToPeZgjg55NfqtAJ8ygO25WE6tmFguhKLuvmpFjVkIXrw3hW7-nLpQ04RyQx_24EFFzcntFGrc4&currency=USD"></script>


<script>
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $ammount ?>' // Can reference variables or functions. Example: value: document.getElementById('...').value
                    }
                }]
            });
        },

        // Finalize the transaction after payer approval
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');


                window.location.href = "server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id;?>;

                // When ready to go live, remove the alert and show a success message within this page. For example:
                // var element = document.getElementById('paypal-button-container');
                // element.innerHTML = '';
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';

                // Or go to another URL: actions.redirect('thank_you.html');
            });
        }
    }).render('#paypal-button-container');
</script>


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