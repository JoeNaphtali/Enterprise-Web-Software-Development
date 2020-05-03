<?php

// If user clicks the 'Delete' button
if (isset($_GET['delete'])) {

    // Database connection
    require 'dbh.inc.php';

    // Get the id of the category the user wishes to delete and store it in the varible 'id'
    $id = $_GET['delete'];

    // Delete idea from database
    mysqli_query($conn, "DELETE FROM comment WHERE idea_id='$id'");
    // Delete idea from database
    mysqli_query($conn, "DELETE FROM idea WHERE id='$id'");
    // Return the user the 'Manage Ideas' page with a success message
    header("Location:../manageideas.php?ideadeleted");

    // Close connection string
    mysqli_close($conn);

}
else {
    header("Location:../manageideas.php");
}