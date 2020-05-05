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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Statistics</li>
                        </ol>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="statistics">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Number of ideas</th>
                                        <th>Percentage of total ideas</th>
                                        <th>Number of contributors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $results = mysqli_query($conn, "SELECT * FROM department");
                                    while ($row = mysqli_fetch_array($results)) {
                                        $department_id = $row['id'];
                                        $department_name = $row['department_name'];
                                ?>
                                    <tr>
                                        <td><?php echo $department_name; ?></td>
                                        <?php $sql = mysqli_query($conn, "SELECT * FROM idea WHERE department_id = $department_id");
                                        $count_ideas = mysqli_num_rows($sql); ?>                                      
                                        <td><?php echo $count_ideas; ?></td>
                                        <?php $sql = mysqli_query($conn, "SELECT * FROM idea");
                                        $total_ideas = mysqli_num_rows($sql);
                                        if ($total_ideas > 0) {
                                            $percentage = ($count_ideas/$total_ideas) * 100;
                                        }
                                        else {
                                            $percentage = 0;
                                        }
                                        ?>
                                        <td><?php echo (round($percentage,2)); echo ' %' ?></td>
                                        <?php $sql = mysqli_query($conn, "SELECT * FROM user WHERE department_id = $department_id");
                                        $count_users = mysqli_num_rows($sql); ?> 
                                        <td><?php echo $count_users; ?></td>                                     
                                    </tr>
                                <?php } ?>                                          
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-4">
                            <button type="button" class="btn btn-success" id="btnExportstats">Export to csv file</button>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Exception Reports</li>
                        </ol>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="exceptReports">
                                <thead>
                                    <tr>
                                        <th>Number of ideas without comments</th>
                                        <th>Number of anonymous ideas</th>
                                        <th>Number of anonymous comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php $sql = mysqli_query($conn, "SELECT * FROM idea WHERE comment_count = 0");
                                        $count = mysqli_num_rows($sql); ?>
                                        <td><?php echo $count; ?></td>
                                        <?php $sql = mysqli_query($conn, "SELECT * FROM idea WHERE anonymous = 1");
                                        $count = mysqli_num_rows($sql); ?>
                                        <td><?php echo $count; ?></td>
                                        <?php $sql = mysqli_query($conn, "SELECT * FROM comment WHERE anonymous = 1");
                                        $count = mysqli_num_rows($sql); ?>
                                        <td><?php echo $count; ?></td>
                                    </tr>                                          
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-4">
                            <button type="button" class="btn btn-success" id="btnExportexp">Export to csv file</button>
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
            const statsTable = document.getElementById("statistics");
            const btnExportstats = document.getElementById("btnExportstats");

            btnExportstats.addEventListener("click", () => {
                const exporter = new TableCSVExporter(statsTable);
                const csvOutput = exporter.convertToCSV();
                const csvBlob = new Blob([csvOutput], { type: "text/csv" });
                const blobUrl = URL.createObjectURL(csvBlob);
                const anchorElement = document.createElement("a");

                anchorElement.href = blobUrl;
                anchorElement.download = "statistics.csv";
                anchorElement.click();

                setTimeout(() => {
                    URL.revokeObjectURL(blobUrl);
                }, 500);
            });
        </script>
        <script>
            const exceptTable = document.getElementById("exceptReports");
            const btnExportexp = document.getElementById("btnExportexp");

            btnExportexp.addEventListener("click", () => {
                const exporter = new TableCSVExporter(exceptTable);
                const csvOutput = exporter.convertToCSV();
                const csvBlob = new Blob([csvOutput], { type: "text/csv" });
                const blobUrl = URL.createObjectURL(csvBlob);
                const anchorElement = document.createElement("a");

                anchorElement.href = blobUrl;
                anchorElement.download = "exception_reports.csv";
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
