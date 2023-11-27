<!--  Notes:
// This page is unfinished. To do:
// 1. Complete navigation - keeping consistent design
// 2. Form will need to send the user back to the index.html page
// 3. Connect proper database once ready
 -->


<?php
session_start();
require_once('connectdb.php');

// Set a user ID directly in the session for testing
$_SESSION['user_id'] = 1;

try {
    //Get the user ID variable for the query
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Getting products from the order details for the user
        $query = "SELECT
          od.order_id,
          p.image_path,
          p.title,
          od.quantity,
          od.price_per_unit
          FROM
            order_details od
          JOIN
            products p ON od.product_id = p.product_id
          JOIN
            orders o ON od.order_id = o.order_id
          WHERE
            o.user_id = $user_id";

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
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>PixelPlay28 - Checkout</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="payFormStyle.css" />
    <script src="payFormScript.js"></script>
</head>
<body>
    <nav>
        <img src="LOGO.png" width="200" />
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </nav>

    <div class="page-container">
        <h1>Checkout</h1> <br>
        <div class="form-container" onsubmit="return validatePayment()">
            <div class="form-left-half">
              <h3 class="order-heading"> Card Details </h3>
                <form id="paymentForm" action="">
                    <!-- Payment details -->
                    <label for="cardHolder">Cardholder Name:</label><br>
                    <input type="text" id="cardHolder" placeholder="Enter your name" required><br>

                    <label for="cardNumber">Card Number:</label><br>
                    <input type="text" id="cardNumber" maxlength="16" placeholder="Enter 16-digit number" required><br>

                    <label for="expiryDate">Expiry Date:</label><br>
                    <input type="date" id="cardExpiry" placeholder="Enter expiry date" required><br>

                    <label for="cvv">CVV:</label><br>
                    <input type="text" id="cardCVV" maxlength="3" placeholder="Enter CVV" required><br>

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
                      $itemTotal = $row['quantity'] * $row['price_per_unit'];
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
                  </div> <!-- item-container close div -->
                  <?php
                  }
                  } else {
                    echo "No order details found.";
                  }
                  ?>
                </div> <!-- display-column close div -->
                <p class="total-display">Overall Total: $<?php echo $overallTotal; ?></p>
            </div> <!-- Right-half close div -->
        </div> <!-- Form container close -->
    </div> <!-- Page container close -->
</body>
</html>
