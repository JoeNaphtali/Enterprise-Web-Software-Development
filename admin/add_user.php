<?php include "../includes/dbh.inc.php"; ?>
<?php include "includes/header.php"; ?>
<div id="wrapper">
        <!-- Navigation -->
 <?php include "includes/navigation.php"; ?>  
 <!DOCTYPE html>
<html>
	<head>
		<title>Add Users | Ideas</title>
		<link rel="stylesheet" type="text/css" href="css/Style.css">
		<meta content="width=device-width, initial-scale=1" name="viewport" />	
	</head>
  <body>
	   <form method="post" action="includes/add_users.php">
	        <div class="input-group">
		        <label>First Name</label>
		        <input type="text" name="fname" value="">
	       </div>
	       <div class="input-group">
		       <label>Last Name</label>
		       <input type="text" name="lname" value="">
	       </div>
	       <div class="input-group">
		       <label>Email</label>
		       <input type="email" name="email" value="">
	       </div>
	       <div class="input-group">
		        <label>Password</label>
		        <input type="password" name="password">
	       </div>
	       <div class="input-group">
	           <label for="Departments">Departments:</label>
               <select id="Departments" name="Departments[]">
			      <option disabled selected value>Choose...</option>
                  <option value="Examninations Department">Examninations Department</option>
                  <option value="Accounts Department">Accounts Department</option>
                  <option value="Finance Department">Finance Department</option>
			   </select>
	      </div>
	      <div class="input-group">
	          <label for="Gender">Gender:</label>
              <select id="Gender" name="Gender[]">
			      <option disabled selected value>Choose...</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
              </select>
	       </div>
	       <div class="input-group">
		      <button type="submit" class="btn" name="add_users_btn">Add User</button>
	       </div>
	  </form>
    </body>
</html>

 <?php include "includes/footer.php"; ?>