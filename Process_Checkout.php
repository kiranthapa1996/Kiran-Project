<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO orders (deliveryAddress, deliveryDate, phoneNumber, paymentMethod) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $deliveryAddress, $deliveryDate, $phoneNumber, $paymentMethod);

// Set parameters and execute the statement
$deliveryAddress = $_POST['deliveryAddress']; // Assuming the form method is POST
$deliveryDate = $_POST['deliveryDate'];
$phoneNumber = $_POST['phoneNumber'];
$paymentMethod = $_POST['paymentMethod'];

$stmt->execute();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Success</title>
<style>
  /* Center the message and buttons on the screen */
  body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .success-message {
    text-align: center;
    margin-bottom: 20px;
  }
  .button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
  }
  .button-container button {
    padding: 10px 20px;
    background-color: yellow;
    color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  .button-container button:hover {
    background-color: darkorange;
  }
</style>
</head>
<body>
<div class="success-message">
  <h2>Order placed successfully!</h2>
  <!-- Additional content if needed -->
</div>
<div class="button-container">
  <button onclick="backToMenu()">Back to Menu</button>
  <button onclick="logout()">Logout</button>
</div>

<script>
  function backToMenu() {
    // Redirect to the menu page
    window.location.href = "Menu.php";
  }

  function logout() {
    // Redirect to the logout page
    window.location.href = "Home.php";
  }
</script>
</body>
</html>
