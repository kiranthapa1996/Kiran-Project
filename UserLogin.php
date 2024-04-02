<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "Kiran";

// Create connection
$con = new mysqli($servername, $username, $password, $database);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Define variables to store user input for login
$logEmail = $logPassword = "";

// Define variables to store error messages for login
$logPasswordErr = "";

// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

    $logEmail = test_input($_POST["logEmail"]);
    $logPassword = test_input($_POST["logPassword"]);

    // Retrieve hashed password and name from the database based on the entered Email
    $stmt = $con->prepare("SELECT password, name FROM user_data WHERE email = ?");
    $stmt->bind_param("s", $logEmail);
    if ($stmt->execute()) {
        $stmt->bind_result($hashedPassword, $name);
        if ($stmt->fetch()) {
            // Password is correct, redirect to the home page or perform other actions
            if (password_verify($logPassword, $hashedPassword)) {
                session_start();
                $_SESSION["username"] = $name; // Store the name in the session variable
                $_SESSION["role"] = 1;
                header("Location: UserDashboard.php");
                exit();
            } else {
                // Password is incorrect
                $logPasswordErr = "Incorrect password or blank password";
            }
        } else {
            // No user found with the provided email
            $logPasswordErr = "No user found with this email";
        }
    } else {
        // Error executing the query
        die("Error executing the query: " . $stmt->error);
    }
    $stmt->close();
}

// Function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div id="login-form" class="container">
        <h2>User Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
            <!-- Login form fields go here -->
            <label for="logEmail">Email:</label>
            <input type="text" name="logEmail" id="logEmail" value="<?php echo $logEmail; ?>">
            <span class="error" id="logEmailErr"></span>
            <br><br>

            <label for="logPassword">Password:</label>
            <input type="password" name="logPassword" id="logPassword" value="<?php echo $logPassword; ?>">
            <span class="error" id="logPasswordErr"><?php echo $logPasswordErr; ?></span>
            <br><br>

            <input class="submit-button" type="submit" name="login" value="Login">
            <br>

            <p>Don't have an account? <a class="toggle-button" href="UserSignup.php">Click here</a> to Signup.</p>
        </form>
    </div>
</body>
</html>
