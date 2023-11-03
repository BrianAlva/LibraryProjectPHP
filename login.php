<?php
include "db_config.php"; // Include the database configuration file

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform authentication using the database connection
    $sql = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        header("Location: welcome.php"); // Redirect to a welcome page
        exit();
    } else {
        // Invalid credentials, display an error message
        echo "Invalid username or password. Please try again.";
    }
}
?>

<!-- Create a simple HTML page for a failed login -->
<!DOCTYPE html>
<html>
<head>
    <title>Login Failed</title>
</head>
<body>
    <h2>Login Failed</h2>
    <p>Invalid username or password. Please try again.</p>
    <a href="login.html">Go back to login</a>
</body>
</html>