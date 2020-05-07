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
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="form col-lg-8 mt-5 px-0">
                                    <!-- Download Attachments Button -->

                                    <form class="bg-white p-4 text-center" action="includes/downloadattachments.inc.php" method="post">
                                        <button class="btn btn-success" name="download"><i class="fa fa-file-archive"></i> Download All Attachments</button> 
                                    </form>
                                    
                                    <!-- /.Download Attachments Button -->
                                </div>
                            </div>
		                </div>                 
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
    </body>
</html>
