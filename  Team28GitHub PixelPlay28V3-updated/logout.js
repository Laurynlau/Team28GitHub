function logout() {

    $.ajax({
        url: 'logout.php',
        method: 'POST',
        async: false,
        success: function(response) {
            window.location.href = 'login.php';
        }
    });
}

window.addEventListener('beforeunload', function(event) {
    logout();
});
