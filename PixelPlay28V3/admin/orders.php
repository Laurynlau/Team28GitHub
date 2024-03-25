<?php
session_start();
require_once("connectdb.php");
require("check_admin.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["order_status"])) {
        if (isset($_POST["order_id"])) {
            try {
                $order_id = $_POST["order_id"];
                $order_statement = $db->prepare("SELECT * FROM orders WHERE order_id = ?");
                $order_statement->execute([$order_id]);
                $order = $order_statement->fetchAll();
                if (count($order) == 1) {
                    // We've verified an order exists with the ID we want to change the status of.
                    $previous_order_status = $order[0]["Status"];
                    $order_status = $_POST["order_status"];

                    $extra = "";
                    if (isset($_POST["query_string"]) && strlen($_POST["query_string"]) > 0) {
                        $extra = "?" . $_POST["query_string"];
                    }
                    $redirect_url = htmlspecialchars($_SERVER['PHP_SELF']) . $extra;


                    if ($previous_order_status != $order_status) {
                        $pendingToCancelled = ($previous_order_status == "pending") && ($order_status == "cancelled");
                        $cancelledToPending = ($previous_order_status == "cancelled") && ($order_status == "pending");

                        if ($cancelledToPending) {
                            echo "ERROR: You can't change an order from cancelled to pending! Redirecting to orders page...";
                            header('Refresh: 3; URL=' . $redirect_url);
                            exit;
                        }

                        $details_statement = $db->prepare("SELECT * FROM order_details WHERE order_id = ?");
                        $details_statement->execute([$order_id]);
                        $details = $details_statement->fetchAll();

                        $message = "";
                        foreach ($details as $detail) {
                            if (!$pendingToCancelled) {
                                // gather stock information
                                $quantity = $detail["quantity"];
                                $product_id = $detail["product_id"];

                                $product_statement = $db->prepare("SELECT * FROM products WHERE product_id = ?");
                                if ($product_statement->execute([$product_id])) {
                                    $product_list = $product_statement->fetchAll();
                                    if (count($product_list) == 1) {
                                        $product = $product_list[0];
                                        $new_quantity = $product["stock_quantity"];
                                        if (!isset($new_quantity)) {
                                            $new_quantity = 0;
                                        }

                                        $subtracted = false;

                                        if ($previous_order_status == "completed") {
                                            $new_quantity += $quantity;
                                        } else {
                                            $new_quantity -= $quantity;
                                        }

                                        if ($new_quantity >= 0) {
                                            if ($new_quantity < 5) {
                                                $message .= "The quantity of item " . $product["title"] . " has fallen to " . $new_quantity . ", which is below the 'Low Stock' threshold.<br>";
                                            } else if ($new_quantity == 0) {
                                                $message .= "The quantity of item " . $product["title"] . " has fallen to 0. It's now out of stock.<br>";
                                            }
                                            $db->query("UPDATE products SET stock_quantity = " . $new_quantity . " WHERE product_id = " . $product_id . ";");

                                            $status_statement = $db->prepare("UPDATE orders SET Status = ? WHERE order_id = ?");
                                            $status_statement->execute([$order_status, $order_id]);
                                        } else {
                                            $message .= "Status could not be changed as quantity of " . $product["title"] . " in stock, which is currently " . $product["stock_quantity"] . ", would fall below 0.<br>";
                                        }
                                    }
                                }
                            } else {
                                $status_statement = $db->prepare("UPDATE orders SET Status = ? WHERE order_id = ?");
                                $status_statement->execute([$order_status, $order_id]);
                            }

                            if (strlen($message) > 0) {
                                echo $message . "Redirecting to orders page in 5 seconds.";
                                header('Refresh: 5; URL=' . $redirect_url);
                                exit;
                            } else {
                                header("Location: " . $redirect_url);
                            }
                        }
                    } else {
                        header("Location: " . $redirect_url);
                    }
                } else {
                    echo "Something went wrong while trying to update order status.";
                }
            } catch (PDOException $ex) {
                echo "An error occurred: " . $ex->getMessage();
            }
        }
    }
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/gamestyles.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script defer src="js/scripts.js"></script>

        <?php
        require_once("connectdb.php");
        try {
            $order_query = $db->query("SELECT * FROM orders;");
            $starting_orders = $order_query->fetchAll();
            $orders = [];

            foreach ($starting_orders as $order) {
                $details_statement = $db->prepare("SELECT * FROM order_details WHERE order_id = ?");
                $details_statement->execute([$order["order_id"]]);
                $details = $details_statement->fetchAll();
                $orders[] = ["order" => $order, "details" => $details];
            }

            $statusQ = isset($_GET["status"]) ? $_GET["status"] : null;
            $titleQ = isset($_GET["title"]) ? $_GET["title"] : null;
            $totalQ = isset($_GET["total-range"]) ? $_GET["total-range"] : null;


            $filteringStatus = isset($statusQ) && $statusQ != "all";
            if (isset($statusQ)) {
                $statusQ = htmlspecialchars($statusQ);
            }

            $filteringTitle = isset($titleQ) && $titleQ != "";
            if (isset($titleQ)) {
                $titleQ = htmlspecialchars($titleQ);
            }

            $filteringTotal = isset($totalQ) && $totalQ != "all";
            if (isset($totalQ)) {
                $totalQ = htmlspecialchars($totalQ);
            }

            $incoming_total = 0;
            $outgoing_total = 0;

            foreach ($orders as $key => $ord) {
                $order = $ord["order"];
                $details = $ord["details"];


                if (!isset($details) || count($details) == 0) {
                    unset($orders[$key]);
                    continue;
                }

                if ($order["Status"] == "pending") {
                    $incoming_total += 1;
                } else if ($order["Status"] == "completed") {
                    $outgoing_total += 1;
                }

                if ($filteringStatus) {
                    if (isset($order["Status"])) {
                        if ($statusQ != $order["Status"]) {
                            unset($orders[$key]);
                            continue;
                        }
                    } else {
                        unset($orders[$key]);
                        continue;
                    }
                }

                if ($filteringTitle) {
                    $product_ids_query = $db->query("SELECT product_id FROM products WHERE title LIKE '%" . $titleQ . "%'");
                    $product_ids_pre = $product_ids_query->fetchAll();
                    $product_ids = [];
                    foreach ($product_ids_pre as $product_id) {
                        $product_ids[] = $product_id[0];
                    }

                    $matchFound = false;
                    foreach ($details as $detail) {
                        // Check if any IDs in the details are in the array of matched products.
                        if (in_array($detail["product_id"], $product_ids)) {
                            if ($detail["quantity"] > 0) {
                                $matchFound = true;
                                break;
                            }
                        }
                    }

                    if (!$matchFound) {
                        unset($orders[$key]);
                        continue;
                    }
                }

                if ($filteringTotal) {
                    $orderTotal = 0;
                    foreach ($details as $detail) {
                        $orderTotal += $detail["price_per_unit"] * $detail["quantity"];
                    }

                    $min_threshold = 0;
                    $max_threshold = 0;

                    switch ($totalQ) {
                        case '0-40':
                            $max_threshold = 40;
                            break;
                        case '40-70':
                            $min_threshold = 40;
                            $max_threshold = 70;
                            break;
                        case '70':
                            $min_threshold = 70;
                            $max_threshold = 2147483647;
                            break;
                    }

                    if ($orderTotal < $min_threshold || $orderTotal >= $max_threshold) {
                        unset($orders[$key]);
                    }
                }
            }
        } catch (PDOException $ex) {
            echo "An error occurred: " . $ex->getMessage();
        }
        ?>
    </head>

    <body>
        <nav>
            <img src="LOGO.png" alt="Your Logo" class="logo">
            <a href="../home.php">Home</a>
            <a href="../games.php">Shop</a>
            <a href="../aboutus.php">About Us</a>
            <a href="../contact.php">Contact Us</a>

            <div class="search-container">
                <input type="text" id="searchInput" name="title" placeholder="Search by item..." <?php if ($filteringTitle) {
                                                                                                        echo 'value="' . $titleQ . '"';
                                                                                                    } ?>>
                <button onclick="performSearch();" class="search-btn">
                    <i class="fas fa-search search-icon"></i>
                </button>
            </div>

            <div class="dropdown" id="account-dropdown">
                <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) : ?>
                    <i class="fas fa-user icon"></i>
                    <div class="dropdown-content">
                        <a href="../login.php">Sign In</a>
                    </div>
                <?php else : ?>
                    <p>Welcome, <?php echo $_SESSION["username"]; ?></p>
                    <a href="../logout.php">Logout</a>
                <?php endif; ?>
            </div>
            </div>
            <a href="../basket.php">
                <i class="fas fa-shopping-basket icon"></i>
            </a>
        </nav>

        <section class="admin-top" title="center">
            <h3>Admin Dashboard: Orders</h3>
            <p>Browse all the orders here.</p>
        </section>

        <div class="filters">
            <label for="status">Filter by Status:</label>
            <select id="status" name="status" class="filter-select">
                <option value="all">All Statuses</option>
                <option value="pending" <?php if ($filteringStatus && $statusQ == "pending") {
                                            echo "selected";
                                        } ?>>Pending</option>
                <option value="completed" <?php if ($filteringStatus && $statusQ == "completed") {
                                                echo "selected";
                                            } ?>>Completed</option>
                <option value="cancelled" <?php if ($filteringStatus && $statusQ == "cancelled") {
                                                echo "selected";
                                            } ?>>Cancelled</option>
            </select>

            <label for="total-range">Filter by Order Total:</label>
            <select id="total-range" name="total-range" class="filter-select">
                <option value="all">All Prices</option>
                <option value="0-40" <?php if ($filteringTotal && $totalQ == "0-40") {
                                            echo "selected";
                                        } ?>>£0-£40</option>
                <option value="40-70" <?php if ($filteringTotal && $totalQ == "40-70") {
                                            echo "selected";
                                        } ?>>£40-£70</option>
                <option value="70" <?php if ($filteringTotal && $totalQ == "70") {
                                        echo "selected";
                                    } ?>>£70+</option>
            </select>
            <button type="button" onclick="performFilter();">Filter</button>
            <button type="button" onclick="resetFilter();">Remove filters</button>
            <?php if ($filteringTitle) { ?> <br><br>
                <p><b>Showing results for:</b> <?= $titleQ ?></p><?php } ?>
        </div>

        <main class="main-container">
            <h3>Sitewide order status</h3>
            <div class="main-cards">
                <div class="card">
                    <div class="card-inner">
                        <h3>Incoming orders</h3>
                    </div>
                    <h1><?= $incoming_total ?></h1>
                    <sub>These are orders that are pending.</sub>
                </div>

                <div class="card">
                    <div class="card-inner">
                        <h3>Outgoing orders</h3>
                    </div>
                    <h1><?= $outgoing_total ?></h1>
                    <sub>These are orders that have been completed.</sub>
                </div>
            </div>

            <?php
            if (count($orders) > 0) { ?>
                <ul id="orders-list">
                    <h3>Order List - <?= count($orders) ?> found</h3>
                    <?php foreach ($orders as $ord) {
                        if (isset($ord["order"])) {
                            $order = $ord["order"];
                            try {
                                $order_id = $order["order_id"];
                                $current_status = $order["Status"];
                                $order_total = 0;
                                $details_query = $db->prepare("SELECT * FROM order_details WHERE order_id = ?");
                                $details_query->execute([$order_id]);
                                $details = $details_query->fetchAll();

                                $username_query = $db->prepare("SELECT * FROM users WHERE user_id = ?");
                                $username_query->execute([$order["user_id"]]);
                                $username_fetch = $username_query->fetchAll();

                                if (count($username_fetch) == 1) {
                                    $username = $username_fetch[0]["username"];
                                    if (count($details) > 0) { ?>
                                        <li>
                                            <p><b>Order <?= $order_id ?></b> by <?= $username ?></p>
                                            <?php foreach ($details as $detail) {
                                                $quantity = $detail["quantity"];
                                                if ($quantity > 0) {
                                                    $product_query = $db->prepare("SELECT * FROM products WHERE product_id = ?");
                                                    $product_query->execute([$detail["product_id"]]);
                                                    $product_fetch = $product_query->fetchAll();
                                                    if (count($product_fetch) == 1) {
                                                        $product = $product_fetch[0];
                                                        $price_per = $detail["price_per_unit"];
                                                        $this_batch = ((float) $price_per) * $quantity;
                                                        $order_total += $this_batch; ?>
                                                        <div class="order-item">
                                                            <img src='<?= $product["image_path"] ?>' class="order-image">
                                                            <p><b><?= $quantity ?>x</b> <?= $product["title"] ?> (£<?= $price_per ?> each) - £<?= $this_batch ?></p>
                                                        </div>
                                                    <?php }
                                                } else { ?>
                                                    <p><sub>Zero-quantity item</sub></p>
                                            <?php }
                                            } ?>
                                            <p><b>Total price:</b> £<?= $order_total ?></p>
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                                <input type="hidden" name="order_id" value="<?= $order_id ?>" />
                                                <?php if (strlen($_SERVER["QUERY_STRING"]) > 0) { ?><input type="hidden" name="query_string" value="<?= $_SERVER["QUERY_STRING"] ?>" /><?php } ?>
                                                <label for="order_<?= $order_id ?>_status">Status:</label>
                                                <select name="order_status" id="order_<?= $order_id ?>_status" onchange="this.form.submit()">
                                                    <option value="pending" <?php if ($current_status == "pending") { ?> selected <?php } ?>>Pending</option>
                                                    <option value="completed" <?php if ($current_status == "completed") { ?> selected <?php } ?>>Completed</option>
                                                    <option value="cancelled" <?php if ($current_status == "cancelled") { ?> selected <?php } ?>>Cancelled</option>
                                                </select>
                                                <noscript><button type="submit">Update</button></noscript>
                                            </form>
                                        </li>
                                    <?php }
                                }
                            } catch (PDOException $ex) {
                                echo "An error occurred: " . $ex->getMessage();
                            }
                        }
                    }
                    ?>
                </ul>
            <?php } else { ?>
                <p>No orders were found in the database matching that query.</p>
            <?php } ?>
        </main>
    </body>
    </html>
<?php } ?>