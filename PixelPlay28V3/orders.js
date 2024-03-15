document.addEventListener('DOMContentLoaded', function () {
    // Add an event listener to all stars
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = star.getAttribute('data-rating');
            const gameId = star.parentElement.getAttribute('data-game-id');

            // Toggle 'active' class for clicked star and previous stars
            const siblings = Array.from(star.parentElement.children);
            siblings.forEach(sibling => {
                sibling.classList.remove('active');
                if (parseInt(sibling.getAttribute('data-rating')) <= rating) {
                    sibling.classList.add('active');
                }
            });
        });
    });
});

// Function to submit the review
function submitReview(gameId) {
    const selectedRating = document.querySelector(`.game-rating[data-game-id="${gameId}"] .star.active`).getAttribute('data-rating');
    const reviewText = document.getElementById(`review${gameId}`).value;


    console.log(`Rating for ${gameId}:`, selectedRating);
    console.log(`Review for ${gameId}:`, reviewText);
}


  

