        <!--Header -->
<?php include "includes/header.inc.php"; ?>
        <!-- /.Header -->

		<!-- Navbar -->

<?php include "includes/navbar.inc.php"; ?>

		<!-- /.Navbar -->

		<!-- Content -->

		<div class="container">

			<div class="main mx-auto">

	      		<h1 class="profile-heading">My Account</h1>

		      	<!-- Profile Form -->

		      	<div class="profile shadow">
		        	<form>
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
		          			<div class="form-group">
		            			<label>Email Address</label>
		            			<input type="text" class="form-control" name="">
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
		          		<div class="form-row">
				            <div class="form-group col-md-6">
				              <label>Password</label>
				              <input type="text" class="form-control" name="">
				            </div>
		            	<div class="form-group col-md-6">
				              <label>Confirm Password</label>
				              <input type="text" class="form-control" name="">
		            	</div>
		          	</div>
		          	<div class="row">
		          		<div class="col-sm-6">
		          			<button type="submit" class="btn btn-edit">Edit Details</button>
		          		</div>
		          		<div class="col-sm-6">
		          			<button type="submit" class="btn btn-save" disabled>Save Details</button>
		          		</div>
		          	</div>
		        </form>
		      </div>

		      <!-- Profile Form -->

	    	</div>
    	</div>

		<!-- Content -->

        <!-- Footer -->
<?php include "includes/footer.inc.php"; ?>
        <!-- /.Footer -->