<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
        </tr>
    </thead>
    <tbody>

        <?php 
        //Get all Dates from db
        $query = "SELECT * FROM user WHERE user_role='administrator'";
        $select_all_query = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($select_all_query)){
            $user_id = $row['id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $Email = $row['email'];  
            $Gender = $row['gender'];       
        
        //Displaying dates

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$first_name}</td>";
        echo "<td>{$last_name}</td>";
        echo "<td>{$Email}</td>";
        echo "<td>{$Gender}</td>";
        echo "</tr>";
    }

    ?>


    </tbody>
</table>


