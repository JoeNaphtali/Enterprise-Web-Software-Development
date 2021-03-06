<?php
    // Start Session
    session_start();
    
    // Database Connection
    include "includes/dbh.inc.php";

    //If user is not logged in, redirect to login page
    if(!$_SESSION['login']){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Propose | Ideas</title>
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

		<!-- Propose Form -->

		<div class="container">
            <div class="row justify-content-center">
                <div class="form col-lg-12 mt-5 px-0 shadow">
                    <div class="card-header text-center text-light p-3" id="form-header">What's on your mind?</div>
					<form class="bg-white p-4" action="includes/propose.inc.php" method="post" id="propose-form" enctype="multipart/form-data">
						<?php

							// Error/Success messages

							if (isset($_GET['proposal'])) {
								// Display success message if idea proposal is succesful
								if ($_GET['proposal'] == "success") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: green; padding: 10px 0 10px 0;">
									Your idea was posted succesfully!
									</p></div>';
								}
							}
							else if (isset($_GET['error'])) {
								// Display error message if user did no enter anything in the 'Body' text area
								if ($_GET['error'] == "emptycontent") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please type your idea in the text area
									</p></div>';
								}
								// Display error message if user did no select a category
								if ($_GET['error'] == "emptycategory") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please select a category
									</p></div>';
								}				
							}
						?>
						<div class="form-group">
							<label>Title</label>
							<small class="form-text text-muted">Be specific and imagine you’re proposing an idea to another person</small>
							<?php if (isset($_GET['title'])):?>
							<input type="text" class="form-control" name="title" value="<?php echo ($_GET['title']); ?>" required>
							<?php else :?>
							<input type="text" class="form-control" name="title" required>
							<?php endif ?>
						</div>
						<div class="form-group">
							<label>Body</label>
							<small class="form-text text-muted">Include all the details about your proposed idea</small>
							<?php if (isset($_GET['content'])):?>
							<textarea class="form-control panel-default" id="summernote" name="content" value="<?php echo ($_GET['content']); ?>"></textarea>
							<?php else :?>
							<textarea class="form-control panel-default" id="summernote" name="content"></textarea>
							<?php endif ?>
						</div>
						<div class="form-group">
							<label>Catergories</label>
							<small class="form-text text-muted">Add categories to describe what your question is about</small>
							<select id="inputCategory" class="form-control" name="category[]" required>
								<option disabled selected value>Choose...</option>
								<?php
								// Select all categories from category table and list them in the dropdown-list      
        						$results = mysqli_query($conn, "SELECT * FROM category");
								while ($row = mysqli_fetch_array($results)) { ?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleFormControlFile1">Attachment (Optional)</label>
							<input type="file" class="form-control-file" id="attachment" name="file">
						</div>
						<div class="custom-control custom-checkbox form-group">
							<input type="checkbox" class="form-check-input" id="anonymous" name="anonymous">
							<label class="form-check-label" for="anonymous">Post anonymously?</label>
						</div>
						<div class="custom-control custom-checkbox form-group">
							<input type="checkbox" class="form-check-input" id="terms_and_conditions" value="1">
							<label class="form-check-label" for="terms_and_conditions">Do you agree to the <a href="#">terms and conditions</a></label>
						</div>
						<button type="submit" class="btn btn-primary" name="propose-submit" id="propose-submit" disabled>Propose Idea</button>
						<?php		
							
						?>
					</form>
                </div>
            </div>
		</div>
		
		<!-- /.Propose Form -->

		<!-- Footer -->
		
		<?php include "includes/footer.inc.php"; ?>

		<!-- /.Footer -->
		