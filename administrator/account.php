<?php
    // Start Session
    session_start();

    // Database Connection
    include "includes/dbh.inc.php";

    // If user is not logged in, redirect to login page
    if(!$_SESSION['login']){
        header("Location: ../login.php");
    }
    // If user is not a QA Manager, redirect to home page
    else if($_SESSION['user_role'] !== 'admin'){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard | Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">

        <!-- Fixed Navigation Bar -->

        <?php include "includes/fixednav.inc.php"; ?>

        <!-- /.Fixed Navigation Bar -->

        <div id="layoutSidenav">

            <!-- Side Navigation -->

            <?php include "includes/sidenav.inc.php"; ?>

            <!-- /.Side Navigation -->

            <!-- Content -->

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <?php 

                        // Set update value to false by default
                        $update = false; 

                        // If user clicked the edit button
                        if (isset($_GET['edit'])) {
                            // Set update value to true
                            $update = true;
                        }

                        $user_id = $_SESSION['user_id'];

                        //Retrieve current user from 'user' table
                        $results = mysqli_query($conn, "SELECT * FROM user WHERE id = $user_id");
                        
                        $row = mysqli_fetch_array($results);

                        ?>
                        
                        <!-- Account Form -->

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="form col-lg-8 mt-5 px-0 shadow">
                                    <div class="card-header text-center text-light p-3 bg-dark" id="form-header">My Account</div>
                                    <form class="bg-white p-4" action="includes/editaccount.inc.php" method="post">
                                        <?php 
                                            if (isset($_GET['update'])) {
                                                if ($_GET['update'] == "success") {
                                                    echo '<div class="text-center">
                                                    <p class="text-white" style="background-color: green; padding: 10px 0 10px 0;">
                                                    Account updated succesfully!
                                                    </p></div>';
                                                }
                                            }
                                        ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>First Name</label>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <?php if ($update == true): ?>
                                                <input type="text" class="form-control" name="fname" value="<?php echo $row['first_name']; ?>">
                                                <?php else: ?>
                                                <input type="text" class="form-control" name="fname" value="<?php echo $row['first_name']; ?>" disabled>
                                                <?php endif ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last Name</label>
                                                <?php if ($update == true): ?>
                                                <input type="text" class="form-control" name="lname" value="<?php echo $row['last_name']; ?>">
                                                <?php else: ?>
                                                <input type="text" class="form-control" name="lname" value="<?php echo $row['last_name']; ?>" disabled>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <?php if ($update == true): ?>
                                            <input type="text" class="form-control" name="mail" value="<?php echo $row['email']; ?>">
                                            <?php else: ?>
                                            <input type="text" class="form-control" name="mail" value="<?php echo $row['email']; ?>" disabled>
                                            <?php endif ?>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Enter New Password</label>
                                                <?php if ($update == true): ?>
                                                <input type="password" class="form-control" name="pwd">
                                                <?php else: ?>
                                                <input type="password" class="form-control" name="pwd" disabled>
                                                <?php endif ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Confirm New Password</label>
                                                <?php if ($update == true): ?>
                                                <input type="password" class="form-control" name="pwd-repeat">
                                                <?php else: ?>
                                                <input type="password" class="form-control" name="pwd-repeat" disabled>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Department</label>
                                                <?php if ($update == true): ?>
                                                <select id="inputDepartment" class="form-control" name="dprtmnt[]">
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
                                                <select id="inputGender" class="form-control" name="gndr[]">
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

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; E-Web Development Team 3</div>
                        </div>
                    </div>
                </footer>
            </div>
            
            <!-- /.Content -->
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

    </body>
</html>
