<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "Kiran";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu items from the database
$sql = "SELECT id, name, description, price FROM menu";
$result = $conn->query($sql);

$menuItems = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each menu item to the array
        $menuItems[] = $row;
    }
} else {
    // No items found
    $menuItems = [];
}

// Close the database connection
$conn->close();

// Output menu items as JSON
header('Content-Type: application/json');
echo json_encode($menuItems);
?>
