<!--
// Notes:
// This page is unfinished. To do:
// 1. The page now allows data to be inserted into database, quantity selectors do not reflect what is saved in database
      and therefore makes the total incorrect if not the same. - work in progress
// 2. Connect proper database once ready
-->

<?php
session_start();
require_once('connectdb.php');

// Set a user ID directly in the session for testing
$_SESSION['user_id'] = 1;

//echo "Script is running"; // Add this line for basic script check

//Display Item query - complete and working
try {
    // Get the user ID variable for the query
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

//update quantity query - complete and working
if(isset($_POST['update_product_quantity'])){
    $user_id = $_SESSION['user_id'];
    $update_value = $_POST['update_quantity'];
    echo "<script>console.log('Overall Total: $update_value');</script>";
    $update_id = $_POST['update_quantity_id'];
    echo "<script>console.log('Overall Total: $update_id');</script>";

    $stmt = $db->prepare("UPDATE wishlist SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $stmt->execute([ $update_value, $user_id, $update_id]);
}

//delete product query - complete and working
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
    require_once('connectdb.php');

//checkout function - complete and working
if (isset($_POST['checkout'])) {
  try {
  // Get the user ID from the session
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];

      // Insert into orders table
      $status = 'pending';

      $orderQuery = "INSERT INTO orders (user_id, total_price, Status) VALUES (?, ?, ?)";
      $orderStatement = $db->prepare($orderQuery);
      $orderStatement->execute([$user_id, 0, $status]);

      // Retrieve the order_id
      $order_id = $db->lastInsertId();

      // Query to get the items in the basket with product details
      $query = "SELECT
        p.product_id,
        p.title,
        p.price,
        wishlist.quantity
      FROM
        wishlist
      JOIN
        products p ON wishlist.product_id = p.product_id
      WHERE
        wishlist.user_id = $user_id";

      // Run the query
        $rows = $db->query($query);

      // Initialize overall total for the order
        $overallTotal = 0;

      // Insert into order_details table
        $orderDetailsQuery = "INSERT INTO order_details (order_id, product_id, quantity, price_per_unit) VALUES (?, ?, ?, ?)";
        $orderDetailsStatement = $db->prepare($orderDetailsQuery);

        foreach ($rows as $row) {
          $itemTotal = $row['quantity'] * $row['price'];

      // Insert order details
          $orderDetailsStatement->execute([$order_id, $row['product_id'], $row['quantity'], $row['price']]);

      // Update overall total for the order
          $overallTotal += $itemTotal;
          }

      // Update the total in the orders table
          $updateTotalQuery = "UPDATE orders SET total_price = ? WHERE order_id = ?";
          $updateTotalStatement = $db->prepare($updateTotalQuery);
          $updateTotalStatement->execute([$overallTotal, $order_id]);

      // Clear the user's wishlist (optional)


      // Redirect to a success page or display a success message
        header("Location: payForm.php");
          exit();
      }
    } catch (PDOException $ex) {
        echo "An error occurred: " . $ex->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PixelPlay28 - Basket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="basketStyle.css">
    <script src="basketScript.js"></script>
</head>
<body>

    <nav>
        <img src="LOGO.png" alt="Your Logo" class="logo">
        <a  href="home.html">Home</a>
        <a href="games.html">Shop</a>
        <a href="aboutus.html">About Us</a>
        <a href="contact.html">Contact Us</a>

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
        <i class="fas fa-shopping-basket icon"></i>
    </nav>

    <div class="hero-section">
        <h1 class="featured-games-title">Your Basket</h1>

  <?php
  // Display the product information
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
                          <input type="hidden" name="" id="totalInput" value="0.00">
                          <p class="price">$<?php echo $row['price']; ?></p>
                      </div>

                      <div class="next-column">
                          <!-- Quantity Box -->
                          <div class="top-half">
                              <label for="quantity" class="quantity">Quantity:</label>
                          </div>
                          <form action="" method="post">
                          <div class="top-half">
                              <?php
                              $productId = $row['product_id'];
                              $price = $row['price'];
                              ?>
                              <input type="hidden" value="<?php echo $productId; ?>" name="update_quantity_id">
                              <input type="number" class="quantity-input" id="quantity<?php echo $productId; ?>" name="update_quantity" min="1" max="10" step="1" value="1" data-product-id="<?php echo $productId; ?>"
                                  onchange="updateSubtotal(event, <?php echo $productId; ?>, <?php echo $price; ?>)" onkeydown="return event.key !== 'Enter';">
                          </div>
                          <div class="bottom-half">
                              <button type="submit" class="update" name="update_product_quantity" value="Update"> Update </button>
                          </div>
                        </form>
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
                                  header("Location: basket.php"); // refreshes page
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
          </form>
          <?php
          }
          ?>

          <div class="checkout-container">
                    <div class="total-container">
                        <div class="left-section right-align total-text ">
                            <p>Total:</p>
                        </div>
                        <div class="right-section quantity">
                            <input type="hidden" name="total" id="totalInput" value="0.00">
                            <p><span id="total" class="total-text"> </span></p>
                        </div>
                    </div>
                    <form method="post" action="">
                        <div class="total-container">
                            <button type="submit" class="checkout-button" name="checkout" onclick="updateTotalAndSubmit() window.location.href = 'payForm.html' ">Checkout</button>
                            <input type="hidden" name="checkout" value="true" class="form-input">
                        </div>
                    </form>
                </div>
  <?php
  } else {
      echo "No products found in the wishlist.";
  }
  ?>
     </div> <!-- Hero-section close div -->

<script src="home.js"></script>

</body>

<footer id="footer">
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="games.html">Games</a></li>
        <li><a href="aboutus.html">About Us</a></li>
        <li><a href="contact.html">Contact Us</a></li>
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
