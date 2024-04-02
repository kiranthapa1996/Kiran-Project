<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <!-- Add any CSS stylesheets or other metadata here -->
</head>
<body>
    <h1>You have been logged out</h1>
    <p>Thank you for using our service. You are now logged out.</p>
    <p><a href="UserLogin.php">Login</a> again</p> <!-- Link to login page -->
    <p><a href="Home.php">Return to Home Page</a></p> <!-- Link to home page -->
</body>
</html>
