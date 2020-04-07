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

<!DOCTYPE html>
<html>
	<head>
		<title>My Account | Ideas</title>
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
		<!-- Summernote CSS -->
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
		<!-- Summernote JS -->
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="js/script.js"></script>
	</head>

	<body>

		<!-- Navbar -->

		<?php include "includes/navbar.inc.php"; ?>

		<!-- /.Navbar -->

		<!-- Account Form -->

		<div class="container">
            <div class="row justify-content-center">
                <div class="form col-lg-8 mt-5 px-0 shadow">
                    <div class="card-header text-center text-light p-3" id="form-header">My Account</div>
		        	<form class="bg-white p-4">
		          		<div class="form-row">
		            		<div class="form-group col-md-6">
								<label>First Name</label>
								<input type="text" class="form-control" name="">
							</div>
							<div class="form-group col-md-6">
								<label>Last Name</label>
								<input type="text" class="form-control" name="">
							</div>
		          		</div>
		          		<div class="form-row">
		            		<div class="form-group col-md-6">
								<label>Email Address</label>
								<input type="text" class="form-control" name="">
							</div>
							<div class="form-group col-md-6">
								<label>Password</label>
								<input type="text" class="form-control" name="">
							</div>
		          		</div>
		          		<div class="form-row">
				            <div class="form-group col-md-6">
				            <label>Department</label>
				            <select id="inputDepartment" class="form-control">
				                <option selected>Choose...</option>
				                <option>...</option>
				            </select>
				            </div>
				            <div class="form-group col-md-6">
				              <label>Gender</label>
				                <select id="inputDepartment" class="form-control">
				                  <option selected>Choose...</option>
				                  <option>...</option>
				                </select>
				            </div>
		          		</div>
						<button type="submit" class="btn btn-primary">Edit Details</button>
		        	</form>
                </div>
            </div>
		</div>
		
		<!-- /.Account Form -->

		<!-- Footer -->
		
		<?php include "includes/footer.inc.php"; ?>
		
        <!-- /.Footer -->