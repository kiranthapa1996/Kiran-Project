<?php
    $con = mysqli_connect("localhost","root","","Kiran");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());
    include '../components/adminnavfixed.php';
?>
<section class="dashboard">
        <h1>Welcome Back, <?php echo $_SESSION["username"] ?>!</h1>
    <div class="container">
        <div class="dash-box">
            <h3>Number of Registered Users : <?php number("users") ?></h3>
            <a href="manageusers.php">Users</a>
        </div>
        <div class="dash-box">
            <h3>Number of Resources : <?php number("resources") ?></h3>
            <a href="manageresources.php">Resources</a>
        </div>
        <div class="dash-box">
            <h3>Number of Specialists : <?php number("specialist") ?></h3>
            <a href="managespecialist.php">Specialists</a>
        </div>
    </div>
</section>


<?php 
    function number($id) {
        $con = mysqli_connect("localhost","root","","Kiran");
        $sql = "SELECT * FROM $id";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        echo $num;
        mysqli_close($con);
    }
?>