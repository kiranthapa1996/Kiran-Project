<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    // SQL query to update user data by name
    $sql = "UPDATE user_data SET email='$email' WHERE name='$name'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Check if the user name is provided in the URL
if (isset($_GET['name'])) {
    $name = $_GET['name'];

    // SQL query to fetch user data by name
    $sql = "SELECT * FROM user_data WHERE name='$name'";
    $result = $conn->query($sql);

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <!-- HTML form for updating user data -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" readonly><br>
            Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
            <input type="submit" value="Update">
        </form>
<?php
    } else {
        echo "User not found";
    }
} else {
    echo "User name not provided";
}

// Close connection
$conn->close();
?>
