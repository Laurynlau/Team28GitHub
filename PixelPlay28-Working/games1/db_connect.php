<?php
$servername = "localhost";
$db_username = "u-220149873";
$db_password = "cqvMs8449OfaZ5Q";
$dbname = "u_220149873_db_pixel_play_28";

// Create connection
$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
