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
                        <h1 class="mt-4">Ideas</h1>
                        <div class="card mb-4">                        
                            <div class="card-body">
                                <div class="table-responsive">
                                <?php
                                //Retrieve all ideas from 'idea' table
                                $results = mysqli_query($conn, "SELECT * FROM idea");
                                ?>
                                    <!-- Ideas Table -->
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Department</th>
                                                <th>Date Posted</th>
                                                <th>Comments</th>
                                                <th>Views</th>
                                                <th>Upvotes</th>
                                                <th>Downvotes</th>
                                                <th>Anonymous</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Department</th>
                                                <th>Date Posted</th>
                                                <th>Comments</th>
                                                <th>Views</th>
                                                <th>Upvotes</th>
                                                <th>Downvotes</th>
                                                <th>Anonymous</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['idea_title']; ?></td>
                                                <td><?php echo $row['content']; ?></td>
                                                <?php // Retrieve category name from 'category' table
                                                $category_id = $row['category_id'];
                                                $categories = mysqli_query($conn, "SELECT * FROM category WHERE id=$category_id");
                                                while ($category = mysqli_fetch_array($categories)) { ?>
                                                <td><?php echo $category['category_name']; ?></td>
                                                <?php } ?>
                                                <?php // Retrieve author from 'user' table
                                                $user_id = $row['user__id'];
                                                $users = mysqli_query($conn, "SELECT * FROM user WHERE id=$user_id");
                                                while ($user = mysqli_fetch_array($users)) {
                                                    $author = $user['first_name'].' '.$user['last_name'];  ?>
                                                <td><?php echo $author ?></td>
                                                <?php } ?>
                                                <?php // Retrieve department name from 'department' table
                                                $department_id = $row['department_id'];
                                                $departments = mysqli_query($conn, "SELECT * FROM department WHERE id=$department_id");
                                                while ($department = mysqli_fetch_array($departments)) { ?>
                                                <td><?php echo $department['department_name']; ?></td>
                                                <?php } ?>
                                                <td><?php echo $row['post_date']; ?></td>
                                                <td><?php echo $row['comment_count']; ?></td>
                                                <td><?php echo $row['view_count']; ?></td>
                                                <td><?php echo $row['upvote_count']; ?></td>
                                                <td><?php echo $row['downvote_count']; ?></td>
                                                <?php if ($row['anonymous'] == true) {
                                                    $anonymous = "Yes";
                                                }
                                                else {
                                                    $anonymous = "No";
                                                } ?>
                                                <td><?php echo $anonymous; ?></td>
                                                <td><a href="includes/manageideas.inc.php?delete=<?php echo $row["id"]; ?>" class="btn btn-danger" style="color: #fff;"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                        <?php } ?>                                            
                                        </tbody>
                                    </table>
                                    <!-- /.Ideas Table -->
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
