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

$regName = $regEmail = $regPassword = $confirmPassword = "";
$regEmailErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Validate and sanitize form inputs
    $regName = test_input($_POST["regName"]);
    $regEmail = test_input($_POST["regEmail"]);
    $regPassword = test_input($_POST["regPassword"]);
    $confirmPassword = test_input($_POST["confirmPassword"]);

    // Check if email is already taken
    $checkEmailQuery = "SELECT * FROM user_data WHERE email = ?";
    $checkEmailStmt = $con->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $regEmail);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();
    if ($checkEmailResult->num_rows > 0) {
        $regEmailErr = "Email is already taken";
    }
    $checkEmailStmt->close();

    // If no email error, insert data into database
    if (empty($regEmailErr)) {
        $hashedPassword = password_hash($regPassword, PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO user_data (name, email, password) VALUES (?, ?, ?)";
        $insertStmt = $con->prepare($insertQuery);
        $insertStmt->bind_param("sss", $regName, $regEmail, $hashedPassword);
        if ($insertStmt->execute()) {
            // Registration successful
            $_SESSION["username"] = $regName;
            header("Location: UserLogin.php"); // Redirect to login page
            exit();
        } else {
            // Handle database insertion error
            echo "Error: " . $insertStmt->error;
        }
        $insertStmt->close();
    }
}

// Function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="form.css">
    <script>
        
        
        function validateForm() {
            var regName = document.getElementById("regName").value;
            var regEmail = document.getElementById("regEmail").value;
            var regPassword = document.getElementById("regPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            // Reset previous error messages
            document.getElementById("regNameErr").innerText = "";
            document.getElementById("regEmailErr").innerText = "";
            document.getElementById("regPasswordErr").innerText = "";
            document.getElementById("confirmPasswordErr").innerText = "";

            // Validate Name
            if (regName === "") {
                document.getElementById("regNameErr").innerText = "Name is required";
                return false;
            }

            var nameFormat = /^[a-zA-Z]+[a-zA-Z\s]*?[^0-9]$/;
            if (!(regName.match(nameFormat))) {
                document.getElementById("regNameErr").innerText = "Enter a valid name";
                return false;
            }

            // Validate Email
            if (regEmail === "") {
                document.getElementById("regEmailErr").innerText = "Email is required";
                return false;
            }

            var mailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/;
            if(!(regEmail.match(mailFormat)))
            {
                document.getElementById("regEmailErr").innerText = "Please enter a valid email";
                return false;
            }

            // Validate Password
            if (regPassword === "") {
                document.getElementById("regPasswordErr").innerText = "Password is required";
                return false;
            }
            var passStrength = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
            if(!(regPassword.match(passStrength)))
            {
                document.getElementById("regPasswordErr").innerText = "Password must contain atleast 8 characters with atleast one uppercase, one lowercase, one digit and one special character.";
                return false;
            }

            if(regPassword.length<8){
                document.getElementById("regPasswordErr").innerText = "Password must be at least 8 characters long";
                return false;
            }

            // Validate Confirm Password
            if (confirmPassword === "") {
                document.getElementById("confirmPasswordErr").innerText = "Please confirm the password";
                return false;
            }

            // Check if Passwords match
            if (regPassword !== confirmPassword) {
                document.getElementById("confirmPasswordErr").innerText = "Passwords do not match";
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<div id="registration-form" class="container">
    <h2>User Registration</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
        <!-- Registration form fields go here -->
        <label for="regName">Name:</label>
        <input type="text" name="regName" id="regName" value="<?php echo $regName; ?>">
        <span class="error" id="regNameErr"></span>
        <br><br>

        <label for="regEmail">Email:</label>
        <input type="text" name="regEmail" id="regEmail" value="<?php echo $regEmail; ?>">
        <span class="error" id="regEmailErr"><?php echo $regEmailErr; ?></span>
        <br><br>


        <label for="regPassword">Password:</label>
        <input type="password" name="regPassword" id="regPassword" value="<?php echo $regPassword; ?>">
        <span class="error" id="regPasswordErr"></span>
        <br><br>

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword" value="<?php echo $regPassword; ?>">
        <span class="error" id="confirmPasswordErr"></span>
        <br><br>

        <input class="submit-button" type="submit" name="register" value="Register">
        <br>

        <p>Already have an account? <a class="toggle-button" href="UserLogin.php">Click here</a> to log in.</p>

    </form>
</div>
</body>
</html>