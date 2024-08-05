<?php

/*
    not paid
    shipped
    delivered
*/


include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);

}else{

    header('location: account.php');
    exit;
}


function calculateTotalOrderPrice($order_details){

    $total = 0;
    foreach($order_details as $row){
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);
    }

    return $total;
    
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
                    <li id="lg-user"><a class="active" href="logo.php"><i class="fa-solid fa-user"></i></a></li>
                    <!-- <a href="#" id="close"><i class="far fa-times"></i></a> -->
                </ul>
            </div>
        </section>



        <section id="orders" class="orders container2 my-5 py-3">
            <div class="container2 mt-5">
                <h2 class="font-weight-bold text-center">Order Details</h2>
                <hr class="mx-auto">
            </div>
            <table class="mt-5 pt-5 mx-auto">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    
                </tr>
                <?php foreach($order_details as $row){ ?>
                
                            <tr>
                                <td>
                                    <div>
                                        <img src="img/products/<?php echo $row['product_image'];?>"/>
                                        <div>
                                            <p class="mt-3"><?php echo $row['product_name'];?></p>
                                        </div>
                                    </div>
                                </td> 

                                

                                <td>
                                    <span><?php echo $row['product_price'];?></span>
                                </td>

                                <td>
                                    <span><?php echo $row['product_quantity'];?></span>
                                </td>


                                
                                

                                
                                
                            </tr>
               
                <?php } ?>
            </table>


            <?php if($order_status  == "not paid"){?>

                <form style="float: right;" method="POST" action="payment.php">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                    <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
                    <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
                    <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now">
                </form>

            <?php } ?>

                



            
                
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