<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: UserDashboard.php");
    exit();
}

// Include database connection
include_once "db_connection.php";

// Retrieve the value of the 'section' parameter from the URL
$section = isset($_GET['section']) ? $_GET['section'] : '';

// Now you can use the $section variable to determine the action to take
// For example:
if ($section === 'profile') {
    // Prepare and execute SQL query to retrieve user profile information
    $sql = "SELECT name, email, phone FROM user_data WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Check if the prepare() call was successful
    if ($stmt) {
        // Bind value and execute the statement
        $stmt->bindValue(1, $_SESSION['email'], PDO::PARAM_STR);
        $stmt->execute();

        // Fetch user profile data
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Return user profile data as JSON
            echo json_encode($result);
        } else {
            echo json_encode(array('error' => 'User profile not found.'));
        }
    } else {
        echo json_encode(array('error' => 'Error preparing SQL statement.'));
    }

    // Close the statement
    unset($stmt);
} else {
    echo json_encode(array('error' => 'Invalid section specified.'));
}

// Close database connection
$conn = null;
?>
