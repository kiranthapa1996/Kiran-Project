<?php
$con = mysqli_connect("localhost","root","","Kiran");

if(!$con)
    die ("Connection Failed".mysqli_connect_error());

include '../components/adminnavfixed.php';

$message="";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $des = $_POST['description'];
    $link = $_POST['link'];
    $cat = $_POST['category'];
    $sql = "UPDATE `resources` SET `title`='$title',`category`='$cat',`description`='$des',`link`='$link' WHERE `id`='$id'"; 
    $result = $con->query($sql); 

    if ($result == TRUE) {
        $message = "Record added successfully.";
    }else{
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `resources` WHERE `id`='$id'";
    $result = $con->query($sql); 

    if ($result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];          
            $des = $row['description'];           
            $link = $row['link'];
            $cat = $row['category'];
        }
?>
<section class="update">
    <div class="container">
        <h3 class="success"><?php echo $message; ?></h3>
        <h1>Please Update the Details</h1>
        <form action="" method="post">
            <label for="id">ID : </label><input type="number" name="id" value="<?php echo $id?>" readonly>
            <span class="error"></span>
            <label for="title">Title : </label><input type="text" name="title" value="<?php echo $title?>">
            <span class="error"></span>
            <label for="category">Category : </label><input type="text" name="category" value="<?php echo $cat?>">
            <span class="error"></span>
            <label for="description">Description : </label><textarea id="description" name="description" rows="4"><?php echo $des?></textarea>
            <span class="error"></span>
            <label for="link">Link : </label><input type="text" name="link" value="<?php echo $link?>">
            <span class="error"></span>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</section>
</body>
</html>
<?php
    } else{ 
        header('Location: UserDashboard.php');
    } 
}
?> 