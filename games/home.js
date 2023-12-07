

        document.addEventListener('DOMContentLoaded', function() {
            const accountDropdown = document.getElementById('account-dropdown');
          
            const isSignedIn = false; 
          
            if (isSignedIn) {
                // If signed in, display "Profile" and "Orders" options
                accountDropdown.querySelector('.dropdown-content').innerHTML = `
                    <a href="profile.html">Your Profile</a>
                    <a href="orders.html">Your Orders</a>
                `;
            } else {
                // If not signed in, display "Sign In" option
                accountDropdown.querySelector('.dropdown-content').innerHTML = `
                    <a href="signin.html">Sign In</a>
                `;
            }
        });
        
        const categories = [
        { name: 'Adventure', page: 'adventure.html' },
        { name: 'Adventur', page: 'adventure.html' },
        { name: 'Puzzle', page: 'puzzle.html' },
        { name: 'Puzle', page: 'puzzle.html' },
        { name: 'Board Games', page: 'board.html' },
        {name: 'Board', page: 'board.html' },
        {name: 'Board game', page: 'board.html' },
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

        $(document).ready(function(){
      $('.featured-games-slider').slick({
         slidesToShow: 1,
         slidesToScroll: 1,
         autoplay: true,
         autoplaySpeed: 2500, 
         fade: true, // Enable fade effect
        cssEase: 'linear' ,
         arrows: false, // 
         dots: true, // 
      });
   });
        
