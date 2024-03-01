
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PixelPlay28 - About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="aboutUS.css">
</head>
<body>

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
    <a href="basket.php">
    <i class="fas fa-shopping-basket icon"></i>
    </a>
</nav>

    <div class="hero-section">
        <h1 class="page-title">About Us</h1><br>
        <div class="main-text">
          <h3> Welcome to PixelPlay28: Where Pixels Come To Life! </h3>
          <p> At PixelPlay28, we're more than just a gaming platform; we're a community, a celebration of pixels, and a journey into the immersive world of play.
            Our story is rooted in a passion for gaming and a vision to create a space where every gamer feels at home. </p>
          <h3> What Sets Us Apart? </h3>
          <ul class="left-align">
            <li><strong>Diverse Selection</strong> - PixelPlay28 is committed to offering a curated selection of adventure, board, puzzle, simmulation, and sports games.
              We hand pick each title to ensure a diverse and engaging experience for every gamer within the 16-25 age group.</li>
            <li><strong>Mental Health Focus</strong> - We prioritize your mental well-being. Our platform is dedicated to offering games that promote relaxation, cognitive development,
              and social interactions. PixelPlay28 is not just a platform; it's a commitment to a healthier gaming experience.</li>
            <li><strong>Community Building</strong> - PixelPlay28 isnt just a marketplace; it's a community. Join us in celebrating the joy of gaming, sharing experiences, and discovering the transformative power of play.</li>
          </ul>

          <div class="row-container">
            <div class="left-section">
              <h3> Our Vision </h3>
              <p class="padding"> At PixelPlay28, we envision a future where gaming transcends boundaries, creating a positive impact on individuals' lives, one pixel at a time.
                We see a world where every gaming experience, carefully curated and shared within our vibrant community, contributes to personal growth, mental well-being, and lasting connections. </p>
            </div>
            <div class="right-section">
              <h3> Join Us </h3>
              <p> PixelPlay28 is not just a platform; it's an invitation to embark on an adventure where pixels come to life. Explore our curated games, connect with out community, and let's redefine gaming together. </p>
              <button onclick="document.location = 'games.php'"> Explore Games </button>
            </div>
          </div>

      </div>
    </div> <!-- Hero-section close div -->

<script src="home.js"></script>

</body>

<footer id="footer">
  <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="games.php">Games</a></li>
      <li><a href="aboutus.php">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
  </ul>
    <div class="footer-social">
        <!-- Add social media icons with links -->
        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
    <p>&copy; 2023 PixelPlay28. All rights reserved.</p>
</footer>
</html>
