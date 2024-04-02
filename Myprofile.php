<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  // Redirect the user to the login page if not logged in
  header("Location: UserLogin.php");
  exit();
}

// Database connection parameters
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

// Get the username of the logged-in user
$username = $_SESSION['username'];

// SQL query to fetch user data based on the logged-in username
$sql = "SELECT * FROM user_data WHERE name = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output data of the logged-in user
  while ($row = $result->fetch_assoc()) {
    // Check if the "id" key exists in the current row
    if (isset($row['ID'])) {
      echo "<div class='container'>";
      echo "<div class='content'>";
      echo "<div class='info'>";
      echo "<div class='name'>Name: " . $row["name"] . "</div>";
      echo "<div>Email: " . $row["email"] . "</div>";
      echo "</div>";
      echo "<div class='buttons'>";
      echo "<a href='UserDashboard.php' class='back-button'>Back</a>";
      echo "<a href='update.php?ID=" . $row["ID"] . "' class='button'>Update</a>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
  }
} else {
  echo "0 results";
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      background-image: url("home_bg.jpg");
    }

    .container {
      display: flex;
      flex-direction: column;
      /* Stack children vertically */
      align-items: center;
      /* Center children horizontally */
      border: 3px solid white;
      padding: 30px;
    }

    .content {
      text-align: center;
    }

    .info {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 10px;
      color:white;
      margin-left:10px;
    }
    .name{
      margin-right: 170px;
    }

    .buttons {
      display: flex;
      margin-left: 50px;
   
    }

    .button,
    .back-button {
      padding: 8px 16px;
      border: 2px solid black;
      text-decoration: none;
      background-color: white;
      color: black;
    }

    .button:hover,
    .back-button:hover {
      background-color: yellow;
    }

    .back-button {
      margin-right: 10px;
      /* Add space between the buttons */
    }
  </style>

  </style>
  </body>

</html>