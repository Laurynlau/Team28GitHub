<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <link rel="stylesheet" href="homestyles.css">

    <!-- Slick Carousel CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

<!-- Slick Carousel Theme CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />


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
    <a href="basket.php">
    <i class="fas fa-shopping-basket icon"></i>
    </a>
</nav>

    <div class="photosensitivity-disclaimer">
        <p>⚠️ Warning: Our website may contain content that includes flashing lights, animations, or other visual effects. Viewer discretion is advised, especially for individuals with photosensitive epilepsy or other light-sensitive conditions.
            If you have concerns about potential triggers, we recommend exercising caution and, if necessary, consulting with a healthcare professional before engaging with the content. Your health and safety is important to us.
        </p>
    </div>


    <div class="hero-section">
        <h1 class="featured-games-title">Featured Games</h1>
        <div class="slider-container">
           <!-- Featured Games Slider -->
           <div class="featured-games-slider">
              <!-- Slide 1 -->
              <div class="slide">
                 <!-- Content for Slide 1 -->
                 <img src="fifaslide1.jpg" alt="Game 1" loading="lazy">
                 <a href="games.php" class="btn">Explore now</a>
              </div>

              <!-- Slide 2 -->
              <div class="slide">
                 <!-- Content for Slide 2 -->
                 <img src="zeldaslide.jpeg" alt="Game 2" loading="lazy">
                 <a href="games.php" class="btn">Explore now</a>
              </div>

              <div class="slide">
                <!-- Content for Slide 2 -->
                <img src="catanslide.jpeg" alt="Game 2" loading="lazy">
                <a href="games.php" class="btn">Explore now</a>
             </div>
           </div>
        </div>
    </div>

     <div class="categories-section">
        <h2>Explore Categories</h2>
        <div class="category-cards-container">
        <div class="category-card">
            <img src="adventure.jpg.webp" alt="Adventure">
            <div class="category-info">
                <h3>Adventure</h3>
                <p>Embark on thrilling journeys and epic quests</p>
                <a href="adventure.php">Explore</a>
            </div>
        </div>
        <div class="category-card">
            <img src="board.jpeg" alt="Board Games">
            <div class="category-info">
                <h3>Board games</h3>
                <p>Enjoy strategic and competitive board games</p>
                <a href="board.php">Explore</a>
            </div>
        </div>
        <div class="category-card">
            <img src="puzzle.jpg" alt="Puzzle">
            <div class="category-info">
                <h3>Puzzle</h3>
                <p>Challenge your mind with engaging puzzles</p>
                <a href="puzzle.php">Explore</a>
            </div>
        </div>
        <div class="category-card">
            <img src="flightslide.jpeg" alt="simulation Games">
            <div class="category-info">
                <h3>Simulation</h3>
                <p>Immerse yourself in realistic virtual worlds</p>
                <a href="simulation.php">Explore</a>
            </div>
        </div>
        <div class="category-card">
            <img src="sportscat.jpeg" alt="Sports ">
            <div class="category-info">
                <h3>Sports</h3>
                <p>Experience the excitement of sports simulations</p>
                <a href="sports.php">Explore</a>
            </div>
        </div>
   </div>
</div>

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Slick Carousel JS -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script src="home.js"></script>

<script src="logout.js"></script>

</body>

<footer>
  <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="games.php">Games</a></li>
      <li><a href="aboutus.php">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
  </ul>
    <div class="footer-social">
        <!-- Add social media icons with links -->
        <a href="https://en-gb.facebook.com/reg/" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.linkedin.com/signup" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
        <a href="https://www.instagram.com/accounts/emailsignup/?next=https%3A%2F%2Faccountscenter.instagram.com%2F%3Fentry_point%3Dapp_settings%26__coig_login%3D1" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
    <p>&copy; 2023 PixelPlay28. All rights reserved.</p>
</footer>
</html>
