<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <link rel="stylesheet" href="homestyles.css">
 <link rel="stylesheet" href="gamestyles.css">



    <title>Simulation games</title>
</head>

<body>
  <script src="home.php"></script>
  <script src="gamescript.js"></script>


  <!-- Top Header Section -->
  <nav>
    <img src="LOGO.png" alt="Your Logo" class="logo">
    <a href="home.php">Home</a>
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
        <i class="fas fa-user icon"></i>
        <div class="dropdown-content">
        </div>
    </div>
    <a href="basket.php">
    <i class="fas fa-shopping-basket icon"></i>
    </a>
</nav>



  <section class = "sports" title="center">
    <h3>Sports games</h3>
   <p>
    Experience the adrenaline and competition of the sporting world with our dynamic Sports Games collection. Dive into the heart of the action with a variety of games that capture the excitement of your favorite sports. From realistic simulations to exhilarating arcade-style gameplay, our curated selection offers something for every sports enthusiast. Score goals, make epic shots, or compete in thrilling tournaments as you immerse yourself in the fast-paced world of virtual athletics. Whether you're a fan of soccer, basketball, racing, or more, our Sports Games deliver an immersive and thrilling gaming experience. Lace up your virtual shoes, grab your gear, and get ready to take on the challenge!
   </p>

  </section>

  <section id="game-section" class="game-container">
  </section>


<script>
    document.addEventListener('DOMContentLoaded', function() {

    const sportsGames = [
    { title: 'EA Sports FC24', category: 'sports', price: 49.99, imageUrl: 'fifa.jpeg', compatibility:'multiple platforms' ,stockLevel: '5'},
  { title: 'Mario Kart 8 Deluxe', category: 'sports', price: 50.99, imageUrl: 'mario.jpeg', compatibility:'nintendo switch', stockLevel: '15'  },
  { title: 'NBA 2K24', category: 'sports', price: 40.99, imageUrl: 'nba2k24.png', compatibility:'playstation' ,stockLevel: '10' },
  { title: 'Rocket League', category: 'sports', price: 29.99, imageUrl: 'rocket.jpeg',compatibility:'playstation',stockLevel: '15'  },
  { title: 'Wii Sports', category: 'sports', price: 19.99, imageUrl: 'wii.jpeg',compatibility:'nintendo switch',stockLevel: '0'  },
    ];



    function displayGames(gamesToDisplay) {
  const gameSection = document.getElementById('game-section');
  gameSection.innerHTML = '';

  gamesToDisplay.forEach(game => {
      const gameElement = document.createElement('div');
      gameElement.classList.add('game');

  // Determine stock status and color
  let stockStatus;
  let stockColor;
  if (game.stockLevel > 10) {
      stockStatus = 'In Stock';
      stockColor = 'green';  // Green color for "In Stock"
  } else if (game.stockLevel > 0) {
      stockStatus = 'Low Stock';
      stockColor = 'orange'; // Orange color for "Low Stock"
  } else {
      stockStatus = 'Out of Stock';
      stockColor = 'red';    // Red color for "Out of Stock"
  }
      gameElement.innerHTML = `
          <img src="${game.imageUrl}" alt="${game.title}">
          <div class="game-details">
              <h3>${game.title}</h3>
              <p>${game.category}</p>
              <p>${game.compatibility}<p>
              <h4>£${game.price.toFixed(2)}</h4>
              <p style="color: ${stockColor};">Stock: ${stockStatus}</p>
              <button>Add to Cart</button>
          </div>
      `;
      gameSection.appendChild(gameElement);
  });
}


    displayGames(sportsGames);

    document.getElementById('category').addEventListener('change', filterSportsGames);
});

</script>

<script src="home.js"></script>
</body>
<footer>
  <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="games.php">Games</a></li>
      <li><a href="aboutus.php">About Us</a></li>
      <li><a href="contact.php">Contact Us</a></li>
  </ul>
  <div class="footer-social">
    <!-- Add social media icons with links -->
    <a href="https://en-gb.facebook.com/reg/" target="_blank"><i class="fab fa-facebook"></i></a>
    <a href="https://www.linkedin.com/signup" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
    <a href="https://www.instagram.com/accounts/emailsignup/?next=https%3A%2F%2Faccountscenter.instagram.com%2F%3Fentry_point%3Dapp_settings%26__coig_login%3D1" target="_blank"><i class="fab fa-instagram"></i></a>
</div>
  <p>&copy; 2023 PixelPlay28. All rights reserved.</p>
</footer>
</html>
