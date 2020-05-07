<?php

// If user clicks the 'Delete' button
if (isset($_GET['delete'])) {

    // Database connection
    require 'dbh.inc.php';

    // Get the id of the category the user wishes to delete and store it in the varible 'id'
    $id = $_GET['delete'];

    // Delete all rating given to idea
    $sql = "DELETE FROM rating WHERE idea_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../manageusers.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }

    // Delete all comments from idea
    $sql = "DELETE FROM comment WHERE idea_id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../manageusers.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    }
    
    // Delete idea from database
    $sql = "DELETE FROM idea WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../manageusers.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
    } 

    // Return the user the 'Manage Ideas' page with a success message
    header("Location:../manageideas.php?ideadeleted");

    // Close connection string
    mysqli_close($conn);

}
else {
    header("Location:../manageideas.php");
}