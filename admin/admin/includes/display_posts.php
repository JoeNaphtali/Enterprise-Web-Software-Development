<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Title</th>
            <th>User ID</th>
            <!--            <th>User</th>-->
            <th>Date</th>
            <!--            <th>Attachment</th>-->
            <th>Content</th>
            <th>Comments</th>
            <th>View Count</th>
            <th>Up Votes</th>
            <th>Down Votes</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
       //Getting idaes from db
    $query = "SELECT * FROM idea";
    $select_all_query = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_all_query)){
        $idea_id = $row['id'];
        $idea_category_id = $row['category_id'];
        $idea_title = $row['idea_title'];
        $idea_user_id = $row['user__id'];
//        $idea_user = $row['post_user'];                                
        $idea_date = $row['post_date'];
//        $idea_attachment = $row['attachment'];
        $idea_content = $row['content'];
        $idea_comment_count = $row['comment_count'];
        $idea_view_count = $row['view_count'];
        $idea_thumbs_up = $row['upvote_count'];
        $idea_thumbs_down = $row['downvote_count'];
        
        //Displaying ideas
        echo "<tr>";
        echo "<td>{$idea_id}</td>";
        echo "<td>{$idea_category_id}</td>";
        echo "<td>{$idea_title}</td>";
        echo "<td>{$idea_user_id}</td>";
//        echo "<td>{$idea_user}</td>";
        echo "<td>{$idea_date}</td>";
//        echo "<td>{$idea_attachment}</td>";
        echo "<td>{$idea_content}</td>";
        echo "<td>{$idea_comment_count}</td>";
        echo "<td>{$idea_view_count}</td>";
        echo "<td>{$idea_thumbs_up}</td>";
        echo "<td>{$idea_thumbs_down}</td>";
        echo "<td><a href='posts.php?delete=$idea_id'>Delete</a></td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>


<?php 
if(isset($_GET['delete'])){
    //Deleting a post from db
    $delete_idea_id = $_GET['delete'];
    $query = "DELETE FROM idea WHERE id = {$delete_idea_id}";
    $delete_query = mysqli_query($conn, $query);
    
    //Refrsh page after delete    
    header("Location: posts.php");

    
}
?>