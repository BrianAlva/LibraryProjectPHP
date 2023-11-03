<?php
$servername = "localhos";
$username = "User";
$password = "word";
$database = "database";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
