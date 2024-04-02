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

// Fetch favorite items from the database
$sql = "SELECT * FROM favorites";
$result = $conn->query($sql);

$favorites = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add each favorite item to the array
        $favorites[] = $row;
    }
}

// Close the database connection
$conn->close();

// Output favorite items as JSON
header('Content-Type: application/json');
echo json_encode($favorites);
?>
