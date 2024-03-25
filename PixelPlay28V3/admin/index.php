<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Admin Dashboard</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<link rel="stylesheet" href="css/styles.css">
	<script defer src="js/scripts.js"></script>
</head>

<body>
	<div class="grid-container">
		<header class="header">
			<div class="menu-icon" onclick="openSidebar()">
				<span class="material-icons-outlined">menu</span>
			</div>
			<div class="header-left">
				<span>Logged in as <b>user_name</b></span>
			</div>
		</header>

		<aside id="sidebar" class="sidebar-responsive">
			<div class="sidebar-title">
				<div class="logo">
					<img src="LOGO.png" width="200" />
				</div>
				<span class="material-icons-outlined" onclick="closeSidebar()">close</span>
			</div>

			<ul class="sidebar-list">
				<li class="sidebar-list-item">
					<a href="orders.php" target="_blank">
						<span class="material-icons-outlined">dashboard</span> Orders
					</a>
				</li>
				<li class="sidebar-list-item">
					<a href="inventory.php" target="_blank">
						<span class="material-icons-outlined">fact_check</span> Inventory
					</a>
				</li>
			</ul>
		</aside>

		<main class="main-container">
			<div class="main-title">
				<h2>DASHBOARD</h2>
			</div>

			<div class="main-cards">

				<div class="card">
					<div class="card-inner">
						<h3>PRODUCTS</h3>
						<span class="material-icons-outlined">inventory_2</span>
					</div>
					<h1>37</h1>
				</div>

				<div class="card">
					<div class="card-inner">
						<h3>CATEGORIES</h3>
						<span class="material-icons-outlined">category</span>
					</div>
					<h1>5</h1>
				</div>

				<div class="card">
					<div class="card-inner">
						<h3>CUSTOMERS</h3>
						<span class="material-icons-outlined">groups</span>
					</div>
					<h1>100</h1>
				</div>
			</div>
		</main>
	</div>
</body>

</html>