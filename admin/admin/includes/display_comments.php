<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Idea</th>
            <th>User ID</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Anonymous</th>
        </tr>
    </thead>
    <tbody>

        <?php 
        //Get all comments from db
        $query = "SELECT * FROM comment";
        $select_all_query = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($select_all_query)){
            $comment_id = $row['id'];
            $idea_id = $row['idea_id'];
            $comment_user_id = $row['user__id'];
            $comment_content = $row['content'];         
            $comment_date = $row['comment_date'];
        
        //Displaying comments

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        
        //Getting idea title based off idea_id
        $query = "SELECT * FROM idea WHERE id = $idea_id";
        $select_idea_id  = mysqli_query($conn, $query);
        
        while($row = mysqli_fetch_assoc($select_idea_id)){
            $idea_id_new = $row['id'];
            $idea_title = $row['idea_title'];
            echo "<td><a href='../post.php?i_id=$idea_id_new'>{$idea_title}</a></td>";
        }
        //Displaying comments continue
        echo "<td>{$comment_user_id}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
        echo "</tr>";
    }

    ?>


    </tbody>
</table>


<?php 
if(isset($_GET['delete'])){
    //Deleting a comment
    $delete_comment_id = $_GET['delete'];
    $query = "DELETE FROM comment WHERE id = {$delete_comment_id}";
    $delete_query = mysqli_query($conn, $query);
    
    //Refresh Page after delete
    header("Location: comments.php");
    
}
?>