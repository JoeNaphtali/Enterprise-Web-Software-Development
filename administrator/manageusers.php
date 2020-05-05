<?php
    // Start Session
    session_start();

    // Database Connection
    include "includes/dbh.inc.php";

    // If user is not logged in, redirect to login page
    if(!$_SESSION['login']){
        header("Location: ../login.php");
    }
    // If user is not an Administrator, redirect to home page
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
                    <h1 class="mt-4">Users</h1>
                        <div class="card mb-4">                        
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php
                                //Retrieve all users from 'user' table
                                $results = mysqli_query($conn, "SELECT * FROM user");
                                ?>
                                    <!-- Users Table -->
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Gender</th>
                                                <th>User Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                            <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['first_name']; ?></td>
                                                <td><?php echo $row['last_name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <?php // Retrieve department name from 'department' table
                                                $department_id = $row['department_id'];
                                                $department_result = mysqli_query($conn, "SELECT * FROM department WHERE id=$department_id");
                                                while ($row1 = mysqli_fetch_array($department_result)) { ?>
                                                <td><?php echo $row1['department_name']; ?></td>
                                                <?php } ?>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['user_role']; ?></td>
                                                <td>
                                                    <a href="manageusers.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary" style="color: #fff;"><i class="fas fa-edit"></i></a>
                                                    <a href="includes/manageusers.inc.php?delete=<?php echo $row["id"]; ?>" class="btn btn-danger" style="color: #fff;"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>                                            
                                        </tbody>
                                    </table>
                                    <!-- /.Users Table -->
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="button" class="btn btn-success" id="btnExportToCsv">Export to csv file</button>
                        </div>

                        <!-- Display user information when 'edit' button is clicked -->

                        <?php 

                        $firstname = "";
                        $lastname = "";
                        $email = "";   
                        $update = false; 

                        if (isset($_GET['edit'])) {
                            $id = $_GET['edit'];
                            $update = true;
                            $record = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");

                            if ($record) {
                                $row = mysqli_fetch_array($record);
                                $firstname = $row['first_name'];
                                $lastname = $row['last_name'];
                                $email = $row['email'];
                            }
                        }
                        ?>

                        <!-- /. Display user information when 'edit' button is clicked -->

                        <!-- Manage Users Form -->
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="form col-lg-12 mt-5 px-0 shadow">
                                    <div class="card-header text-center text-light p-3 bg-dark" id="form-header" >Manage Users</div>
                                    <form class="bg-white p-4" action="includes/manageusers.inc.php" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>First Name</label>
                                                <input type="text" hidden class="form-control" name="id" value="<?php echo $id; ?>">
                                                <input type="text" class="form-control" name="fname" value="<?php echo $firstname; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="lname" value="<?php echo $lastname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="text" class="form-control" name="mail" value="<?php echo $email; ?>" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Department</label>
                                                <select id="inputDepartment" class="form-control" name="dprtmnt[]" required>
                                                    <option disabled selected value>Choose...</option>
                                                    <?php
                                                    // Select all departments from the department table and list them in the dropdown-list      
                                                    $results = mysqli_query($conn, "SELECT * FROM department");
                                                    while ($row = mysqli_fetch_array($results)) { ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['department_name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Gender</label>
                                                <select id="inputGender" class="form-control" name="gndr[]" required>
                                                    <option disabled selected value>Choose...</option>
                                                    <option value='male'>Male</option>
                                                    <option value='female'>Female</option>
                                                    <option value='other'>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>User Role</label>
                                            <select id="inputStaffrole" class="form-control" name="userrole[]" required>
                                                <option disabled selected value>Choose...</option>
                                                <option value='admin'>Administrator</option>
                                                <option value='qamanager'>QA Manager</option>
                                                <option value='qacoordinator'>QA Coordinator</option>
                                                <option value='staff'>Regular Staff Member</option>
                                            </select>
                                        </div>
                                        <?php if ($update == true): ?>
                                            <button class="btn btn-warning" type="submit" name="update-user">Update</button>
                                            <a href="manageusers.php" class="btn btn-info" name="cancel">Cancel</a>
                                        <?php else: ?>
                                            <button class="btn btn-success" type="add-user-submit" name="add-user-submit">Add User</button>
                                        <?php endif ?>
                                        <?php
						
							if (isset($_GET['error'])) {
								if ($_GET['error'] == "emptydprtmnt") {
									echo '<h5 class="text-center" style="color: red;">Please select a department</h5>';
								}
								else if ($_GET['error'] == "emptygndr") {
									echo '<h5 class="text-center" style="color: red;">Please select a gender</h5>';
								}
								else if ($_GET['error'] == "emptyfields") {
									echo '<h5 class="text-center" style="color: red;">Please fill in all the fields</h5>';
								}
								else if ($_GET['error'] == "invalidmail") {
									echo '<h5 class="text-center" style="color: red;">Please enter a valid email</h5>';
								}
								else if ($_GET['error'] == "invalidfname") {
									echo '<h5 class="text-center" style="color: red;">Please enter a valid first name, letters only</h5>';
								}
								else if ($_GET['error'] == "invalidlname") {
									echo '<h5 class="text-center" style="color: red;">Please enter a valid last name, letters only</h5>';
								}
								else if ($_GET['error'] == "invalidmail") {
									echo '<h5 class="text-center" style="color: red;">Please enter a valid email</h5>';
								}
								else if ($_GET['error'] == "invalidmail") {
									echo '<h5 class="text-center" style="color: red;">Please enter a valid email</h5>';
								}
								else if ($_GET['error'] == "invalidmail") { 
									echo '<h5 class="text-center" style="color: red;">Please enter a valid email</h5>';
								}
								else if ($_GET['error'] == "emailtaken") {
									echo '<h5 class="text-center" style="color: red;">The email address entered is already taken</h5>';
								}
							}
						?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /. Manage Users Form -->                  
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
        <script src="js/TableCSVExporter.js"></script>
        <script>
            const dataTable = document.getElementById("dataTable");
            const btnExportToCsv = document.getElementById("btnExportToCsv");

            btnExportToCsv.addEventListener("click", () => {
                const exporter = new TableCSVExporter(dataTable);
                const csvOutput = exporter.convertToCSV();
                const csvBlob = new Blob([csvOutput], { type: "text/csv" });
                const blobUrl = URL.createObjectURL(csvBlob);
                const anchorElement = document.createElement("a");

                anchorElement.href = blobUrl;
                anchorElement.download = "users.csv";
                anchorElement.click();

                setTimeout(() => {
                    URL.revokeObjectURL(blobUrl);
                }, 500);
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
