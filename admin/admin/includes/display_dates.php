<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Idea Title</th>
            <th>Idea</th>
            <th>Post Date</th>
        </tr>
    </thead>
    <tbody>

        <?php 
        //Get all Dates from db
        $query = "SELECT * FROM idea";
        $select_all_query = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($select_all_query)){
            $idea_id = $row['id'];
            $idea_Title = $row['idea_title'];
            $idea = $row['content'];
            $post_date = $row['post_date'];         
        
        //Displaying dates

        echo "<tr>";
        echo "<td>{$idea_id}</td>";
        echo "<td>{$idea_Title}</td>";
        echo "<td>{$idea}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='Date.php?delete=$idea_id'>Delete</a></td>";
        echo "</tr>";
    }

    ?>


    </tbody>
</table>


<?php 
if(isset($_GET['delete'])){
    //Deleting a post
    $delete_idea_id = $_GET['delete'];
    $query = "DELETE FROM idea WHERE id = {$delete_idea_id}";
    $delete_query = mysqli_query($conn, $query);
    
    //Refresh Page after delete
    header("Location: Date.php");
    
}
?>