<?php
	// Start Session
	session_start();

	// Database Connection
	include "includes/dbh.inc.php";
	
	//If user is already logged in, redirect to home page
    if(isset($_SESSION['login'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login | Ideas</title>
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

        <!-- Login Form -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="form col-lg-4 bg-light mt-5 px-0 shadow">
                    <div class="card-header text-center text-light p-3" id="form-header">Login</div>
					<form class="bg-white p-4" action="includes/login.inc.php" method="post">
						<?php
							if (isset($_GET['register'])) {
								// Display success message of user registered succesfully
								if ($_GET['register'] == "success") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: green; padding: 10px 0 10px 0;">
									Registration Succesful!
									</p></div>';
								}
							}
						?>
                        <div class="form-group">
							<label>Email address</label>
							<?php if (isset($_GET['mail'])):?>
							<input class="form-control" type="email" name="mail" value="<?php echo ($_GET['mail']); ?>" required>
							<?php else :?>
							<input class="form-control" type="email" name="mail" required>
							<?php endif ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input class="form-control" type="password" name="pwd" required>
                        </div>
                        <button class="btn btn-primary" type="submit" name="login-submit">Login</button>
                        <p>Don't have an account?
                            <a href="register.php">Register</a>
                        </p>
						<?php
							// Error messages		
							if (isset($_GET['error'])) {
								// Display error message if the user does not exist or enters a incorrect email address
								if ($_GET['error'] == "nouser") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Incorrect email address
									</p></div>';
								}
								// Display error message if the user enters an incorrect password
								else if ($_GET['error'] == "wrongpwd") { 
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Incorrect password
									</p></div>';
								}
								// Display error message if the user leaves an field empty
                                if ($_GET['error'] == "emptyfields") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please fill in all the fields
									</p></div>';
								}				
							}
						?>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.Login Form -->

    </body>
    
</html>
