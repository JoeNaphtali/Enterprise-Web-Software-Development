<?php

// Start session in order to use the session variable 'user_id'
session_start();

if (isset($_POST['propose-submit'])) {

    // Database connection
    require 'dbh.inc.php';

    $title = $_POST['title'];
    $content = $_POST['content'];
    

    // Check if a category was selected
    if(isset($_POST["category"]))  
    { 
        // Retrieve selected category 
        foreach ($_POST['category'] as $category_id);            
    }
    else {
        header("Location: ../propose.php?error=emptycategory&title=".$title."&content=".$content);
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d');

    // Validate for empty fields
    if (empty($title) || empty($content)) {
        header("Location: ../propose.php?error=emptyfields");
        exit();
    }
    else {

        // Insert idea into 'idea' table
        $sql = "INSERT INTO idea (idea_title, content, category_id, user__id, post_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        // Check for sql syntax error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../propose.php?error=sqlerror");
        exit();
        }
        else {
        mysqli_stmt_bind_param($stmt, "sssss", $title, $content, $category_id, $user_id, $date);
        mysqli_stmt_execute($stmt);
        header("Location: ../propose.php?proposal=success");
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