
 <?php
session_start();
require_once('connectdb.php');

// Set a user ID directly in the session for testing
//$_SESSION['user_id'] = 1;

try {
    //Get the user ID variable for the query
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Getting products from the order details for the user
        $query = "SELECT DISTINCT products.*, wishlist.quantity, products.price
        FROM products
        INNER JOIN wishlist ON products.product_id = wishlist.product_id
        WHERE wishlist.user_id = '$user_id';";

        // Run the query
        $rows = $db->query($query);

        $overallTotal = 0;

    } else {
        // If user ID is not in the session
        echo "User ID not set in the session.";
    }
} catch (PDOException $ex) {
    echo "An error occurred: " . $ex->getMessage();
}

//CANCEL ORDER
if (isset($_POST['cancelOrder'])) {
    try {
        // Getting user ID
        $user_id = $_SESSION['user_id'];

        // Query to select the most recent order ID for the user
        $orderQuery = "SELECT MAX(order_id) AS recent_order_id FROM orders WHERE user_id = ?";
        $stmt = $db->prepare($orderQuery);
        $stmt->execute([$user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $recent_order_id = $row['recent_order_id'];

        if ($recent_order_id) {
            // Delete the order details associated with the most recent order
            $deleteDetailsStmt = $db->prepare("DELETE FROM order_details WHERE order_id = ?");
            $deleteDetailsStmt->execute([$recent_order_id]);

            // Delete the most recent order from the orders table
            $deleteOrderStmt = $db->prepare("DELETE FROM orders WHERE order_id = ?");
            $deleteOrderStmt->execute([$recent_order_id]);

            echo "Most recent order deleted successfully.";
        } else {
            echo "No orders found for this user.";
        }

        header("Location: basket.php");
        exit();
    } catch (PDOException $ex) {
        echo "An error occurred: " . $ex->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PixelPlay28 - Pay Here</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="payFormStyle.css">
</head>
<body>

    <nav>
        <img src="LOGO.png" alt="Your Logo" class="logo">
        <a  href="home.php">Home</a>
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

    <div class="hero-section">
    <h1 class="page-title">Checkout</h1><br>
    <div class="page-container">
        <div class="form-container" onsubmit="return validatePayment()">
            <div class="form-left-half">
              <h3 class="order-heading"> Card Details </h3>
                <form id="paymentForm" action="index.php">
                    <!-- Payment details -->
                    <label for="cardHolder">Cardholder Name:</label><br>
                    <input type="text" id="cardHolder" placeholder="Enter your name" required><br><br>

                    <label for="cardNumber">Card Number:</label><br>
                    <input type="text" id="cardNumber" maxlength="16" placeholder="Enter 16-digit number" required><br><br>

                    <label for="expiryDate">Expiry Date:</label><br>
                    <input type="date" id="cardExpiry" placeholder="Enter expiry date" required><br><br>

                    <label for="cvv">CVV:</label><br>
                    <input type="text" id="cardCVV" maxlength="3" placeholder="Enter CVV" required><br><br>

                    <!-- Submit button -->
                    <button type="submit" class="checkout-button">Pay Now</button>
                </form>
            </div> <!-- Left-half close div -->

            <div class="form-right-half">
                <h3 class="order-heading"> Order </h3>
                <div class="display-column">
                  <?php
                  if ($rows && $rows->rowCount() > 0) {
                    foreach ($rows as $row) {
                      $itemTotal = $row['quantity'] * $row['price'];
                      $overallTotal += $itemTotal
                  ?>
                  <div class="item-container">
                    <div class="order-item">
                      <div class="left-section">
                        <img src="<?php echo $row['image_path']; ?>" alt="Product Image" class="product-img">
                      </div> <!-- left-section close div -->
                      <div class="middle-section">
                        <p class="left-align"><?php echo $row['title']; ?></p>
                      </div> <!-- middle-section close div -->
                    </div> <!-- order-item close div -->

                    <div class="end-section">
                    <p> Quantity: <?php echo $row['quantity']; ?> </p>
                    </div> <!-- middle-section close div -->
                  </div> <!-- item-container close div -->
                  <?php
                  }
                  } else {
                    echo "No order details found.";
                  }
                  ?>
                </div> <!-- display-column close div -->
                <p class="total-display">Overall Total: £<?php echo $overallTotal; ?></p>
                <form method="post">
                <button type="submit" name="cancelOrder"class="checkout-button cancel-button">Cancel Order</button>
                </form>
            </div> <!-- Right-half close div -->
        </div> <!-- Form container close -->
    </div> <!-- Page container close -->
  </div> <!-- Hero - section container close -->
  <script src="logout.js"></script>
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

