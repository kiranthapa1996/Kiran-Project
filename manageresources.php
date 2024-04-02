<?php
$con = mysqli_connect("localhost","root","","mhsp");

if(!$con)
    die ("Connection Failed".mysqli_connect_error());

include '../components/adminnavfixed.php';
?>
<section>
<?php 
    $sql = "SELECT id,title,category,description,link FROM resources";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $sn = 0;
?>
    <h1>Resources Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
<?php       
        // output data of each row
        while($row = $result->fetch_assoc()) {
?>
            <tr>
            <td><?php echo $row['id']; ?></td>
            <?php echo "<td><a href='".$row["link"]."' target='_'>".$row["title"]."</a></td>" ?>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><a class="btn btnupdate" href="updateResources.php?id=<?php echo $row['id']; ?>">Update</a>&nbsp;<a class="btn btndelete" id="<?php echo $row['id']; ?>">Delete</a></td>         
            </tr> 
<?php      
        }
    } else {
        echo "<h2>No Results Found!</h2>";
    }
$con->close();
?>

    </table>
    <a class="btn add" href="insertResources.php">Add</a>
</section>
<script>
    var x =document.querySelectorAll(".btndelete");
    x.forEach(del => {
        del.addEventListener("click", ()=> {
            var li = del.getAttribute("id");
            var check = confirm("Do you want to delete this data?");
            if(check === true) {
                let file = "delete.php?id="+li+"&tbl=resources&self=manageresources";
                window.location.replace(file);
            }
        });
    });
</script>
</body>
</html>