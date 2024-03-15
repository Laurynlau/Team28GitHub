<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <link rel="stylesheet" href="homestyles.css">
 <link rel="stylesheet" href="contactus.css">


<title>Contact Us - PixelPlay28</title>

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

   <div class="contact-section ">
        <div class="contact-container">
            <form id="contactForm" action="submittedForm.php" method="post">
                <h2>Contact Us</h2>
                <p>Have questions or feedback? Reach out to us!</p>

                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit" window.location.href = "submittedForm.php">Submit</button>
            </form>
        </div>
    </div>
    <script src="home.js"></script>
    <script src="gamescript.js"></script>
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
