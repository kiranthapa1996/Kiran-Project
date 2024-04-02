<?php
$con = mysqli_connect("localhost","root","","mhsp");

if(!$con)
    die ("Connection Failed".mysqli_connect_error());

$idErr=$message="";

include '../components/adminnavfixed.php';

if (isset($_POST['insert'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $des = $_POST['description'];
    $link = $_POST['link'];
    $cat = $_POST['category'];
    
    //Check if the id is already exists in database
    $checkId = "SELECT * FROM resources WHERE id = ?";
    $checkIdStmt = $con->prepare($checkId);
    $checkIdStmt->bind_param("s", $id);
    $checkIdStmt->execute();
    $checkIdResult = $checkIdStmt->get_result();
    if ($checkIdResult->num_rows > 0) {
        $idErr = "ID already exist";
    }
    $checkIdStmt->close();

    if(empty($idErr)){
    $sql = "INSERT INTO `resources` VALUES ('$id','$title','$cat','$des','$link')";
    $result = $con->query($sql); 
    $message = "Record added successfully.";
    }else{
        echo "Error:" . $sql . "<br>" . $con->error;
    }
}
?>
<section class="update">
    <h3 class="success"><?php echo $message; ?></h3>
    <h1>Please Enter the Details</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="id">ID : </label><input type="number" name="id">
        <span class="error"><?php echo $idErr; ?></span> <br>
        <label for="title">Title : </label><input type="text" name="title">
        <span class="error"></span> <br>
        <label for="category">Category : </label><input type="text" name="category">
        <span class="error"></span> <br>
        <label for="description">Description : </label><textarea id="description" name="description" rows="4"></textarea>
        <span class="error"></span> <br>
        <label for="link">Link : </label><input type="text" name="link">
        <span class="error"></span> <br>
        <input type="submit" name="insert" value="Add">
    </form>
</section>
</body>
</html>