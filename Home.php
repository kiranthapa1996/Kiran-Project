<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            padding: 0;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }


        header {
            background-color: black;
            color: white;
            padding: 0.2rem;
            text-align: center;
        }

        header img.leftimage {
            max-width: 50%;
            height: 70px;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            margin: 0.5rem;
        }

        header img.rightimage {
            max-width: 50%;
            height: 70px;
            border-radius: 50%;
            position: absolute;
            top: 0;
            right: 0;
            margin: 0.5rem;
        }


        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            margin: 0 1rem;
            font-weight: bold;

        }

        .navbar {
            background-color: #555;
            padding: 0.5rem;
            text-align: right;
        }

        ul {
            list-style-type: none;
            display: flex;
        }

        li {
            margin-right: 2px;
        }

        li.left {
            margin-right: auto;

        }

        a:hover {
            color: #ffc107;
        }

        section {
            background-image: url("Food1.jpg");
            height: 150px;
            padding: 250px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            position: fixed;

        }

        h2 {
            color: black;
            font-size: 3rem;
            margin-left: 140px;
            justify-content: left;
        }

        footer {
            background-color: rgb(22, 23, 24);
            color: white;
            padding: 1rem;
            position: fixed;
            text-align: center;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>Food Ordering System</h1>
        <img class="leftimage" src="Online.png" alt="Left image">
        <img class="rightimage" src="Online.png" alt="Right Image">
    </header>

    <nav class="navbar">
        <ul>
            <li class="left"><a href="AdminLogin.php">Admin Login</a></li>
            <li><a href="About.php">About</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
            <li><a href="Restaurant.php">Add Restaurant</a></li>
            <li><a href="UserLogin.php">Login</a></li>

        </ul>
    </nav>
    <section>
        <div>
            <h2>Order food from the widest range of restaurants.</h1>
        </div>
    </section>
    <footer>
        &copy; 2024 Food Ordering System
    </footer>

</body>

</html>