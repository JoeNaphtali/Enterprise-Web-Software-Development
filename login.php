<?php
	session_start();
	//If user is already logged in, redirect to home page
    if(isset($_SESSION['user_id'])){
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
                        <div class="form-group">
                            <label>Email address</label>
                            <input class="form-control" type="email" name="mail" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input class="form-control" type="password" name="pwd" placeholder="Enter your password">
                        </div>
                        <button class="btn btn-primary" type="submit" name="login-submit">Login</button>
                        <p>Don't have an account?
                            <a href="register.php">Register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.Login Form -->

    </body>
    
</html>
