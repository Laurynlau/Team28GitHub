<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'connectdb.php';

    $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['loggedin'] = true;

            if (isset($_SESSION['redirect_url'])) {
                header('Location: ' . $_SESSION['redirect_url']);
            } else {
                header('Location: homepage.html');
            }
            exit;
        }
    }

    $login_err = 'Invalid username or password.';

    $stmt->close();
}
?>
