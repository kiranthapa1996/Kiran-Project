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

// Retrieve item ID from the POST data
$itemId = $_POST['itemId'];

// Prepare and execute SQL statement to delete the item from the favorites table
$stmt = $conn->prepare("DELETE FROM favorites WHERE item_id = ?");
$stmt->bind_param("i", $itemId);
$result = $stmt->execute();

// Check if deletion was successful
if ($result) {
    // Return success response to the client
    echo json_encode(array("success" => true));
} else {
    // Return error response to the client
    echo json_encode(array("success" => false, "message" => "Error deleting favorite item."));
}

$stmt->close();
$conn->close();
?>
