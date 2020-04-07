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
		<title>Post | Ideas</title>
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

		      <!-- Idea Column -->
		      <div class="col-lg-8">

		        <!-- Title -->
		        <h1 class="mt-4">Title</h1>

		        <!-- Author -->
		        <p class="lead">
		          by
		          <a href="#">A. Dumbass Nigga</a>
		        </p>

		        <hr>

		        <!-- Date/Time -->
		        <p>Posted on March 30, 2020 at 12:00 PM</p>

		        <hr>

		        <!-- Post Content -->
		        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>

		        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>

		        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

		        <blockquote class="blockquote">
		          <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
		          <footer class="blockquote-footer">Someone famous in
		            <cite title="Source Title">Source Title</cite>
		          </footer>
		        </blockquote>

		        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

		        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

		        <hr>

		        <!-- Comments Form -->
		        <div class="card my-4">
		          <h5 class="card-header">Leave a Comment:</h5>
		          <div class="card-body">
		            <form>
		              <div class="form-group">
		                <textarea class="form-control" rows="3"></textarea>
		              </div>
		              <button type="submit" class="btn btn-primary">Submit</button>
		            </form>
		          </div>
		        </div>

		        <!-- Single Comment -->
		        <div class="media mb-4">
		          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
		          <div class="media-body">
		            <h5 class="mt-0">Commenter Name</h5>
		            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
		          </div>
		        </div>

		        <!-- Comment with nested comments -->
		        <div class="media mb-4">
		          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
		          <div class="media-body">
		            <h5 class="mt-0">Commenter Name</h5>
		            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

		            <div class="media mt-4">
		              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
		              <div class="media-body">
		                <h5 class="mt-0">Commenter Name</h5>
		                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
		              </div>
		            </div>

		            <div class="media mt-4">
		              <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
		              <div class="media-body">
		                <h5 class="mt-0">Commenter Name</h5>
		                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
		              </div>
		            </div>

		          </div>
		        </div>

		      </div>
		      <!-- Idea Column -->

            <!-- Widgets Column -->

            <?php include "includes/widgets.inc.php"; ?>

            <!-- Widgets Column -->

		    </div>

		</div>

		<!-- Content -->

		<!-- Footer -->
		
		<?php include "includes/footer.inc.php"; ?>
		
        <!-- /.Footer -->

	</body>

</html>