<?php

// Start session in order to use the session variable 'user_id'
session_start();

// Send email function
include "sendemail.inc.php";

// If user clicks the 'Propose' button
if (isset($_POST['propose-submit'])) {

    // Database connection
    require 'dbh.inc.php';

    $anonymous = false;

    // Store the title the user entered in the 'title' variable
    $title = $_POST['title'];
    // Store the text the user entered in the 'content' variable
    $content = $_POST['content'];

    $pname = $_FILES["file"]["name"];

    $tname = $_FILES["file"]["tmp_name"];

    $uploads_dir = 'files';

    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
    
    // Check if a category was selected
    if(isset($_POST["category"]))  
    { 
        // Retrieve selected category and store it's value in the 'category_id' variable
        foreach ($_POST['category'] as $category_id);            
    }
    else {
        // Display error if user did not select a category
        header("Location: ../propose.php?error=emptycategory&title=".$title."&content=".$content);
        exit();
    }

    if (isset($_POST['anonymous'])) {
        $anonymous = true;
    }

    // Store user id into the variable 'user_id' using a session variable
    $user_id = $_SESSION['user_id'];
    // Store department id into the variable 'department_id' using a session variable
    $department = $_SESSION['department'];
    $date = date('Y-m-d H:i');

    // Validate for empty fields
    if (empty($content)) {
        header("Location: ../propose.php?error=emptycontent");
        exit();
    }
    else {

        // Insert idea into 'idea' table
        $sql = "INSERT INTO idea (idea_title, content, attachment, category_id, user__id, department_id, post_date, anonymous) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'INSERT INTO' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../propose.php?error=sqlerror");
        exit();
        }
        else {
        // Bind varibales the variables 'stmt' and 'name' to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssssss", $title, $content, $pname, $category_id, $user_id, $department, $date, $anonymous);
        // Execute prepared statement
        mysqli_stmt_execute($stmt);

        // Retrieve department QA Coordinator from the 'user' table
        $qacoordinators = mysqli_query($conn, "SELECT * FROM user WHERE department_id=$department AND user_role='qacoordinator'");

        while ($qacoordinator = mysqli_fetch_array($qacoordinators)) {
            // Retrieve QA Coordinator's email address
            $qacoordinator_email = $qacoordinator['email'];
        }

        // Send email notification to author of idea
        $to       =   $qacoordinator_email;
        $subject  =   "A new idea has been added to your department";
        $message  =   $_SESSION['first_name'].' '.$_SESSION['last_name'].' '."submitted a new idea '".$title."'.";
        $mailsend =   sendmail($to,$subject,$message);

        // Return user to the home page with a success message
        header("Location: ../index.php?proposal=success");
        exit();
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection string
    mysqli_close($conn);
}
else {
    // Send user back to propose page, if page was accessed without clicking 'propose' button
    header("Location: ../propose.php");
    exit();
}