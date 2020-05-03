<?php
	// Start session
	session_start();
	// Database connection
    include "includes/dbh.inc.php";
	/*//If user is not logged in, redirect to login page
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
    }
    else {
        $_SESSION['user_id'] = 1;
    }*/
?>

<!DOCTYPE html>
<html lang="en">
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
		<?php 
 
        $update = false; 

		// If user clicked the edit button
        if (isset($_GET['edit'])) {
            $update = true;
		}
		
        ?>

		<?php

		$user_id = $_SESSION['user_id'];

        //Retrieve user from 'user' table
		$results = mysqli_query($conn, "SELECT * FROM user WHERE id = $user_id");
		
		$row = mysqli_fetch_array($results);

        ?>

		<div class="container">
            <div class="row justify-content-center">
                <div class="form col-lg-8 mt-5 px-0 shadow">
                    <div class="card-header text-center text-light p-3" id="form-header">My Account</div>
		        	<form class="bg-white p-4" action="includes/editaccount.inc.php" method="post">
		          		<div class="form-row">
		            		<div class="form-group col-md-6">
								<label>First Name</label>
								<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<?php if ($update == true): ?>
								<input type="text" class="form-control" name="fname" required value="<?php echo $row['first_name']; ?>">
								<?php else: ?>
								<input type="text" class="form-control" name="fname" value="<?php echo $row['first_name']; ?>" disabled>
								<?php endif ?>
							</div>
							<div class="form-group col-md-6">
								<label>Last Name</label>
								<?php if ($update == true): ?>
								<input type="text" class="form-control" name="lname" required value="<?php echo $row['last_name']; ?>">
								<?php else: ?>
								<input type="text" class="form-control" name="lname" value="<?php echo $row['last_name']; ?>" disabled>
								<?php endif ?>
							</div>
		          		</div>
		            	<div class="form-group">
							<label>Email Address</label>
							<?php if ($update == true): ?>
							<input type="text" class="form-control" name="mail" required value="<?php echo $row['email']; ?>">
							<?php else: ?>
							<input type="text" class="form-control" name="mail" value="<?php echo $row['email']; ?>" disabled>
							<?php endif ?>
						</div>
		          		<div class="form-row">
				            <div class="form-group col-md-6">
								<label>Enter New Password</label>
								<?php if ($update == true): ?>
								<input type="password" class="form-control" required name="pwd">
								<?php else: ?>
								<input type="password" class="form-control" name="pwd" disabled>
								<?php endif ?>
				            </div>
				            <div class="form-group col-md-6">
								<label>Confirm New Password</label>
								<?php if ($update == true): ?>
								<input type="password" class="form-control" required name="pwd-repeat">
								<?php else: ?>
								<input type="password" class="form-control" name="pwd-repeat" disabled>
								<?php endif ?>
				            </div>
                        </div>
                        <div class="form-row">
				            <div class="form-group col-md-6">
								<label>Department</label>
								<?php if ($update == true): ?>
								<select id="inputDepartment" class="form-control" name="dprtmnt[]" required>
									<option disabled selected value>Choose...</option>
									<?php
									// Select all departments from the department table and list them in the dropdown-list      
									$results = mysqli_query($conn, "SELECT * FROM department");
									while ($row = mysqli_fetch_array($results)) { ?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['department_name']; ?></option>
									<?php } ?>
								</select>
								<?php else: ?>
								<select id="inputDepartment" class="form-control" name="dprtmnt[]" disabled>
									<option disabled selected value>Choose...</option>						
								</select>
								<?php endif ?>
				            </div>
				            <div class="form-group col-md-6">
								<label>Gender</label>
								<?php if ($update == true): ?>
				                <select id="inputGender" class="form-control" name="gndr[]" required>
				                    <option disabled selected value>Choose...</option>
                                    <option value='male'>Male</option>
                                    <option value='female'>Female</option>
                                    <option value='other'>Other</option>
								</select>
								<?php else: ?>
								<select id="inputGender" class="form-control" name="gndr[]" disabled>
				                    <option disabled selected value>Choose...</option>
								</select>
								<?php endif ?>
				            </div>
						</div>
						<!-- If user clicked the edit button -->
						<?php if ($update == true): ?>
						<button class="btn btn-warning" type="submit" name="update-account">Update</button>
                        <a href="account.php" class="btn btn-info" name="cancel">Cancel</a>
						<?php else: ?>
						<!-- Otherwise -->
						<a href="account.php?edit=<?php echo $user_id; ?>" class="btn btn-edit btn-primary" style="color: #fff;"><i class="fas fa-edit"></i> Edit</a>
						<?php endif ?>
		        	</form>
                </div>
            </div>
		</div>
		
		<!-- /.Account Form -->

		<!-- Footer -->
		
		<?php include "includes/footer.inc.php"; ?>
		
        <!-- /.Footer -->