<?php
session_start();
require_once("connectdb.php");
require("check_admin.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["remove_item"])) {
        if (isset($_POST["product_id"])) {
            // We clicked the remove item button
            // Delete the item from the database
            $product_id = $_POST["product_id"];
            try {
                $remove_statement = $db->prepare("DELETE FROM products WHERE product_id = ?");
                if ($remove_statement->execute([$product_id])) {
                    $extra = "";
                    if (isset($_POST["query_string"]) && strlen($_POST["query_string"])) {
                        $extra = "?" . $_POST["query_string"];
                    }

                    header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']) . $extra);
                } else {
                    echo "Something went wrong while trying to remove item.";
                }
            } catch (PDOException $ex) {
                echo "An error occurred: " . $ex->getMessage();
            }
        }
    }
} else {
?>
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
            $products_str = "SELECT * FROM products";
            $search = false;
            $filter = false;
            $filter_string = "";


            if (isset($_GET["title"])) {
                if (!$_GET["title"] == "") {
                    $search = true;
                    $title = htmlspecialchars($_GET["title"]);
                    $filter_string .= " WHERE title LIKE '%" . $title . "%'";
                }
            }

            if (isset($_GET["category"])) {
                if ($_GET["category"] != "all") {
                    // We have a starting 'WHERE' already.
                    if (strlen($filter_string) > 0) {
                        $filter_string .= " AND ";
                    } else {
                        // This is the first 'WHERE'.
                        $filter_string .= " WHERE ";
                    }

                    $filter = true;
                    $filter_string .= "genre_id = '{$_GET["category"]}'";
                }
            }

            if (isset($_GET["price-range"])) {
                if ($_GET["price-range"] != "all") {
                    // We have a starting 'WHERE' already.
                    if (strlen($filter_string) > 0) {
                        $filter_string .= " AND ";
                    } else {
                        // This is the first 'WHERE'.
                        $filter_string .= " WHERE ";
                    }

                    $priceRange = $_GET["price-range"];
                    switch ($priceRange) {
                        case '0-20':
                            $filter_string .= "price >= 0 AND price <= 20";
                            break;
                        case '20-40':
                            $filter_string .= "price > 20 AND price <= 40";
                            break;
                        case '40':
                            $filter_string .= "price > 40";
                            break;
                    }
                    $filter = true;
                }
            }

            $products_str .= $filter_string;
            $products_query = $db->query($products_str);
            $products = $products_query->fetchAll();
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
                <input type="text" id="searchInput" name="title" placeholder="Search by name..." <?php if ($search) {
                                                                                                        echo 'value="' . $title . '"';
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
            <h3>Admin Dashboard: Inventory</h3>
            <p>Browse the current status of the inventory here.</p>
        </section>

        <div class="filters">
            <label for="category">Filter by Category:</label>
            <select id="category" name="category" class="filter-select">
                <option value="all">All Categories</option>
                <?php
                try {
                    $categories_query = $db->query("SELECT * FROM genres");
                    $categories = $categories_query->fetchAll();
                    foreach ($categories as $category) { ?>
                        <option value="<?= $category["genre_id"]; ?>" <?php if (isset($_GET["category"]) && $_GET["category"] == $category["genre_id"]) {
                                                                            echo "selected";
                                                                        } ?>><?= $category["name"] ?> game</option>
                <?php }
                } catch (PDOException $ex) {
                    echo "An error occurred: " . $ex->getMessage();
                } ?>
            </select>

            <label for="price-range">Filter by Price:</label>
            <select id="price-range" name="price-range" class="filter-select">
                <option value="all">All Prices</option>
                <option value="0-20" <?php if (isset($_GET["price-range"]) && $_GET["price-range"] == "0-20") {
                                            echo "selected";
                                        } ?>>£0 - £20</option>

                <option value="20-40" <?php if (isset($_GET["price-range"]) && $_GET["price-range"] == "20-40") {
                                            echo "selected";
                                        } ?>>£20 - £40</option>
                <option value="40" <?php if (isset($_GET["price-range"]) && $_GET["price-range"] == "40") {
                                        echo "selected";
                                    } ?>>£40+</option>
            </select>
            <button type="button" onclick="performFilter();">Filter</button>
            <button type="button" onclick="resetFilter();">Remove filters</button>
            <?php if ($search) { ?> <br><br>
                <p><b>Showing results for:</b> <?= $title ?></p><?php } ?>
        </div>

        <section id="game-section" class="game-container">
            <form action="add_edit_item.php">
                <button type="submit" id="add_item">Add new item</button>
            </form>
            <?php
            if (!isset($products)) {
                exit("Products not set.");
            }
            $product_count = count($products);
            $item_count = 0;
            if ($product_count > 0) {
                foreach ($products as $product) {
                    $quantity = $product["stock_quantity"];
                    $item_count += $quantity;
                    if ($quantity < 5) {
                        $stock_class = "low";
                    } else if ($quantity < 100) {
                        $stock_class = "in";
                    } else {
                        $stock_class = "full";
                    }
            ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="game">
                            <img src="<?php echo $product["image_path"] ?>">
                            <div class="game-details">
                                <h3> <?php echo $product["title"] ?></h3><sub>(ID: <?= $product["product_id"]; ?>)</sub>
                                <br>
                                <?php echo $product["description"] ?>
                                <h4> £<?php echo $product["price"] ?></h4>
                                <p class="<?= $stock_class ?>-stock"><?php echo ucfirst($stock_class); ?> Stock (<?= $quantity ?> left)</p>
                                <input type="hidden" value="<?php echo $product["product_id"]; ?>" name="product_id">
                                <?php if (strlen($_SERVER["QUERY_STRING"]) > 0) { ?><input type="hidden" name="query_string" value="<?= $_SERVER["QUERY_STRING"] ?>" /><?php } ?>
                                <button type="submit" name="remove_item">Remove item</button>
                                <a href="add_edit_item.php?id=<?= $product["product_id"]; ?>"><button type="button">Edit item</button></a>
                            </div>
                        </div>
                    </form>
                <?php } ?>
                <p><b>Stock levels:</b> <?= $product_count ?> products with total <?= $item_count ?> items<?php if ($search || $filter) {
                                                                                                                echo " found";
                                                                                                            } ?></p>
            <?php }
            ?>
        </section>
    </body>

    </html>
<?php } ?>