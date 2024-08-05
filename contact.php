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
                    <li><a class="active" href="contact.php">Contact</a></li>
                    <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li id="lg-user"><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
                    <!-- <a href="#" id="close"><i class="far fa-times"></i></a> -->
                </ul>
            </div>
        </section>

        <section id="page-header" class="about-header">
            
            <h2>#Let's_Talk</h2>
            
            <p>LEAVE A MESSAGE, We love to hear from you!</p>
            
        </section>  

        <section id="contact_details" class="section-p1">
            <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Visit our store or contact us today</h2>
                <h3>Pandejy Eatery</h3>
                <div>
                    <li>
                        <i class="fal fa-map"></i>
                        <p>97 Man Thien, phuong Hiep Phu, quan 9, tp. Ho Chi Minh</p>
                    </li>
                    <li>
                        <i class="far fa-envelope"></i>
                        <p>Anhdep2805@gmail.com</p>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <p>0857700502</p>
                    </li>
                    <li>
                        <i class="far fa-clock"></i>
                        <p>Monday to Saturday: 8:00 AM to 6:00 PM</p>
                    </li>
                </div>
            </div>

            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1959.261208736072!2d106.784712488466!3d10.847813331608172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527131ae8b249%3A0x4d2d3c8fab7d3c2e!2zOTcgxJAuIE1hbiBUaGnhu4duLCBIaeG7h3AgUGjDuiwgUXXhuq1uIDksIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1720690821587!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section id="form-details">
            <form action="">
                <span>LEAVE A MESSAGE</span>
                <h2>We love to hear from you</h2>
                <input type="text" placeholder="Your Name">
                <input type="text" placeholder="Email">
                <input type="text" placeholder="Subject">
                <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
                <button class="normal">Submit</button>
            </form>

            <div class="people">
                <div>
                    <img src="img/people/1.png" alt="">
                    <p><span>Vikas Khanna</span> Head Chef <br>Phone: +91-755-569-9093 <br>Email: VikasChef@gmail.com</p>
                </div>
                <div>
                    <img src="img/people/2.png" alt="">
                    <p><span>Virka Borja</span> Account Manager <br>Phone: +91-755-569-9094 <br>Email: VirkaAccount@gmail.com</p>
                </div>
                <div>
                    <img src="img/people/3.png" alt="">
                    <p><span>Vineeta Bhatia</span> Employee Manager <br>Phone: +91-755-569-9095 <br>Email: Vineeta@gmail.com</p>
                </div>
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