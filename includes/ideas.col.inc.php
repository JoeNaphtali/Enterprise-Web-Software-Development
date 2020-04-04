    <div class="col-md-8">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="my-4 latest-ideas">Latest Ideas</h1>
            </div>
            <div class="col-sm-6">
                <a href="../../Enterprise-Web-Software-Development/propose.php"><button class="btn btn-primary my-4">Propose an Idea</button></a>
            </div>
        </div>
        <!-- Retriving Data From DB-->
        <?php 
    $query = "SELECT * FROM idea";
    $select_all_query = mysqli_query($conn, $query);
    
    while($row = mysqli_fetch_assoc($select_all_query)){
        $idea_title = $row['idea_title'];
        $idea_content = $row['content'];
        $idea_date = $row['post_date'];
        $idea_user = $row['post_user'];
        $idea_thumbs_up = $row['upvote_count'];
        $idea_thumbs_down = $row['downvote_count'];
        
        ?>

        <!--Displaying data from database-->
        <!-- Idea -->

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title"><?php echo "$idea_title"; ?></h2>
                <p class="card-text"><?php echo "$idea_content"; ?></p>
                <a href="post/post.php">Read More &rarr;</a>
            </div>
            <div>
                <div class="card-footer text-muted">
                    Posted on <?php echo "$idea_date"; ?> by <a href="#"><?php echo "$idea_user"; ?></a>
                    <i class="fas fa-thumbs-up"> <?php echo "$idea_thumbs_up"; ?></i>
                    <i class="fas fa-thumbs-down"> <?php echo "$idea_thumbs_down"; ?></i>
                </div>
            </div>
        </div>

        <!-- /.Idea -->

        <!-- Closing While loop -->
        <?php } ?>

        <!-- Pagination -->

        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>