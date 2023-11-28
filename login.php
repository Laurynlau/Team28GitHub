<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the user's input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    require_once 'db_connect.php';

    // Build the query
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if a row was returned
    if (mysqli_num_rows($result) == 1) {
        // Get the row data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is valid, set session variables and redirect to logged in page
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['loggedin'] = true;

            // Check if there's a redirect URL in the session
            if (isset($_SESSION['redirect_url'])) {
                // Redirect to the stored URL
                header('Location: ' . $_SESSION['redirect_url']);
            } else {
                // If no redirect URL, go to a default page
                header('Location: homepage.html');
            }
            exit;   
        }
    }

    // Invalid username or password, show error message
    $login_err = 'Invalid username or password.';
}
?>
