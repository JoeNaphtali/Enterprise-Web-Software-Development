<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Gender</th>
            <th>User Role</th>
        </tr>
    </thead>
    <tbody>

        <?php 
        //Get all users from db
        $query = "SELECT * FROM user";
        $select_all_query = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($select_all_query)){
            $User_id = $row['id'];
            $First_name = $row['first_name'];
            $Last_name = $row['last_name'];
            $Email = $row['email'];         
            $Department = $row['department'];
            $Gender = $row['gender'];
            $User_role = $row['user_role'];
        
        //Displaying users

        echo "<tr>";
        echo "<td>{$User_id}</td>";
        echo "<td>{$First_name}</td>";
        echo "<td>{$Last_name}</td>";
        echo "<td>{$Email}</td>";
        echo "<td>{$Department}</td>";
        echo "<td>{$Gender}</td>";
        echo "<td>{$User_role}</td>";
        echo "<td><a href='manageusers.php?delete=$User_id'>Delete</a></td>";
        echo "</tr>";
       
    }

    ?>


    </tbody>
</table>


<?php 
if(isset($_GET['delete'])){
    //Deleting a user
    $delete_user_id = $_GET['delete'];
    $query = "DELETE FROM user WHERE id = {$delete_user_id}";
    $delete_query = mysqli_query($conn, $query);
    
    //Refresh Page after delete
    header("Location: manageusers.php");
    exit();
}
?>