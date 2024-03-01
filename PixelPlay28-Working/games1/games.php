<?php
session_start();
require_once('connectdb.php');
$query = "SELECT * FROM products";
$rows = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <link rel="stylesheet" href="homestyles.css">
 <link rel="stylesheet" href="gamestyles.css">


    <title>Games</title>
</head>

<body>

  <!-- Top Header Section -->
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
        <i class="fas fa-user icon"></i>
        <div class="dropdown-content">
        </div>
    </div>
    <a href="basket.php">
    <i class="fas fa-shopping-basket icon"></i>
    </a>
</nav>



  <div class="filters">
      <label for="category">Filter by Category:</label>
      <select id="category" class="filter-select">
          <option value="all">All Categories</option>
          <option value="adventure">Adventure game</option>
          <option value="board">Board game</option>
          <option value="puzzle">Puzzle game</option>
          <option value="simulation">Simulation game</option>
          <option value="sports">Sports game</option>
      </select>

      <label for="price-range">Filter by Price:</label>
      <select id="price-range" class="filter-select">
          <option value="all">All Prices</option>
          <option value="0-20">£0 - £20</option>
          <option value="20-40">£20 - £40</option>
          <option value="40+">£40+</option>
      </select>
  </div>

  

<script src="home.js"></script>
<script src="gamescript.js"></script>

<section id="game-section" class="game-container">
    <?php foreach ($rows as $row) {
    ?> 
    <form action="basket.php" method="post">

    <div class="game">
    <img src="<?php echo $row["image_path"] ?>">
        <div class="game-details">
            <h3> <?php echo $row["title"] ?> </h3>
            <br>
            <?php echo $row["description"] ?>
            <h4> £<?php echo $row["price"] ?></h4>
            <p style="color: orange;">Low Stock</p>
            <input type="hidden" value="<?php echo $row["product_id"]; ?>" name="product_id_to_add">
            <button type="submit" name="add_to_cart" value="Add to cart"> Add to cart </button>
        </div>
    </div>
    </form>
    <?php 
}
?>
</section>
<script src = "basketScript.js"></script>

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
