<?php

session_start();

require 'dbh.inc.php';

if(isset($_POST['submit_comment'])){

    $idea_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $content = $_POST['comment_content'];
    $date = date('Y-m-d');
    $anonymous = false;

    if (isset($_POST['anonymous'])) {
        $anonymous = true;
    }

    // Display error if user leaves the input field empty 
    if (empty($content)) {
        header("Location: ../post.php?i_id=$idea_id");
        exit();
    }
    else {
        //Inserting comment into 'comment' table
        $sql = "INSERT INTO comment (idea_id, user__id, content, comment_date, anonymous) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        // Check for sql syntax error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error if there is an sql syntax error in the 'INSERT INTO' statement
        header("Location: ../post.php?i_id=$idea_id?error=sqlerror");
        exit();
        }
        else {
        // Bind varibales to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $idea_id, $user_id, $content, $date, $anonymous);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);
        
        mysqli_query($conn, "UPDATE idea SET comment_count= comment_count + 1 WHERE id = $idea_id");
        mysqli_query($conn, "UPDATE idea SET view_count = view_count - 1 WHERE id = $idea_id");

        // Return user to the 'Idea Page'
        header("Location: ../post.php?i_id=$idea_id");
        exit();
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection string
    mysqli_close($conn);
}
else {
    // Send user back to 'manage categories' page, if page was accessed without clicking any of the buttons on the form
    header("Location: ../post.php?i_id=$idea_id");
    exit();
}