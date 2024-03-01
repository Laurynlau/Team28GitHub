<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "db_connect.php";

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    $checkQuery = "SELECT * FROM users WHERE email = :email OR username = :username";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->bindParam(':username', $username);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        echo "Email or username already exists. Please choose a different one.";
    } else {
        $insertQuery = "INSERT INTO users (username, email, password, date_joined, user_role) VALUES (:username, :email, :password, NOW(), 'customer')";
        $insertStmt = $db->prepare($insertQuery);
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':password', $password);

        try {
            $insertStmt->execute();
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $username;
            header("Location: home.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
