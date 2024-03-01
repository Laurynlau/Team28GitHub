<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "db_connect.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT user_id, email, username, password FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashedPassword = $user['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $user["username"];
            header("Location: home.php");
            exit();
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }
}
?>
