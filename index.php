<?php
    session_start();
    /*//If user is not logged in, redirect to login page
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
    }
    else {
        $_SESSION['user_id'] = 1;
    }*/
?>
        
<!--Database -->
<?php include "includes/dbh.inc.php"; ?>
<!-- /.Database -->

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

                <?php include "includes/ideas.col.inc.php"; ?>


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