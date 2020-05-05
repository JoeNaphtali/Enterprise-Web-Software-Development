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
    else if($_SESSION['user_role'] !== 'qamanager'){
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
                        <!-- Display category name in input box when 'edit' button is clicked -->

                        <?php 

                            $name = "";   
                            $update = false; 

                            if (isset($_GET['edit'])) {
                                $id = $_GET['edit'];
                                $update = true;
                                $record = mysqli_query($conn, "SELECT * FROM category WHERE id='$id'");

                                if ($record) {
                                    $row = mysqli_fetch_array($record);
                                    $name = $row['category_name'];
                                }
                            }
                        ?>

                        <!-- /.Display category name in input box when 'edit' button is clicked -->

                        <!-- Manage Catergories Form -->

                        <?php

                        //Retrieve catergories from 'category' table
                        $results = mysqli_query($conn, "SELECT * FROM category");

                        ?>

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="form col-lg-12 bg-light mt-5 px-0 shadow">
                                    <div class="card-header text-center text-light p-3 bg-dark" id="form-header">Manage Categories</div>
                                    <div class="p-4">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>         
                                                <?php while ($row = mysqli_fetch_array($results)) { ?>                           
                                                    <tr>
                                                        <td><?php echo $row['category_name']; ?></td>
                                                        <td>
                                                            <a href="managecategories.php?edit=<?php echo $row["id"]; ?>" class="btn btn-primary" style="color: #fff;"><i class="fas fa-edit"></i> Edit</a>
                                                            <a href="includes/managecategories.inc.php?delete=<?php echo $row["id"]; ?>" class="btn btn-danger" style="color: #fff;"><i class="fas fa-trash-alt"></i> Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form">
                                            <form action="includes/managecategories.inc.php" method="POST">
                                                <div class="form-group">
                                                    <label>Catergory Name</label>
                                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                    <input class="form-control" type="text" name="category-name" value="<?php echo $name; ?>" required>
                                                </div>
                                                <?php if ($update == true): ?>
                                                    <button class="btn btn-warning" type="submit" name="update-category">Update</button>
                                                    <a href="managecategories.php" class="btn btn-info" name="cancel">Cancel</a>
                                                <?php else: ?>
                                                    <button class="btn btn-success" type="submit" name="save-category">Save</button>
                                                <?php endif ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.Manage Catergories Form -->  
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
                anchorElement.download = "ideas.csv";
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
