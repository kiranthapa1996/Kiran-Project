<?php 
    $con = mysqli_connect("localhost","root","","Kiran");
    if(!$con)
        die ("Connection Failed".mysqli_connect_error());

    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $tbl = $_GET['tbl'];
        $page = $_GET['self'];
        $sql = "DELETE FROM `$tbl` WHERE `id`='$user_id'";
        $result = $con->query($sql);

        if ($result == TRUE) {
            header("Location: $page.php");
        }else{
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
?>