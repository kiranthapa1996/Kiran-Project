<?php
$con = mysqli_connect("localhost","root","","mhsp");

if(!$con)
    die ("Connection Failed".mysqli_connect_error());

include '../components/adminnavfixed.php';
?>
<section>
<?php 
    $sql = "SELECT id,name, profession ,phone, address FROM specialist";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $sn = 0;
?>
        <h1>Specialist Details</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Profession</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
<?php
        // output data of each row
        while($row = $result->fetch_assoc()) {
?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['profession']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><a class="btn btnupdate" href="updateSpecialist.php?id=<?php echo $row['id']; ?>">Update</a>&nbsp;<a class="btn btndelete" id="<?php echo $row['id']; ?>">Delete</a></td>
            </tr> 
<?php      
        }
    } else {
        echo "<h2>No Results Found!</h2>";
    }
$con->close();
        ?>
    </table>
    <a class="btn add" href="insertSpecialist.php">Add</a>
</section>
<script>
    var x =document.querySelectorAll(".btndelete");
    x.forEach(del => {
        del.addEventListener("click", ()=> {
            var li = del.getAttribute("id");
            var check = confirm("Do you want to delete this data?");
            if(check === true) {
                let file = "delete.php?id="+li+"&tbl=specialist&self=managespecialist";
                window.location.replace(file);
        }
        });

    });
</script>
</body>
</html>