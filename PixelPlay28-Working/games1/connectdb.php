<?php
// Uncomment appropriate credentials.
// Debug
// $dbServername = "localhost";
// $dbUsername = "root";
// $dbPassword = "";
// $dbName = "teamprojectv3";

// Deployment
$dbServername = "localhost";
$dbUsername = "u-220149873";
$dbPassword = "cqvMs8449OfaZ5Q";
$dbName = "u_220149873_db_pixel_play_28";

// Create connection
try {
    $db = new PDO("mysql:host=$dbServername;dbname=$dbName", $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
