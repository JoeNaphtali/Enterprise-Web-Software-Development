<div class="col-md-8">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="my-4 latest-ideas">Most Comments</h1>
            </div>
            <div class="col-sm-6">
                <a href="../../Enterprise-Web-Software-Development/propose.php"><button class="btn btn-primary my-4">Propose an Idea</button></a>
            </div>
        </div>

        <!-- Idea -->

        <?php    
        
        // Select all ideas from the 'idea' table and order them by the number of comments
        $results = mysqli_query($conn, "SELECT * FROM idea ORDER BY comment_count DESC");

        while ($row = mysqli_fetch_array($results)) { 
            
        ?>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title"><?php echo $row['idea_title']; ?></h2>
                
                <!-- Category -->

                <p>
                    <?php                   
                    $category_id = $row['category_id'];
                    // Retrieve catergory name from 'category' table
                    $category_result = mysqli_query($conn, "SELECT * FROM category WHERE id=$category_id");
                    while ($row1 = mysqli_fetch_array($category_result)) {                    
                    ?>
					Category:
					<a href="index.php?c_id=<?php echo $row1['id']; ?>"><?php echo $row1['category_name']; ?></a>
                    </p>
                    <!-- Closing While loop -->
                    <?php } ?>
                    
                <!-- /.Category -->
                <p class="card-text"><?php echo substr(strip_tags($row['content']), 0, 180), "..."; ?></p>
                <a href="post.php?i_id=<?php echo $row["id"]; ?>">Read More &rarr;</a>
            </div>
            <div>
                <div class="card-footer text-muted">
                    Posted on <?php echo $row['post_date']; ?> by  
                    <?php                   
                    $user_id = $row['user__id'];
                    // Retrieve user from 'user' table
                    $user_result = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
                    while ($row2 = mysqli_fetch_array($user_result)) {                    
                    ?>
					<a href="index.php?u_id=<?php echo $row2["id"]; ?>">
                        <?php 
                        // Concatenate user firstname and lastname into 'author' variable and display author name
                        $author = $row2['first_name'] . ' ' . $row2['last_name'];
                        echo $author;
                        ?>
                    </a>
                    &nbsp;
                    <!-- Closing While loop -->
                    <?php } ?>

                    <!-- Vote count -->

                    <i <?php if (userLiked($row['id'])): ?>
                        class="material-icons like-btn"
                    <?php else: ?>
                        class="material-icons-outlined like-btn"
                    <?php endif ?>
                    data-id="<?php echo $row['id'] ?>" style="cursor: pointer; color:blue; font-size: 18px;">thumb_up</i>
                    <span class="likes" style="font-size: 18px; color:blue;">
                        <?php echo getLikes($row['id']);
                        $likes = getLikes($row['id']);
                        $id = $row['id'];
                        mysqli_query($conn, "UPDATE idea SET upvote_count='$likes' WHERE id='$id'");
                        ?>
                    </span>
                    
                    &nbsp;

                    <i 
                    <?php if (userDisliked($row['id'])): ?>
                        class="material-icons dislike-btn"
                    <?php else: ?>
                        class="material-icons-outlined dislike-btn"
                    <?php endif ?>
                    data-id="<?php echo $row['id'] ?>" style="cursor: pointer; color:red; font-size: 18px;">thumb_down</i>
                    <span class="dislikes" style="font-size: 18px; color:red;">
                        <?php echo getDislikes($row['id']); 
                        $dislikes = getDislikes($row['id']);
                        $id = $row['id'];
                        mysqli_query($conn, "UPDATE idea SET downvote_count='$dislikes' WHERE id='$id'");
                        ?>
                    </span>

                    <!-- /.Vote count -->

                </div>
            </div>
        </div>
        <?php } ?>

        <!-- /.Idea -->

        <!-- Pagination -->

        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>

        <!-- /.Pagination -->