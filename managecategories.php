<?php
    session_start();
    /*//If user is not logged in, redirect to login page
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
    }
    else if ($_SESSION['user_role'] == "staff" ) {
        header("Location: index.php");
    }
    else {
        $_SESSION['user_id'] = 1;
    }*/
?>

<!DOCTYPE html>
<html>
    <head>
		<title>Manage Categories | Ideas</title>
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="js/script.js"></script>
    </head>
    
    <body>

        <!-- Navbar -->

        <?php include "includes/navbar.inc.php"; ?>

        <!-- /.Navbar -->

        <!--Database Connection -->

        <?php include "includes/dbh.inc.php"; ?>

        <!-- /.Database Connection -->

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
                <div class="form col-lg-8 bg-light mt-5 px-0 shadow">
                    <div class="card-header text-center text-light p-3" id="form-header">Manage Categories</div>
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
                                    <input class="form-control" type="text" name="category-name" value="<?php echo $name; ?>">
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

        <!-- Footer -->

        <?php include "includes/footer.inc.php"; ?>
        
        <!-- /.Footer -->

    </body>
</html>