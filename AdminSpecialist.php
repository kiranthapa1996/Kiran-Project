<?php
$con = mysqli_connect("localhost","root","","mhsp");

if(!$con)
    die ("Connection Failed".mysqli_connect_error());

$idErr="";

include '../components/adminnavfixed.php';

    if (isset($_POST['insert'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $pro = $_POST['profession'];
        $phone = $_POST['phone'];
        $add = $_POST['address'];

        //Check if the id is already exists in database
        $checkId = "SELECT * FROM specialist WHERE id = ?";
        $checkIdStmt = $con->prepare($checkId);
        $checkIdStmt->bind_param("s", $id);
        $checkIdStmt->execute();
        $checkIdResult = $checkIdStmt->get_result();
        if ($checkIdResult->num_rows > 0) {
            $idErr = "ID already exist";
        }
        $checkIdStmt->close();

        if(empty($idErr)){
        $sql = "INSERT INTO `specialist` VALUES ('$id','$name','$pro','$phone','$add')";
        $result = $con->query($sql); 
        $message = "Record added successfully.";
        }else{
            $message= "Something went wrong!";
        }
    }
?>
<section class="update">
        <h1>Please Enter the Specialist Details</h1>
        <form action="" method="post">
            <label for="id">ID : </label><input type="number" name="id">
            <span class="error"><?php echo $idErr; ?></span><br>
            <label for="name">Name : </label><input type="text" name="name">
            <span class="error"></span> <br>
            <label for="profession">Profession : </label><input type="text" name="profession">
            <span class="error"></span> <br>
            <label for="phone">Phone : </label><input type="number" name="phone">
            <span class="error"></span> <br>
            <label for="address">Address : </label><input type="text" name="address">
            <span class="error"></span><br>
            <input type="submit" name="insert" value="Add">
        </form>
</section>
    </body>
</html>