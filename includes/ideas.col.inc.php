    <div class="col-md-8">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="my-4 latest-ideas">Latest Ideas</h1>
            </div>
            <div class="col-sm-6">
                <a href="../../Enterprise-Web-Software-Development/propose.php"><button class="btn btn-primary my-4">Propose an Idea</button></a>
            </div>
        </div>

        <!-- Idea -->

        <?php
        
        // Select all ideas from 'idea' table
        $results = mysqli_query($conn, "SELECT * FROM idea");

        while ($row = mysqli_fetch_array($results)) { 
            
        ?>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title"><?php echo $row['idea_title']; ?></h2>
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
					<a href="#">
                        <?php 
                        // Concatenate user firstname and lastname into 'author' variable and display author name
                        $author = $row2['first_name'] . ' ' . $row2['last_name'];
                        echo $author;
                        ?>
                    </a>
                    <!-- Closing While loop -->
                    <?php } ?>
                    <i class="far fa-thumbs-up"> <?php echo $row['upvote_count']; ?></i>
                    <i class="far fa-thumbs-down"> <?php echo $row['downvote_count']; ?></i>
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