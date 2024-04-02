<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set the timezone to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');

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

// Retrieve data from AJAX request
$itemId = $_POST['itemId']; // Assuming you receive item ID from the form
$addedDateTime = date("Y-m-d H:i:s"); // Get the current date and time in the correct timezone

// Fetch data from the menu table based on the item ID
// Prepare and execute SQL statement to get item details from the menu table
$stmt = $conn->prepare("SELECT name, price, description FROM menu WHERE id = ?");
$stmt->bind_param("i", $itemId); // Assuming `id` is the primary key column in your `menu` table
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch item details
    $row = $result->fetch_assoc();
    $itemName = $row['name'];
    $itemPrice = $row['price'];
    $itemDescription = $row['description'];

    // Insert data into the favorites table
    $sql = "INSERT INTO favorites (item_id, item_name, item_price, item_description, date_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Check if the statement preparation was successful
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    
    // Bind parameters to the prepared statement
    $stmt->bind_param("issss", $itemId, $itemName, $itemPrice, $itemDescription, $addedDateTime);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Item added to favorites successfully.";
    } else {
        echo "Error adding item to favorites: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>
