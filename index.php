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

            <!-- Ideas Column -->

            <div class="row">          

                <?php
                // If user clicks on a category, display ideas under that specific category
                if(isset($_GET['c_id'])){
                        
                    include "includes/category.ideas.col.inc.php";

                }
                // If user clicks on an author, display ideas by that specific author
                else if (isset($_GET['u_id'])) {
                    
                    include "includes/user.ideas.col.inc.php";

                }
                // If user clicks the 'Most Viewed' link, display all ideas and order of number of page views
                else if (isset($_GET['mostviewed'])) {
                    
                    include "includes/mostviewed.ideas.col.inc.php";

                }
                // If user clicks the 'Most Comments' link, display all ideas and order of number of comments
                else if (isset($_GET['mostcomments'])) {
                    
                    include "includes/mostcomments.ideas.col.inc.php";

                }
                // If user clicks the 'Most Upvotes' link, display all ideas and order of number of upvotes
                else if (isset($_GET['mostupvotes'])) {
                    
                    include "includes/mostupvotes.ideas.col.inc.php";

                }
                // If user clicks the 'Most Downvotes' link, display all ideas and order of number of downvotes
                else if (isset($_GET['mostdownvotes'])) {
                    
                    include "includes/mostdownvotes.ideas.col.inc.php";

                }
                // If user clicks the 'Latest Comments' link, display all ideas and order of number of downvotes
                else if (isset($_GET['latestcomments'])) {
                    
                    include "includes/latestcomments.col.inc.php";

                }
                // Display all ideas
                else {
                
                    include "includes/ideas.col.inc.php";

                }               
                ?>
            
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