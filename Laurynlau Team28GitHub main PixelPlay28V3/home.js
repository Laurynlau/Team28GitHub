

        document.addEventListener('DOMContentLoaded', function() {
            const accountDropdown = document.getElementById('account-dropdown');

            const isSignedIn = false;

            if (isSignedIn) {
                // If signed in, display "Profile" and "Orders" options
                accountDropdown.querySelector('.dropdown-content').innerHTML = `
                    <a href="profile.html">Your Profile</a>
                    <a href="orders.php">Your Orders</a>
                `;
            } else {
                // If not signed in, display "Sign In" option
                accountDropdown.querySelector('.dropdown-content').innerHTML = `
                    <a href="Login.php">Sign In</a>
                `;
            }
        });

        const categories = [
        { name: 'Adventure', page: 'adventure.php' },
        { name: 'Adventur', page: 'adventure.php' },
        { name: 'Puzzle', page: 'puzzle.php' },
        { name: 'Puzle', page: 'puzzle.php' },
        { name: 'Board Games', page: 'board.php' },
        {name: 'Board', page: 'board.php' },
        {name: 'Board game', page: 'board.php' },
        { name: 'Simulation', page: 'simulation.php' },
        { name: 'Sports', page: 'sports.php' },
        { name: 'Sport', page: 'sports.php' }
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
         autoplaySpeed: 3000,
         fade: true, // Enable fade effect
        cssEase: 'linear' ,
         arrows: false, //
         dots: true, //
      });
   });



   