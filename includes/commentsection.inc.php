<?php 

if(isset($_POST['submit_comment'])){
    $idea_id = $_GET['i_id'];
    $user_id = 1; //TODO: $_GET['u_id']
    $comment_content = $_POST['comment_content'];
    
    $query = "INSERT INTO comment (idea_id, user__id, content, comment_date)";
    $query .= "VALUES ($idea_id, $user_id, '{$comment_content}', now())";
    
    
    $submit_comment_query = mysqli_query($conn, $query);
    if(!$submit_comment_query){
        die('Query Failed!' . mysqli_error($conn));
    }
    
    $query = "UPDATE idea SET comment_count = comment_count + 1 ";
    $query .= "WHERE id = $idea_id";
    $update_comment_count = mysqli_query($conn, $query);
    if(!$update_comment_count){
        die('Update Query Failed!' . mysqli_error($conn));
    }
}

?>
                    
                    <!-- Comments Form -->
                    <div class="card my-4">
						<h5 class="card-header">Leave a Comment:</h5>
							<div class="card-body">
								<form action="" method="post">
									<div class="form-group">
										<textarea class="form-control" name="comment_content" rows="3"></textarea>
									</div>
									<button type="submit" name="submit_comment" class="btn btn-primary">Submit</button>
								</form>
							</div>
					</div>

					
					 <?php
        $idea_id = $_GET['i_id'];

        $query = "SELECT * FROM comment WHERE idea_id = $idea_id ";
        $query .= "ORDER BY id DESC ";

        $results = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($results)) { 
        $comment_content = $row['content'];
        $comment_user_id = $row['user__id'];

        $query = "SELECT * FROM user WHERE id = $comment_user_id";
        $select_user_id  = mysqli_query($conn, $query);
        
            //Getting User Name
        while($row = mysqli_fetch_assoc($select_user_id)){
        $user_id_new = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];

        $user_name = $first_name . " " . $last_name;

        }
            
        ?>
        <!-- Single Comment -->
					<div class="media mb-4">
						<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
						<div class="media-body">
							<h5 class="mt-0"><?php echo $user_name; ?></h5>
							<?php echo $comment_content; ?>
						</div>
					</div>

        
        <?php } ?>
        
<!--
        <php 
$query = "SELECT * FROM comments WHERE idea_id = {$idea_id} ";
$query .= "ORDER BY id DESC";
$select_comment_query = mysqli_query($conn, $query);
if(!$select_comment_query){
    die('Query Failed!' . mysqli_error($conn));
}
while($row = mysqli_fetch_array($select_comment_query)){
    $comment_content = $row['content'];
    $comment_date = $row['comment_date'];
    $comment_user_id = $row['user__id'];
    
    ?>
    
    
<php }
?>
-->

<!--
					 Comment with nested comments 
					<div class="media mb-4">
						<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
						<div class="media-body">
							<h5 class="mt-0">Commenter Name</h5>
							Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

							<div class="media mt-4">
								<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
								<div class="media-body">
									<h5 class="mt-0">Commenter Name</h5>
									Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
								</div>
							</div>

							<div class="media mt-4">
								<img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
								<div class="media-body">
									<h5 class="mt-0">Commenter Name</h5>
									Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
								</div>
							</div>
						</div>
					</div>-->
