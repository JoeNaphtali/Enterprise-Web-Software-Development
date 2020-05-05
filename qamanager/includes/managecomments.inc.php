<?php

// If user clicks the 'Delete' button
if (isset($_GET['delete'])) {

    // Database connection
    require 'dbh.inc.php';

    // Get the id of the category the user wishes to delete and store it in the varible 'id'
    $id = $_GET['delete'];

    // Delete comment from database
    mysqli_query($conn, "DELETE FROM comment WHERE id='$id'");
    // Return the user the 'Manage Ideas' page with a success message
    header("Location:../managecomments.php?commentdeleted");

    // Close connection string
    mysqli_close($conn);

}
else {
    header("Location:../managecomments.php");
}