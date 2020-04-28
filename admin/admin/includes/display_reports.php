<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Department</th>
            <th>Number of Ideas</th>
            <th>Percentage of Ideas</th>
            <th>Number of Contributors</th>
        </tr>
    </thead>
    <tbody>
      <?php
                
              
            //Get Departsments from db
            $query = "SELECT * FROM department";
            $select_all_query = mysqli_query($conn, $query);

            while($row = mysqli_fetch_assoc($select_all_query)){

                $id = $row['id'];
                $department_name = $row['department_name'];
                 
                //$idea_title =$row['idea_title'];
    
                //Displaying departments
    
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$department_name}</td>";
               
                 
                $department_id = "";
                if(isset($_GET['department_id'])) {
                   
                    $department_id = $_GET['department_id'];  
                }
                         
                $query= "SELECT count(idea_title) AS total FROM idea WHERE id= '$department_id'";
                $result= mysqli_query($conn,$query);
                $values= mysqli_fetch_assoc($result);
                $num_rows=$values['total'];
                echo "<td>{$num_rows}</td>";
               
                //display percentage of ideas per department
                $query= "SELECT count(idea_title) AS total FROM `idea`";
                $result= mysqli_query($conn,$query);
                $values= mysqli_fetch_assoc($result);
                $num_rows=$values['total']/100*100 . '%';
                echo "<td>{$num_rows}</td>";
                 //display contributors 
                 $query= "SELECT count(user__id) AS total FROM `idea`";
                 $result= mysqli_query($conn,$query);
                 $values= mysqli_fetch_assoc($result);
                 $num_rows=$values['total'];
                 echo "<td>{$num_rows}</td>";
                echo "</tr>";  
              
            }
        ?>

    </tbody>
</table>