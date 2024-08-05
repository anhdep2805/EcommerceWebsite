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

        <section id="hero">
            <h4>Summer-Sale-Off</h4>
            <h2>Super value deals</h2>
            <h1>On all products</h1>
            <p>Save more with coupon</p>
            <button>Shop now</button>
        </section>

        <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="img/features/f1.png" alt="">
                <h6>Free Shipping</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f2.png" alt="">
                <h6>Online Order</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f3.png" alt="">
                <h6>Save Money</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f4.png" alt="">
                <h6>Promotions</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f5.png" alt="">
                <h6>Happy Sell</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f6.png" alt="">
                <h6>Support</h6>
            </div>
        </section>

        <section id="product1" class="section-p1">
            <h2>Featured Dishes</h2>
            <p>Summer Collection Food Set</p>
            <div class="pro-container">

            <?php include('server/get_featured_products.php'); ?>

            <?php while($row= $featured_products->fetch_assoc()){ ?>
                <div class="pro">
                    <img src="img/products/<?php echo $row['product_image']; ?>" alt="">
                    <div class="des">
                        <span>adidas</span>
                        <h5><?php echo $row['product_name']; ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>$ <?php echo $row['product_price'] ?></h4>
                    </div>
                    <a href="<?php echo "sproduct.php?product_id=". $row['product_id'];?>"><i class="fa-solid fa-cart-shopping cart"></i></a>

                    
                </div>
                <?php } ?>
                
                
                
                
                
                
            </div>
        </section>

        <section id="banner" class="section-m1">
            <h4>Delivery Service</h4>
            <h2>Up to <span>70% Off</span> - All Foods & Desserts</h2>
            <button class="normal">Explore More</button>
        </section>

        <section id="product1" class="section-p1">
            <h2>New Arrivals</h2>
            <p>Next seansonal Dishes</p>
            <div class="pro-container">

            <?php include('server/get_new_arrival.php') ?>

            <?php while($row=$new_products->fetch_assoc()){ ?>
                <div class="pro">
                    <img src="img/products/<?php echo $row['product_image']; ?>" alt="">
                    <div class="des">
                        <span>adidas</span>
                        <h5><?php echo $row['product_name']; ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4><?php echo $row['product_price']; ?></h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
                </div>
            
            <?php } ?>
                
            
                
                
                
                
            </div>
        </section>      
        
        <section id="sm-banner" class="section-p1">
            <div class="banner-box">
                <h4>crazy deals</h4>
                <h2>buy 1 get 1 free</h2>
                <span>The best classic dress is on sale at here</span>
                <button class="white">Learn More</button>
            </div>
            <div class="banner-box banner-box2">
                <h4>spring/summer</h4>
                <h2>upcomming season</h2>
                <span>The best classic dress is on sale at here</span>
                <button class="white">Collection</button>
            </div>
        </section>

        <section id="banner3">
            <div class="banner-box">
                <h2>SEASONAL SALE</h2>
                <h3>Winter Collection -50% OFF</h3>
            </div>
            <div class="banner-box banner-box2">
                <h2>SEASONAL SALE</h2>
                <h3>Winter Collection -50% OFF</h3>
            </div>
            <div class="banner-box banner-box3">
                <h2>SEASONAL SALE</h2>
                <h3>Winter Collection -50% OFF</h3>
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
        <iframe class="chat-bot" width="350" height="430" allow="microphone;" src="https://console.dialogflow.com/api-client/demo/embedded/e4f19a6d-ac87-4159-a960-d6afa2334ab9"></iframe>
    </body>
</html>