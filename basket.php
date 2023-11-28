<!--
// Notes:
// This page is unfinished. To do:
// 2. The page doesnt allow for order_details data to be uploaded into the database - work in progress
// 3. Connect proper database once ready
// 4. Clean code including external JavaScript
-->

<?php
session_start(); // Start the session (if not already started)
require_once('connectdb.php');

// Set a user ID directly in the session for testing
$_SESSION['user_id'] = 1;

try {
    //Get the user ID varibale for query
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Getting products from the wishlist for the user
        $query = "SELECT products.*
                  FROM products
                  INNER JOIN wishlist ON products.product_id = wishlist.product_id
                  WHERE wishlist.user_id = '$user_id'";

        // Run the query
        $rows = $db->query($query);
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

<title>PixelPlay28 - Basket</title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content = "IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href = "basketStyle.css" />
    <script src="basketScript.js"></script>

</head>
<body>
    <nav>
      <div class="nav-section">
        <img src = "LOGO.png" width = "200" />
        <ul>
            <li><a href = "#">Home</a></li>
            <li><a href = "#">Products</a></li>
            <li><a href = "#">About Us</a></li>
            <li><a href = "#">Contact Us</a></li>
        </ul>
      </div>

        <ul class="nav-section">
            <li><a href = "#">Account</a></li>
            <li><a href = "#">Basket</a></li>
        </ul>
    </nav>

    <div class="page-container">
        <h1>Shopping Basket</h1> <br>

        <?php
    // Display the product informatio
    if ($rows && $rows->rowCount() > 0) {
        foreach ($rows as $row) {
            ?>
<form method="post" action="">
    <div class="row-container">
        <div class="item-container">
            <div class="left-section"> <!-- picture of item Box -->
              <img src="<?php echo $row['image_path']; ?>" alt="Product Image" class="product-img">
            </div>

            <div class="middle-section">
              <div class="top-half"> <!-- item title Box -->
                <p class="left-align"><?php echo $row['title']; ?></p>
              </div>
              <div class="bottom-half"> <!-- item description Box -->
                <p><?php echo $row['description']; ?></p>
              </div>
            </div>

            <div class="right-section"> <!-- item price Box -->
                <p class="price">$<?php echo $row['price']; ?></p>
            </div>

            <div class="next-column">
                <!-- Quanitiy Box -->
                <div class="top-half">
                    <form method="post" action="" id="checkoutForm">
                        <label for="quantity">Quantity:</label>
                    </div>
                    <div class="bottom-half">
                        <!-- item description Box -->
                        <?php
                        $productId = $row['product_id'];
                        $price = $row['price'];
                        ?>
                        <!-- used to calculete the users subtotals and ovberall total, onKey is to prevent user from refreshign the page on enter key, intervals of 1, max 10 -->
                        <input type="number" class="quantity-input" id="quantity<?php echo $productId; ?>" name="quantity[<?php echo $productId; ?>]" min="1" max="10" step="1" value="1" data-product-id="<?php echo $productId; ?>"
                          onchange="updateSubtotal(event, <?php echo $productId; ?>, <?php echo $price; ?>)" onkeydown="return event.key !== 'Enter';">
                        <input type="hidden" name="hidden_quantity[<?php echo $productId; ?>]" id="quantityInput<?php echo $productId; ?>" value="1">
                    </form>
                </div>
            </div>

            <div class="next-column">
                <!-- Subtotal Box -->
                <p class="subtotal" id="subtotal<?php echo $productId; ?>" data-product-id="<?php echo $productId; ?>">Subtotal: $<?php echo $price; ?></p>
            </div>
          </div> <!-- Item container close -->

          <?php
            require_once('connectdb.php');

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['delete_item'])) {
                    try {
                        $productIdToDelete = $_POST['delete_item'];

                        // Getting user ID
                        $user_id = $_SESSION['user_id'];

                        // Delete the item from the wishlist
                        $stmt = $db->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
                        $stmt->execute([$user_id, $productIdToDelete]);

                        if ($stmt->rowCount() > 0) {
                            echo "Item deleted successfully.";
                            header("Location: basket.php");
                            exit();
                        } else {
                            echo "Item not found in the wishlist.";
                            header("Location: basket.php");
                            exit();
                        }
                    } catch (PDOException $ex) {
                        echo "An error occurred: " . $ex->getMessage();
                    }
                }
            }
          ?>

          <div class="bin-container">
            <form method="post" action="">
              <input type="hidden" name="delete_item" value="<?php echo $row['product_id']; ?>">
              <button type="submit" class="bin-button">
                  <img src="bin.png" class="bin-img" alt="Delete Item">
              </button>
            </form>
          </div>
        </div> <!-- Row container close -->

          <?php
        }
    } else {
        echo "No products found in the wishlist.";
      }
      ?>

      <?php
      // ... (your existing code)

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Output the entire POST data for debugging
        print_r($_POST);
        exit();
    } catch (PDOException $ex) {
        echo "An error occurred: " . $ex->getMessage();
    }
}
      ?>
          <div class="checkout-container">
            <div class="total-container">

              <div class="left-section right-align total-text ">
                  <p>Total:</p>
              </div>
              <div class="right-section padding">
                   <p><span id="total" class="total-text"> $0.00</span></p>
                   <input type="hidden" name="total" id="totalInput" value="0.00">
              </div>
            </div>
            <div class="total-container">
                <button type="submit" class="checkout-button" name="checkout" onclick="updateTotalAndSubmit()">Checkout</button>
              </form>
            </div>
          </div>
    </div> <!-- Page container close -->

</body>
</html>
