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
</head>
<body>
    <nav>
        <img src="LOGO.png" alt="Your Logo" class="logo">
        <a href="../home.php">Home</a>
        <a href="../games.php">Shop</a>
        <a href="../aboutus.php">About Us</a>
        <a href="../contact.php">Contact Us</a>

        <div class="search-container">
            <input type="text" id="searchInput" name="title" placeholder="Search by name...">
            <button class="search-btn">
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
            <option value="1">Adventure game</option>
            <option value="2">Board game</option>
            <option value="3">Puzzle game</option>
            <option value="4">Simulation game</option>
            <option value="5">Sports game</option>
        </select>

        <label for="price-range">Filter by Price:</label>
        <select id="price-range" name="price-range" class="filter-select">
            <option value="all">All Prices</option>
            <option value="0-20">£0 - £20</option>
            <option value="20-40">£20 - £40</option>
            <option value="40">£40+</option>
        </select>
        <button type="button">Filter</button>
        <button type="button">Remove filters</button>
        <p><b>Showing results for:</b> query</p>
    </div>

    <section id="game-section" class="game-container">
        <form action="inventory.php">
            <button type="submit" id="add_item">Add new item</button>
        </form>
        <form action="inventory.php" method="post">
            <div class="game">
                <img src='https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zelda.jpg?raw=true'>
                <div class="game-details">
                    <h3>Legend of Zelda: Breath of the Wild</h3><sub>(ID: 51)</sub>
                    <br>
                    Adventure game for Nintendo Switch
                    <h4>£49.99</h4>
                    <p class="in-stock">In Stock (12 left)</p>
                    <input type="hidden" value="51" name="product_id">
                    <button type="submit" name="remove_item">Remove item</button>
                    <button type="button">Edit item</button>
                </div>
            </div>
        </form>
        <p><b>Stock levels:</b> 3 products with total 300 items</p>
    </section>
</body>
</html>