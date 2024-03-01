<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <link rel="stylesheet" href="homestyles.css">
 <link rel="stylesheet" href="gamestyles.css">
 <link rel="stylesheet" href="orders.css">



    <title>Order History</title>
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

    <section class="order-history">

<div class="order-entry">
    <h2>Previous Orders</h2>

    <h4>Order #12345</h4>
    <p>Order Date: [Order Date]</p>

    <!-- List of Games Purchased -->
    <ul class="games-list">
        <li>
            <img src="game1.jpg" alt="Game Image">
            <div class="game-details">
                <h4>The Legend of Zelda: Breath of the Wild</h4>
                <p>Quantity: 2</p>
            </div>
        </li>
        <div class="return-section" data-game-id="game1">
            <button  onclick="initiateReturn('game1')"> Return this game</button>
            <p id="returnStatus_order12345"></p>
          </div>
        <div class="game-rating" data-game-id="game1">
            <div class="star-rating" id="star-rating">
                <span class="star" data-rating="1">&#9733;</span>
                <span class="star" data-rating="2">&#9733;</span>
                <span class="star" data-rating="3">&#9733;</span>
                <span class="star" data-rating="4">&#9733;</span>
                <span class="star" data-rating="5">&#9733;</span>
            </div>
            <textarea id="reviewGame1" placeholder="Write your review"></textarea>
            <button onclick="submitReview('game1')">Submit Review</button>
        </div>
        <li>
            <img src="thesims.jpg" alt="Game Image">
            <div class="game-details">
                <h4>The Sims 4</h4>
                <p>Quantity: 1</p>
            </div>
        </li>
        <div class="return-section" data-game-id="game2">
            <button  onclick="initiateReturn('game2')">Return this game</button>
            <p id="returnStatus_order12345"></p>
          </div>
        <div class="game-rating" data-game-id="game2">
            <div class="star-rating" id="star-rating">
                <span class="star" data-rating="1">&#9733;</span>
                <span class="star" data-rating="2">&#9733;</span>
                <span class="star" data-rating="3">&#9733;</span>
                <span class="star" data-rating="4">&#9733;</span>
                <span class="star" data-rating="5">&#9733;</span>
            </div>
            <textarea id="reviewGame2" placeholder="Write your review"></textarea>
            <button onclick="submitReview('game2')">Submit Review</button>
        </div>
    </ul>

    <p>Total Price: £45.99</p>
    <p>Order Status: Processing</p>

</div>


    </section>


<script src="home.js"></script>
<script src="orders.js"></script>
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
