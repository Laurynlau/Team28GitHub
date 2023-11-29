
// script.js
document.addEventListener('DOMContentLoaded', function() {
  const accountDropdown = document.getElementById('account-dropdown');

  // Check if the user is signed in (you'll need to implement the actual logic)
  const isSignedIn = false; // Replace with your sign-in check logic

  if (isSignedIn) {
      // If signed in, display "My Profile" and "My Orders" options
      accountDropdown.querySelector('.dropdown-content').innerHTML = `
          <a href="#">My Profile</a>
          <a href="orders.html">My Orders</a>
      `;
  } else {
      // If not signed in, display "Sign In" option
      accountDropdown.querySelector('.dropdown-content').innerHTML = `
          <a href="#">Sign In</a>
      `;
  }
});

const categories = [
  { name: 'Adventure', page: 'adventure.html' },
  { name: 'Puzzle', page: 'puzzle.html' },
  { name: 'Board Games', page: 'board.html' },
 { name: 'Board', page: 'board.html' },
  { name: 'Simulation', page: 'simulation.html' },
  { name: 'Sports', page: 'sports.html' },
  { name: 'Sport', page: 'sports.html' }
];

function searchProducts() {
  const userInput = document.getElementById('searchInput').value.trim().toLowerCase();

  if (userInput !== '') {
      const matchingCategory = categories.find(category =>
          category.name.toLowerCase() === userInput
      );

      if (matchingCategory) {
          window.location.href = matchingCategory.page;
      } else {
          alert('Category not found. Please try again.');
      }
  } else {
      alert('Please enter a category.');
  }
}


document.addEventListener('DOMContentLoaded', function (){
  let slideIndex = 0;
  showSlides();

  function showSlides() {
    let i;
    const slides = document.getElementsByClassName('slide');
    const dots = document.getElementsByClassName('dot');
    
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
    }
    
    slideIndex++;
    
    if (slideIndex > slides.length) {
      slideIndex = 1;
    }
    
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(' active', '');
    }
    
    slides[slideIndex - 1].style.display = 'block';
    dots[slideIndex - 1].className += ' active';
    
    setTimeout(showSlides, 5000); // Change slide every 5 seconds
  }
});

const games = [
  { title: ' The Legend of Zelda: Breath of the Wild', category: 'adventure', price: 45.99, imageUrl: 'game1.jpg', compatibility:' nintendo switch',stockLevel: '7'},
  { title: 'Cities: Skylines', category: 'simulation', price: 39.99, imageUrl: 'cities.jpg',compatibility:'multiple platforms',stockLevel: '15' },
  { title: 'EA Sports FC24', category: 'sports', price: 49.99, imageUrl: 'fifa.jpeg', compatibility:'multiple platforms' ,stockLevel: '5'},
  { title: 'Mario Kart 8 Deluxe', category: 'sports', price: 50.99, imageUrl: 'mario.jpeg', compatibility:'nintendo switch', stockLevel: '15'  },
  { title: 'Uncharted 4: A Thiefs End', category: 'adventure', price: 39.99, imageUrl: 'game3.jpg' , compatibility:'playstation',stockLevel: '15' },
  { title: 'Ticket to Ride', category: 'board', price: 25.99, imageUrl: 'ticket_to_ride.jpg',compatibility:'multiple platforms',stockLevel: '15'  },
  { title: 'NBA 2K24', category: 'sports', price: 40.99, imageUrl: 'nba2k24.png', compatibility:'playstation' ,stockLevel: '10' },
  { title: 'Splendor', category: 'board', price: 24.99, imageUrl: 'game8.jpg.webp', compatibility:'multiple platforms' ,stockLevel: '15' },
  { title: 'Firewatch', category: 'adventure', price: 24.99, imageUrl: 'firewatch.webp',compatibility:'multiple platforms',stockLevel: '15'  },
  { title: 'Carcassonne', category: 'board', price: 35.99, imageUrl: 'game9.jpg', compatibility:'multiple platforms ',stockLevel: '15' },
  { title: 'Pandemic: The Board Game', category: 'board', price: 44.99, imageUrl: 'game10.jpg',compatibility:'multiple platforms',stockLevel: '9'  },
  { title: 'Journey', category: 'adventure', price: 19.99, imageUrl: 'game2.avif',compatibility:'playstation',stockLevel: '15'  },
  { title: 'Tetris Effect', category: 'puzzle', price: 19.99, imageUrl: 'tetris.jpg', compatibility:'multiple platforms',stockLevel: '15'  },
  { title: 'Portal 2', category: 'puzzle', price: 35.99, imageUrl: 'portal.jpeg' ,compatibility:'XBox',stockLevel: '15' },
  { title: 'Catan Universe', category: 'board', price: 35.99, imageUrl: 'Catan_Universe.jpg',compatibility:'multiple platforms',stockLevel: '15'  },
  { title: 'The Witness', category: 'puzzle', price: 29.99, imageUrl: 'witness.png' ,compatibility:'multiple platforms',stockLevel: '15' },
  { title: 'Shadow of the Colossus', category: 'adventure', price: 29.99, imageUrl: 'game5.jpg' ,compatibility:'playstation',stockLevel: '15' },
  { title: 'Baba is You', category: 'puzzle', price: 22.99, imageUrl: 'baba.jpg' ,compatibility:'multiple platforms',stockLevel: '5' },
  { title: 'The Sims 4', category: 'simulation', price: 49.99, imageUrl: 'thesims.jpg',compatibility:'multiple platforms',stockLevel: '15'  },
  { title: 'Monument Valley', category: 'puzzle', price:11.99, imageUrl: 'monument.jpg',compatibility:'multiple platforms' ,stockLevel: '15' },
  { title: 'Microsoft Flight Simulator', category: 'simulation', price: 59.99, imageUrl: 'flight.jpeg',compatibility:'PC, XBox',stockLevel: '15'  },
  { title: 'Stellaris', category: 'simulation', price: 39.99, imageUrl: 'stellaris.png',compatibility:'playstation',stockLevel: '15'  },
  { title: 'Rocket League', category: 'sports', price: 29.99, imageUrl: 'rocket.jpeg',compatibility:'playstation',stockLevel: '15'  },
  { title: 'Wii Sports', category: 'sports', price: 19.99, imageUrl: 'wii.jpeg',compatibility:'nintendo switch',stockLevel: '0'  },
  { title: 'Planet Zoo', category: 'simulation', price: 15.99, imageUrl: 'zoo.jpeg',compatibility:'multiple platforms',stockLevel: '15'  },

];




// Function to filter games based on category and price range
function filterGames() {
  const categoryFilter = document.getElementById('category').value;
  const priceRangeFilter = document.getElementById('price-range').value;

  const filteredGames = games.filter(game => {
      const categoryMatch = categoryFilter === 'all' || game.category === categoryFilter;
      const priceMatch = priceRangeFilter === 'all' || getPriceRange(game.price) === priceRangeFilter;

      return categoryMatch && priceMatch;
  });

  displayGames(filteredGames);
}

// Function to display games on the page
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
              <h4>${game.title}</h4>
              <p>${game.category}</p>
              <p>${game.compatibility}<p>
              <h6>£${game.price.toFixed(2)}</h6>
              <p style="color: ${stockColor};"> ${stockStatus}</p>  
              <button>Add to Cart</button>
          </div>
      `;
      gameSection.appendChild(gameElement);
  });
}

// Function to get the price range for a game
function getPriceRange(price) {
  if (price < 20) {
      return '0-20';
  } else if (price < 40) {
      return '20-40';
  } else {
      return '40+';
  }
}

// Initial display of games
displayGames(games);

// Event listeners for filter changes
document.getElementById('category').addEventListener('change', filterGames);
document.getElementById('price-range').addEventListener('change', filterGames);




