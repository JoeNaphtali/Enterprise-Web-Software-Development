<?php
    // Start Session
    session_start();
    
    // Database Connection
    include "includes/voting.inc.php";

    //If user is not logged in, redirect to login page
    if(!$_SESSION['login']){
        header("Location: login.php");
    }  
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home | Ideas</title>
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="js/script.js"></script>
	</head>

	<body>

        <!-- Navbar -->

        <?php include "includes/navbar.inc.php"; ?>

        <!-- /.Navbar -->

        <!-- Content -->

        <div class="container">

            <div class="row">

                <!-- Ideas Column -->

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="my-4 latest-ideas" style="font-weight: bold;">Search Results</h1>
                        </div>
                        <div class="col-sm-6">
                        <a href="../../Enterprise-Web-Software-Development/propose.php"><button class="btn btn-primary my-4">Propose an Idea</button></a>
                        </div>
                    </div>
                    <!-- Retriving Data From DB-->
                    <?php
                        if (isset($_POST['submit'])){
                    
                            $search = $_POST['search'];
                            $query = "SELECT * FROM idea WHERE content LIKE '%$search%' OR idea_title LIKE '%$search%'";
                            $search_query = mysqli_query($conn, $query);
                    
                        if(!$search_query){
                            die("SEARCH QUERY FAILED!".mysqli_error($conn));
                            
                        }
                        $count = mysqli_num_rows($search_query);
                    
                        if($count == 0){
                            echo "<p>There are no ideas for this search item.</p>";
                            
                        }else {

                        while($row = mysqli_fetch_assoc($search_query)){
                        $idea_title = $row['idea_title'];
                        $idea_content = $row['content'];
                        $idea_date = $row['post_date'];
                    
                        ?>
                    <!-- Idea -->

                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h2 class="card-title" style="font-weight: bold;"><?php echo "$idea_title"; ?></h2>

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

                            <!-- Truncate content to 180 characters -->
                            <p class="card-text"><?php echo substr(strip_tags($row['content']), 0, 180), "..."; ?></p>
                            <a href="post/post.php">Read More &rarr;</a>
                        </div>
                        <div>
                            <div class="card-footer text-muted">
                                Posted on <?php echo "$idea_date"; ?> by 
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

                    <!-- /.Idea -->

                    <!-- Closing While Loop  -->
                    <?php }                       
        }       
    }?>

                    <!-- Pagination -->

                    <ul class="pagination justify-content-center mb-4">
                        <li class="page-item">
                            <a class="page-link" href="#">&larr; Older</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Newer &rarr;</a>
                        </li>
                    </ul>


                </div>

                <!-- Ideas Column -->

                <!-- Widgets Column -->

                <?php include "includes/widgets.inc.php"; ?>

                <!-- Widgets Column -->
            </div>
        </div>

        <!-- Content -->

        <!-- Footer -->
        <?php include "includes/footer.inc.php"; ?>
        <!-- /.Footer -->