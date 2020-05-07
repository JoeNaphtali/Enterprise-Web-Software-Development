<?php

// Start session in order to use session variables
session_start();

// Send email function
include "sendemail.inc.php";

// If user clicks 'Submit' button
if (isset($_POST['submit_comment'])){

    // Database connection
    require 'dbh.inc.php';

    // Declare variables
    $idea_title = $_POST['idea_title'];
    $author_id = $_POST['author_id'];
    $idea_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $content = $_POST['comment_content'];
    $date = date('Y-m-d H:i');
    $anonymous = false;

    if (isset($_POST['anonymous'])) {
        $anonymous = true;
    }

    // Display error if user leaves the input field empty 
    if (empty($content)) {
        header("Location: ../idea.php?i_id=$idea_id");
        exit();
    }
    else {
        //Inserting comment into 'comment' table
        $sql = "INSERT INTO comment (idea_id, user__id, content, comment_date, anonymous) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        // Check for sql syntax error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error if there is an sql syntax error in the 'INSERT INTO' statement
        header("Location: ../idea.php?i_id=$idea_id?error=sqlerror");
        exit();
        }
        else {

            // Bind varibales to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $idea_id, $user_id, $content, $date, $anonymous);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            
            mysqli_query($conn, "UPDATE idea SET comment_count= comment_count + 1 WHERE id = $idea_id");
            mysqli_query($conn, "UPDATE idea SET view_count = view_count - 1 WHERE id = $idea_id");

            // Retrieve idea author from the 'user' table
            $authors = mysqli_query($conn, "SELECT * FROM user WHERE id=$author_id");

            while ($author = mysqli_fetch_array($authors)) {
                // Retrieve author's email address
                $author_email = $author['email']; 
            }

            // Send email notification to author of idea
            $to       =   $author_email;
            $subject  =   "A new comment has been made on your idea";
            if ($anonymous = true) {
                $message  =   "An anonymous user commented on your idea '".$idea_title."'.";
            }
            else {
                $message  =   $_SESSION['first_name'].' '.$_SESSION['last_name'].' '."commented on your idea '".$idea_title."'.";
            }
            $mailsend =   sendmail($to,$subject,$message);

            // Return to idea page
            header("Location: ../idea.php?i_id=$idea_id");

        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection string
    mysqli_close($conn);
}
else {
    // Send user back to 'manage categories' page, if page was accessed without clicking any of the buttons on the form
    header("Location: ../idea.php?i_id=$idea_id");
    exit();
}