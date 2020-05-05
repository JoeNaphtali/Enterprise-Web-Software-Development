<?php
    // Start Session
    session_start();
    // Database Connection
    include "../includes/dbh.inc.php";
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
                        <h1 class="mt-4">Comments</h1>
                        <div class="card mb-4">                        
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php
                                //Retrieve all comments from 'comment' table
                                $results = mysqli_query($conn, "SELECT * FROM comment");
                                ?>
                                    <!-- Comments Table -->
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Idea Title</th>
                                                <th>Author</th>
                                                <th>Content</th>
                                                <th>Comment Date</th>
                                                <th>Anonymous</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <?php // Retrieve idea name title 'idea' table
                                                $idea_id = $row['idea_id'];
                                                $ideas = mysqli_query($conn, "SELECT * FROM idea WHERE id=$idea_id");
                                                while ($idea = mysqli_fetch_array($ideas)) { ?>
                                                <td><?php echo $idea['idea_title']; ?></td>
                                                <?php } ?>
                                                <?php // Retrieve author from 'user' table
                                                $user_id = $row['user__id'];
                                                $users = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
                                                while ($user = mysqli_fetch_array($users)) {
                                                    $author = $user['first_name'].' '.$user['last_name'];  ?>
                                                <td><?php echo $author ?></td>
                                                <?php } ?>
                                                <td><?php echo $row['content']; ?></td>
                                                <td><?php echo $row['comment_date']; ?></td>
                                                <?php if ($row['anonymous'] == true) {
                                                    $anonymous = "Yes";
                                                }
                                                else {
                                                    $anonymous = "No";
                                                } ?>
                                                <td><?php echo $anonymous; ?></td>
                                                <td><a href="includes/managecomments.inc.php?delete=<?php echo $row["id"]; ?>" class="btn btn-danger" style="color: #fff;"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                        <?php } ?>                                            
                                        </tbody>
                                    </table>
                                    <!-- /.Ideas Table -->
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="button" class="btn btn-success" id="btnExportToCsv">Export to csv file</button>
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
                anchorElement.download = "comments.csv";
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
