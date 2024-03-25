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
            <input type="text" id="searchInput" name="title" placeholder="Search by item..."></input>
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
        <h3>Admin Dashboard: Orders</h3>
        <p>Browse all the orders here.</p>
    </section>

    <div class="filters">
        <label for="status">Filter by Status:</label>
        <select id="status" name="status" class="filter-select">
            <option value="all">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>

        <label for="total-range">Filter by Order Total:</label>
        <select id="total-range" name="total-range" class="filter-select">
            <option value="all">All Prices</option>
            <option value="0-40">£0-£40</option>
            <option value="40-70">£40-£70</option>
            <option value="70">£70+</option>
        </select>
        <button type="button">Filter</button>
        <button type="button">Remove filters</button>
        <p><b>Showing results for:</b> query</p>
    </div>

    <main class="main-container">
        <h3>Sitewide order status</h3>
        <div class="main-cards">
            <div class="card">
                <div class="card-inner">
                    <h3>Incoming orders</h3>
                </div>
                <h1>100</h1>
                <sub>These are orders that are pending.</sub>
            </div>

            <div class="card">
                <div class="card-inner">
                    <h3>Outgoing orders</h3>
                </div>
                <h1>100</h1>
                <sub>These are orders that have been completed.</sub>
            </div>
        </div>

            <ul id="orders-list">
                <h3>Order List - 12 found</h3>
                <li>
                    <p><b>Order 5</b> by user_name</p>
                    <div class="order-item">
                        <img src='https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zelda.jpg?raw=true' class="order-image">
                        <p><b>2x</b> The Legend of Zelda: Breath of the Wild (£49.99 each) - £99.98</p>
                    </div>
                    <p><b>Total price:</b> £99.98</p>
                    <form action="orders.php" method="post">
                        <input type="hidden" name="order_id" value="5" />
                        <label for="order_status">Status:</label>
                        <select name="order_status" id="order_status" onchange="this.form.submit()">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <noscript><button type="submit">Update</button></noscript>
                    </form>
                </li>
            </ul>
    </main>
</body>
</html>