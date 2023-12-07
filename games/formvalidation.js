document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Perform form validation here before submitting to the server
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username.trim() === '' || password.trim() === '') {
            alert('Please fill in all fields.');
            return;
        }

        // If validation passes, you can submit the form to the server
        // Example: form.submit();
    });
});
