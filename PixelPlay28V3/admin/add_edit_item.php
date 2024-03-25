<?php
session_start();
require_once("connectdb.php");
require("check_admin.php");

function check_valid_id($db, $id, $id_type)
{
    $id_column = substr($id_type, 0, -1) . "_id";
    // This is safe because id_type and id_column which depends on id_type are provided by developer.
    $id_query = $db->query("SELECT " . $id_column . " FROM " . $id_type);
    $ids = $id_query->fetchAll();
    foreach ($ids as $id_loop) {
        if ($id_loop[0] == $id) {
            return true;
        }
    }

    return false;
}

function check_int_value($val, $min, $max)
{
    // Credit for ctype_digit: https://stackoverflow.com/a/2012231
    // Check it's set and an integer.
    if (isset($val) && ctype_digit($val)) {
        $val = (int) $val;

        // Check it's in appropriate constraints.
        if ($val < $min || $val > $max) {
            return false;
        }

        return true;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adding or editing an item
    if (isset($_POST["edit_item"]) || isset($_POST["add_item"])) {
        require_once("connectdb.php");
        // Verify all inputs are present and appropriate.
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $genre = $_POST["genre"];
        $console_type = $_POST["console"];
        $publisher = $_POST["publisher"];
        $developer = $_POST["developer"];
        $stock = $_POST["stock"];

        if (!isset($title) || (strlen($title) < 1 || strlen($title) > 255)) {
            exit("Title must be between 0 and 255 characters long and is not.");
        }

        $title = trim($title);

        if (!isset($description) || (strlen($description) < 1 || strlen($description) > 65535)) {
            exit("Description must be between 0 and 65535 characters long and is not.");
        }

        $description = trim($description);

        if (!isset($price) || !is_numeric($price)) {
            exit("Price must be numeric.");
        }

        $price = (float) $price;

        if ($price < 0 || $price > 2147483647) {
            exit("Price value is out of bounds.");
        }

        if (!isset($genre) || !check_int_value($genre, 0, 1000) || !check_valid_id($db, $genre, "genres")) {
            exit("Genre provided is not a valid one.");
        }

        if (!isset($console_type) || !check_int_value($console_type, 0, 1000) || !check_valid_id($db, $genre, "console_types")) {
            exit("Console type provided is not a valid one.");
        }

        if (!isset($publisher) || !check_int_value($publisher, 0, 1000) || !check_valid_id($db, $genre, "publishers")) {
            exit("Publisher provided is not a valid one.");
        }

        if (!isset($developer) || !check_int_value($developer, 0, 1000) || !check_valid_id($db, $genre, "developers")) {
            exit("Developer provided is not a valid one.");
        }

        if (!check_int_value($stock, 0, 100)) {
            exit("Stock provided was not valid - it must be between 0 and 100 and an int.");
        }

        if (isset($_POST["product_id"])) {
            $product_id = $_POST["product_id"];

            $update_string = "UPDATE products SET title = ?, 
                description = ?, price = ?, genre_id = ?, 
                console_type_id = ?, publisher_id = ?, developer_id = ?, stock_quantity = ?
                WHERE product_id = ?;";
        } else {
            // No product ID, we must be adding an item.
            if (isset($_POST["add_item"])) {
                // Image Credit: Ranjithsiji, CC BY-SA 4.0 <https://creativecommons.org/licenses/by-sa/4.0>, via Wikimedia Commons 
                $update_string = "INSERT INTO products (title, description, price, genre_id, console_type_id,
                release_date, publisher_id, developer_id, stock_quantity, image_path) VALUES (?, ?, ?, ?, ?, date '1970-01-01', ?, ?, ?, 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg')";
            }
        }

        $data_list = [$title, $description, $price, $genre, $console_type, $publisher, $developer, $stock];
        if (isset($product_id)) {
            $data_list[] = $product_id;
        }

        $update_statement = $db->prepare($update_string);
        if ($update_statement->execute($data_list)) {
            echo "Item successfully added or edited. Redirecting to inventory page...";
            header('Refresh: 2; URL=inventory.php');
        } else {
            echo "Something went wrong while adding/editing an item.";
        }
    } else {
        echo "Something went wrong while adding/editing an item.";
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
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/gamestyles.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.5/apexcharts.min.js"></script>
        <script src="js/scripts.js"></script>
        <?php
        require_once("connectdb.php");
        try {
            if (isset($_GET["id"])) {
                $product_id = htmlspecialchars($_GET["id"]);
                $product_statement = $db->prepare("SELECT * FROM products WHERE product_id = ?");
                $product_statement->execute([$product_id]);
                $product_rows = $product_statement->fetchAll();
                if (count($product_rows) == 1) {
                    $product = $product_rows[0];
                }

                if (count($product_rows) == 0) {
                    echo "No product with that ID found. Try again.";
                    exit;
                }
            }
        } catch (PDOException $ex) {
            echo "An error occurred: " . $ex->getMessage();
        }
        ?>
    </head>

    <body>
        <section id="game-section" class="game-container">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h3>Item management form</h3>
                <?php
                if (isset($product_id)) { ?>
                    <p>Editing item with ID <?= $product_id ?></p>
                <?php } else { ?>
                    <p>Adding new item</p>
                <?php } ?>
                <label for="title">Title</label>
                <input type="text" name="title" id="title-input" value="<?php if (isset($product)) {
                                                                            echo $product["title"];
                                                                        } ?>" required maxlength="255">

                <label for="description">Description</label>
                <input type="text" name="description" id="desc-input" value="<?php if (isset($product)) {
                                                                                    echo $product["description"];
                                                                                } ?>" required maxlength="65535">

                <label for="price">Price</label>
                <input type="text" name="price" id="price-input" value="<?php if (isset($product)) {
                                                                            echo $product["price"];
                                                                        } ?>" required>

                <label for="genre">Genre</label>
                <select name="genre" id="genre-input" required>
                    <option value=""></option>
                    <?php
                    try {
                        $genres = $db->query("SELECT * FROM genres");
                        foreach ($genres as $genre) { ?>
                            <option value="<?= $genre["genre_id"] ?>" 
                            <?php
                                if (isset($product)) {
                                    if ($product["genre_id"] == $genre["genre_id"]) { ?> selected <?php }
                                }?>><?= $genre["name"] ?></option>
                    <?php }
                    } catch (PDOException $ex) {
                        echo "An error occurred: " . $ex->getMessage();
                    }
                    ?>
                </select>


                <label for="console">Console</label>
                <select name="console" id="console-input" required>
                    <option value=""></option>
                    <?php
                    try {
                        $consoles = $db->query("SELECT * FROM console_types");
                        foreach ($consoles as $console) { ?>
                            <option value="<?= $console["console_type_id"] ?>" 
                            <?php
                                if (isset($product)) {
                                    if ($product["console_type_id"] == $console["console_type_id"]) { ?> selected <?php }
                                }?>><?= $console["name"] ?></option>
                        <?php }
                    } catch (PDOException $ex) {
                        echo "An error occurred: " . $ex->getMessage();
                    }
                    ?>
                </select>

                <label for="publisher">Publisher</label>
                <select name="publisher" id="publisher-input" required>
                    <option value=""></option>
                    <?php
                    try {
                        $publishers = $db->query("SELECT * FROM publishers");
                        foreach ($publishers as $publisher) { ?>
                            <option value="<?= $publisher["publisher_id"] ?>" 
                            <?php
                                if (isset($product)) {
                                    if ($product["publisher_id"] == $publisher["publisher_id"]) { ?> selected <?php }
                                } ?>><?= $publisher["name"] ?></option>
                    <?php }
                    } catch (PDOException $ex) {
                        echo "An error occurred: " . $ex->getMessage();
                    }
                    ?>
                </select>

                <label for="developer">Developer</label>
                <select name="developer" id="developer-input" required>
                    <option value=""></option>
                    <?php
                    try {
                        $developers = $db->query("SELECT * FROM developers");
                        foreach ($developers as $developer) { ?>
                            <option value="<?= $developer["developer_id"] ?>" 
                            <?php
                                if (isset($product)) {
                                    if ($product["developer_id"] == $developer["developer_id"]) { ?> selected <?php }
                                }?>><?= $developer["name"] ?></option>
                    <?php }
                    } catch (PDOException $ex) {
                        echo "An error occurred: " . $ex->getMessage();
                    }
                    ?>
                </select>

                <label for="stock">Stock quantity</label>
                <input type="number" name="stock" id="stock-input" value="<?php if (isset($product)) {
                                                                                echo $product["stock_quantity"];
                                                                            } ?>" required min="0" max="100">



                <?php if (isset($product_id)) { ?>
                    <input type="hidden" name="edit_item">
                    <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                <?php } else { ?>
                    <input type="hidden" name="add_item">
                <?php } ?>
                <input type="submit">
            </form>
        </section>
    </body>

    </html>
<?php } ?>