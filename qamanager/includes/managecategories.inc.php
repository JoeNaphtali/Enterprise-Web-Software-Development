<?php

// If user clicks the 'Save' button
if (isset($_POST['save-category'])) {

    // Database connection
    require 'dbh.inc.php';

    // Declare 'name' variable to store the category name entered by the user
    $name = $_POST['category-name'];

    // Display error if user leaves the input field empty 
    if (empty($name)) {
        header("Location: ../managecategories.php?error=emptyfields");
        exit();
    }
    else {
        
        // Check if category name entered by the user already exists in the database
        $sql = "SELECT category_name FROM category WHERE category_name=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'SELECT' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../managecategories.php?error=sqlerror");
            exit();
        }
        else {
            // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $name);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Display error if category name already exists in database
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
                // Display error if there is an sql syntax error in the 'INSERT INTO' statement
                header("Location: ../managecategories.php?error=sqlerror");
                exit();
                }
                else {
                // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $name);
                // Execute prepared statement
                mysqli_stmt_execute($stmt);
                // Return user to the 'Manage Categories' page with a success message
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

// If user clicks the 'Delete' button
else if (isset($_GET['delete'])) {

    // Database connection
    require 'dbh.inc.php';

    // Get the id of the category the user wishes to delete and store it in the varible 'id'
    $id = $_GET['delete'];

    // Delete the record from the database
    mysqli_query($conn, "DELETE FROM category WHERE id='$id'");
    // Return the user the 'Manage Categories' page with a success message
    header("Location:../managecategories.php?categorydeleted");

    // Close connection string
    mysqli_close($conn);

}

// If user clicks the 'Update' button
else if (isset($_POST['update-category'])) {

    // Database Connection
    require 'dbh.inc.php';

    // Get the id of the category the user wishes to update and store it in the varible 'id'
    $id = $_POST['id'];
    // Get the name of the category the user wishes to update and store it in the varible 'name'
    $name = $_POST['category-name'];
    
    // Display an error message if the user leaves the input field empty
    if (empty($name)) {
        header("Location: ../managecategories.php?edit=$id?error=emptyfield");
        exit();
    }
    else {
        // Check if the category name entered by the user already exists in the database
        $sql = "SELECT category_name FROM category WHERE category_name=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'SELECT' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../managecategories.php?edit=$id?error=sqlerror");
            exit();
        }
        else {
            // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $name);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Display error if category name already exists in database
            if ($resultCheck > 0) {
                header("Location: ../managecategories.php?edit=$id?error=nameexists");
                exit();
            }
            else {

                // Update the record in the database
                mysqli_query($conn, "UPDATE category SET category_name='$name' WHERE id='$id'");
                // Return the user to the 'Manage Categories' page with a success message
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