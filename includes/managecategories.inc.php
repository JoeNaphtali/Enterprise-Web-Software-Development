<?php

if (isset($_POST['save-category'])) {

    require 'dbh.inc.php';

    $name = $_POST['category-name'];

    // Validate for empty field
    if (empty($name)) {
        header("Location: ../managecategories.php?error=emptyfields");
        exit();
    }
    // Validate for invalid category name
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        header("Location: ../managecategories.php?error=invalidname");
        exit();
    }
    else {
        
        // Check if category already exists in database
        $sql = "SELECT category_name FROM category WHERE category_name=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../managecategories.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../managecategories.php?error=nameexists");
                exit();
            }
            else {

                //Inserting category into database
                $sql = "INSERT INTO category (category_name) VALUES (?)";
                $stmt = mysqli_stmt_init($conn);
                // Check for sql syntax error
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../managecategories.php?error=sqlerror");
                exit();
                }
                else {

                mysqli_stmt_bind_param($stmt, "s", $name);
                mysqli_stmt_execute($stmt);
                header("Location: ../managecategories.php?savedsuccesfully");
                exit();
                }

            }
        }

    }
    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection string
    mysqli_close($conn);
}

else if (isset($_GET['delete'])) {

    require 'dbh.inc.php';

    $id = $_GET['delete'];

    // Delete record from database
    mysqli_query($conn, "DELETE FROM category WHERE id='$id'");
    header("Location:../managecategories.php?categorydeleted");

    // Close connection string
    mysqli_close($conn);

}

else if (isset($_POST['update-category'])) {

    require 'dbh.inc.php';

    $id = $_POST['id'];
    $name = $_POST['category-name'];
    
    // Validate for empty field
    if (empty($name)) {
        header("Location: ../managecategories.php?edit=$id?error=emptyfield");
        exit();
    }
    // Validate for invalid category name
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        header("Location: ../managecategories.php?edit=$id?error=invalidname");
        exit();
    }
    else {
        // Check if category already exists in database
        $sql = "SELECT category_name FROM category WHERE category_name=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../managecategories.php?edit=$id?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../managecategories.php?edit=$id?error=nameexists");
                exit();
            }
            else {

                // Update record in database
                mysqli_query($conn, "UPDATE category SET category_name='$name' WHERE id='$id'");
                header('location: ../managecategories.php?categoryupdated');
            }
        }
    }
    // Close connection string
    mysqli_close($conn);
}

else {
    // Send user back to 'manage categories' page, if page was accessed without clicking any of the buttons on the form
    header("Location: ../managecategories.php");
    exit();
}