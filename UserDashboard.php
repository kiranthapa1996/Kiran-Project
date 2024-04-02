<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: UserLogin.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            overflow-x: hidden;
        }

        header {
            background: linear-gradient(to right, #333, #1a1a1a);
            color: #fff;
            padding: 15px;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            overflow: auto;
        }

        .logout {
            text-align: right;
            margin-right: 20px;
            float: right;
        }

        .logout a {
            color: #fff;
            text-decoration: none;
            padding: 5px 20px 10px 20px;
            background-color: #d9534f;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .logout a:hover {
            background-color: #c9302c;
        }

        nav {
            width: 250px;
            background-color: #1a1a1a;
            padding-top: 20px;
            position: absolute;
            height: 100%;
            overflow: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        nav a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 15px;
            margin-bottom: 5px;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #333;
        }

    
        section {
            background-image: url("restaurant.jpg");
            width: 100%;
            background-size: cover;
            background-position: center;
            margin-left: 250px;
            padding: 100px;
            color:white;
        }
    </style>

    <script>

    </script>
</head>

<body>

    <header>
        <div class="logout">
            <a href="UserLogout.php">Logout</a>
        </div>
        <h1>Online Food Ordering System</h1>
    </header>

    <nav>
        <a href="Myprofile.php">My Profile</a>
        <a href="Menu.php">Menu</a>
        <a href="favorites.html">favourites</a>
        <a href="getaddtocart.php">My cart</a>
        <a href="getorder.php">My Order</a>
        <a href="reviews.html">reviews</a>
    </nav>
    </nav>

    <section id="home">
        <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    </section>
    <section></section>
    <section></section>

</body>

</html>