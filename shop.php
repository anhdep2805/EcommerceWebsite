<?php



include('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM products");

$stmt->execute();

$products = $stmt->get_result();


if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    $page_no = $_GET['page_no'];

}else{
    $page_no = 1;
}

$stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

// products per page
$total_records_per_page = 4;

$offset = ($page_no-1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_page = ceil($total_records/$total_records_per_page);

//get all products
$stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();

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
                    <li><a class="active" href="shop.php">Shop</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li id="lg-user"><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                    <!-- <a href="#" id="close"><i class="far fa-times"></i></a> -->
                </ul>
            </div>
        </section>

        <section id="page-header">
            
            <h2>#Stayathome</h2>
            
            <p>Save more with coupon</p>
            
        </section>

        <section id="product1" class="section-p1">
            

            
            <div class="pro-container">
            <?php while($row = $products->fetch_assoc()){ ?>
                <div class="pro">
                    <img src="img/products/<?php echo $row['product_image']; ?>" alt="">
                    <div class="des">
                        <span><?php echo $row['product_category']; ?></span>
                        <h5><?php echo $row['product_name']; ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>$<?php echo $row['product_price']; ?></h4>
                    </div>
                    <a href="<?php echo "sproduct.php?product_id=".$row['product_id']; ?>"><i class="fa-solid fa-cart-shopping cart"></i></a>
                </div>
              
                
            <?php } ?>
             
            
              
              
            
              
               
               
                
               
              
                
                
            </div>
        </section>   
        
        <section id="pagination" class="section-p1">
            <ul>
                <li class=" <?php if($page_no<=1){echo 'disabled';} ?>">
                    <a href="<?php if($page_no <= 1){echo '#';}else{ echo "?page_no=".($page_no-1);} ?>">Previous</a>
                </li>
                <li><a href="?page_no=1">1</a></li>
                <li><a href="?page_no=2">2</a></li>

                <?php if( $page_no >=3){ ?>
                    <li><a href="#">...</a></li>
                    <li><a href="#\<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>
                <?php } ?>


                <!-- <a href="#"><i class="fa-solid fa-arrow-right"></i></a> -->
                <li class=" <?php if($page_no>= $total_no_of_page){echo 'disabled';} ?>">
                    <a href="<?php if($page_no >= $total_no_of_page){echo '#';}else{ echo "?page_no=".($page_no+1);} ?>">Next</a>
                </li>
            </ul>
        </section>

        <!-- <nav aria-label="Page navigation example" class="mx-auto">
            <ul class="pagination mt-5 mx-auto">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"> <a class="page-link" href="#">3</a></li> 
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav> -->

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