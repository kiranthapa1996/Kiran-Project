<?php
$con = mysqli_connect("localhost","root","","mhsp");

if(!$con)
    die ("Connection Failed".mysqli_connect_error());

include '../components/adminnavfixed.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $pro = $_POST['profession'];
    $phone = $_POST['phone'];
    $add = $_POST['address'];
    $sql = "UPDATE `specialist` SET `name`='$name',`profession`='$pro',`phone`='$phone',`address`='$add' WHERE `id`='$id'"; 
    $result = $con->query($sql); 

    if ($result == TRUE) {
        echo "Record updated successfully.";
    }else{
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `specialist` WHERE `id`='$id'";
    $result = $con->query($sql); 

    if ($result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) {  
            $name = $row['name']; 
            $pro = $row['profession']; 
            $phone = $row['phone'];         
            $add = $row['address'];
        }
?>

<section class="update">
    <div class="container">
        <h1>Please Update the Details</h1>
        <form action="" method="post">
            <label for="id">ID : </label><input type="number" name="id" value="<?php echo $id?>" readonly>
            <span class="error"></span>
            <label for="name">Name : </label><input type="text" name="name" value="<?php echo $name?>">
            <span class="error"></span>
            <label for="profession">Profession : </label><input type="text" name="profession" value="<?php echo $pro?>">
            <span class="error"></span>
            <label for="phone">Phone : </label><input type="number" name="phone" value="<?php echo $phone?>">
            <span class="error"></span>
            <label for="address">Address : </label><input type="text" name="address" value="<?php echo $add?>">
            <span class="error"></span>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</section>
</body>
</html>
<?php
    } else{ 
        header('Location: admin.php');
    } 
}
?> 