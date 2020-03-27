<!DOCTYPE html>
<html>
	<head>
		<title>Propose an Idea | Ideas</title>
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
		<!-- Summernote css -->
	    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
	    <!-- Summernote js -->
	    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="../js/script.js"></script>
	</head>

	<body>

		<!-- Navbar -->

		<nav class="mb-1 navbar navbar-expand-lg navbar-dark">
		  <a class="navbar-brand" href="../index.php">Ideas</a>
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown"
		          aria-haspopup="true" aria-expanded="false" href="#">
		          <i class="fas fa-user"></i> Profile </a>
		        <div class="dropdown-menu dropdown-menu-right" id="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="../account/account.php">My account</a>
		          <a class="dropdown-item" href="#">Log out</a>
		        </div>
		      </li>
		    </ul>
		</nav>

		<!-- Navbar -->

		<!-- Content -->
		<div class="container">
			<div class="main mx-auto">

		      <h1 class="propose-heading">What's on your mind?</h1>

		      <!-- Idea Form -->

		      <div class="post-idea shadow">
		        <form>
		          <div class="form-group">
		            <label>Title</label>
		            <small class="form-text text-muted">Be specific and imagine you’re proposing an idea to another person</small>
		            <input type="text" class="form-control" name="title">
		          </div>
		          <div class="form-group">
		            <label>Body</label>
		            <small class="form-text text-muted">Include all the details about your proposed idea</small>
		            <textarea class="form-control" id="summernote"></textarea>
		          </div>
		          <div class="form-group">
		            <label>Catergories</label>
		            <small class="form-text text-muted">Add categories to describe what your question is about</small>
		            <input type="text" class="form-control" name="categories">
		          </div>
		          <button type="submit" class="btn btn-propose">Propose Idea</button>
		        </form>
		      </div>
		    </div>
		</div>
		<!-- Content -->

	    <!-- Footer -->

	    <footer class="page-footer font-small">

	      <!-- Copyright -->

	      <div class="footer-copyright text-center py-3">© 2020 Copyright:
	        <a href="#"> E-Web Development Team 3</a>
	      </div>

	      <!-- Copyright -->

	    </footer>

	    <!-- Footer -->

	</body>

</html>