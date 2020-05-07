<?php

// If user clicks the 'Delete' button
if (isset($_GET['delete'], $_GET['i_id'])) {

    // Database connection
    require 'dbh.inc.php';

    // Get the id of the comment the user wishes to delete and store it in the varible 'id'
    $id = $_GET['delete'];
    $idea_id = $_GET['i_id'];

    // Delete comment from database
    $sql = "DELETE FROM comment WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    // Display error if there is an sql syntax error in the 'DELETE' statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../managecomments.php?error=sqlerror");
        exit();
    }
    else {
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $id);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);

        // Reduce comment count by one in corresponding idea
        mysqli_query($conn, "UPDATE idea SET comment_count = comment_count - 1 WHERE id = $idea_id");

        // Return the user the 'Manage Comments' page with a success message
        header("Location:../managecomments.php?commentdeleted");
    }
    // Close connection string
    mysqli_close($conn);
}
// Return user to 'Manage Comments' page if this include page was accessed without clicking the 'Delete' button
else {
    header("Location:../managecomments.php");
}