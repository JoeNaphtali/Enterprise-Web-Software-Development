        <!--Header -->
<?php include "includes/header.inc.php"; ?>
        <!-- /.Header -->

		<!-- Navbar -->

<?php include "includes/navbar.inc.php"; ?>

		<!-- /.Navbar -->

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
<?php include "includes/footer.inc.php"; ?>
        <!-- /.Footer -->