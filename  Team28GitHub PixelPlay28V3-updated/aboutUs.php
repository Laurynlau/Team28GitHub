<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="aboutUs.css">
    <link rel="stylesheet" href="homestyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   
</head>

<body>

<?php
session_start();
?>

<nav>
    <img src="LOGO.png" alt="Your Logo" class="logo">
    <a href="home.php">Home</a>
    <a href="games.php">Shop</a>
    <a href="aboutus.php">About Us</a>
    <a href="contact.php">Contact Us</a>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by category...">
        <button onclick="searchProducts()" class="search-btn">
            <i class="fas fa-search search-icon"></i>
        </button>
    </div>

    <div class="dropdown" id="account-dropdown">
        <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) : ?>
            <i class="fas fa-user icon"></i>
            <div class="dropdown-content">
            <a href="login.php">Sign In</a>
        </div>
        <?php else : ?>
            <p>Welcome, <?php echo $_SESSION["username"]; ?></p>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
    </div>
    <div class="basket-container" onclick="location.href='basket.php'">
    <i class="fas fa-shopping-basket icon"></i>
</div>
</nav>

    <section id="title"  class="mb-0">
        <div class="container col-xxl-8 px-4 pt-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 pt-5">
                <div class="col-lg-6">
                    <h1 style="font-weight: bold;">Welcome to <span class="brand-name">PixelPlay28</span></h1>
                    <p class="tagline">Where Pixels Come to Life!</p>
                    <div class="about-text-container">
                        <p>Discover more than just a gaming platform at PixelPlay28; We're a celebration of pixels and your
                            go-to destination for the latest and greatest games!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="vision" class="my-5" style=" font-size:18px; background-color:  #fff; " >
        <div class="container py-5" style="margin-top: 0;">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-body-emphasis" style="font-weight: bold; ">Our Vision <i class="fas fa-eye vision-icon"></i></h2>
                    <br>
            
                        <blockquote>
                     <p>    Our story is rooted in a passion for gaming and a dream to create a space where every gamer finds a sense of belonging. At PixelPlay28, we envision a future where gaming transcends boundaries, creating a positive impact on individual's lives, one pixel at a time.
                       We imagine a global community where individuals of various backgrounds and interests come together to celebrate the joy of gaming.
                       Our goal is to emerge as a beacon of innovation, promoting games that not only entertain but also contribute to cognitive development, relaxation, personal growth and positive social interactions. This, in turn, will help shaping a brighter and healthier gaming future.
                    </p>
                        </blockquote>
                
                </div>
            </div>
        </div>
    </section>
    
    

    <section id="features">
        
        <div class="container mt-5">
            
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fs-2">What Sets Us Apart?</h2>
                </div>
            </div>

            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    
                <!-- Diverse Selection Feature -->
                <div class="col d-flex align-items-start">
                    <div class="icon-square text-body-emphasis  d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3" style="background-color: #e6e6e6">
                        <i class="fas fa-puzzle-piece" style="color: #007BFF; font-size: 30px; margin-top: 5px;"  ></i>
                    </div>
                    <div>
                        <h3 class="fs-2">Diverse Selection</h3>
                        <p>PixelPlay28 is dedicated to providing a diverse and curated selection of adventure, board games, puzzles, simulations, and sports games. We carefully handpick each title to ensure a rich and engaging experience for every gamer. Our goal is to cater to a wide range of interests, creating a platform where everyone can find games that resonate with their preferences and passions</p>
                    </div>
                </div>
    
                <!-- Mental Health Focus Feature -->
                <div class="col d-flex align-items-start">
                    <div class="icon-square text-body-emphasis d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3"  style="background-color: #e6e6e6">
                        <i class="fas fa-brain" style="color: #007BFF; font-size: 30px; margin-top: 5px;"></i>
                           
                    </div>
                    
                    <div>
                        <h3 class="fs-2">Mental Health Focus</h3>
                        <p>At PixelPlay28, we prioritize your mental well-being. Our platform is dedicated to offering games
                            that promote relaxation, cognitive development, and positive social interactions. It is
                            not just a platform; it's a commitment to a healthier gaming experience</p>
                    </div>
                </div>
    
                <!-- Community Building Feature -->
                <div class="col d-flex align-items-start">
                    <div class="icon-square text-body-emphasis  d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3" style="background-color: #e6e6e6">
                        <i class="fas fa-users" style="color: #007BFF; font-size: 30px; margin-top: 5px;"></i>
                    </div>
                    <div>
                        <h3 class="fs-2">Community Building</h3>
                        <p>PixelPlay28 isn't just a marketplace; it's a thriving community of gaming enthusiasts. Join us in
                            celebrating the joy of gaming, sharing unique experiences, and discovering the transformative power of
                            play. Whether you're a casual gamer or a seasoned pro, we provide a welcoming space for
                            everyone </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="home.js"></script>
</body>


<footer>
    <!-- Join Us Section -->
    <section id="join-us" class="my-5">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-body-emphasis">Embark on the PixelPlay28 Journey <i class="fas fa-rocket" style="color: #007BFF; 
                    font-size: 30px"></i></h2>
                    <p class="lead mt-4">PixelPlay28 is not just a platform; it's an invitation to embark on an
                        adventure. Explore, play, and become a part of our vibrant gaming community. Let's redefine gaming
                        together!</p>
                        <button onclick="location.href='games.php'" class="custom-button">Explore</button>


                </div>
            </div>
        </div>
    </section>

    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="games.php">Games</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
    <div class="footer-social">
        <!-- Add social media icons with links -->
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.linkedin.com/home" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
    <p>&copy; 2023 PixelPlay28. All rights reserved.</p>
</footer>

</body>
</html>