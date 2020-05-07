<?php

session_start();

// If user clicks the 'Add User' button
if (isset($_POST['add-user-submit'])) {

    // Database conneciton
    require 'dbh.inc.php';

    // Declare variables
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['mail'];
    $password = $firstname."1234"; // Give user a default password (user first name + the suffix "1234" in this case) which they can change upon logging in 
    
    // Check if the user selected a user role
    if(isset($_POST["userrole"]))  
    { 
        // Retrieve the selected user role
        foreach ($_POST['userrole'] as $user_role);            
    }
    else {
        // Display an error if the user does not select a department
        header("Location: ../manageusers.php?error=emptydprtmnt&fname=".$firstname."&lname=".$lastname."&mail=".$email."&gndr=".$gender);
        exit();
    }

    // Check if the user selected a department
    if(isset($_POST["dprtmnt"]))  
    { 
        // Retrieve the selected department
        foreach ($_POST['dprtmnt'] as $department);            
    }
    else {
        // Display an error if the user does not select a department
        header("Location: ../manageusers.php?error=emptydprtmnt&fname=".$firstname."&lname=".$lastname."&mail=".$email."&gndr=".$gender);
        exit();
    }
    // Check if the user selected a gender 
    if(isset($_POST["gndr"]))  
    { 
        // Retrieve the selected gender
        foreach ($_POST['gndr'] as $gender);            
    }
    else {
        // Display an error if the user does not select a gender
        header("Location: ../manageusers.php?error=emptygndr&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department);
        exit();
    }

    // Display an error if the user leaves an empty field
    if (empty($firstname) || empty($lastname) || empty($email)) {
        header("Location: ../manageusers.php?error=emptyfields&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department."&gndr=".$gender);
        exit();
    }
    // Display an error if the user enters an invalid email, first name or last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstname) && !preg_match("/^[a-zA-Z0-9]*$/", $lastname)) {
        header("Location: ../manageusers.php?error=invalidmailfnamelname");
        exit();
    }
    // Display an error if the user enters an invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../manageusers.php?error=invalidmail&fname=".$firstname."&lname=".$lastname);
        exit();
    }
    // Display an error if the user enters an invalid first name
    else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        header("Location: ../manageusers.php?error=invalidfname&lname=".$lastname."&mail=".$email);
        exit();
    }
    // Display an error if the user enters an invalid last name
    else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header("Location: ../manageusers.php?error=invalidlname&fname=".$firstname."&mail=".$email);
        exit();
    }
    else {

        // Check if email address the user entered already exists in the database
        $sql = "SELECT email FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'SELECT' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../manageusers.php?error=sqlerror");
            exit();
        }
        else {
            // Bind the variables to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $email);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Display error if email address already exists in database
            if ($resultCheck > 0) {
                header("Location: ../manageusers.php?error=emailtaken&fname=".$firstname."&lname=".$lastname);
                exit();
            }
            else {

                //Insert user details into the database
                $sql = "INSERT INTO user (first_name, last_name, email, user_password, department_id, gender, user_role) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                // Check for sql syntax error
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                // Display error if there is an sql syntax error in the 'INSERT INTO' statement
                header("Location: ../manageusers.php?error=sqlerror");
                exit();
                }
                else {

                // Hash the user password
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                // Bind the variables to a prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $email, $hashedPwd, $department, $gender, $user_role);
                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
                // Return the user to the login page with a success message
                header("Location: ../manageusers.php?useradded=succesfully");
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

    // Get the id of the user and store it in the varible 'id'
    $id = $_GET['delete'];

    // Select all the ideas in the idea table that were proposed by the user
    $results = mysqli_query($conn, "SELECT * FROM idea WHERE user__id='$id'");

    while ($row = mysqli_fetch_array($results)) {
        
        $idea_id = $row['id'];

        // Delete all ratings from idea posted by the user
        $sql = "DELETE FROM rating WHERE idea_id=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'DELETE' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../manageusers.php?error=sqlerror");
            exit();
        }
        else {
            // Bind varibales the to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $idea_id);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
        }

       // Delete all comments from ideas that were posted by the user
        $sql = "DELETE FROM comment WHERE idea_id=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'DELETE' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../manageusers.php?error=sqlerror");
            exit();
        }
        else {
            // Bind varibales the to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $idea_id);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
        }  
    }

    // Delete all ratings the user gave
    $sql = "DELETE FROM rating WHERE user__id=?";
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

    // Delete all comments belonging to user from the database
    $sql = "DELETE FROM comment WHERE user__id=?";
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

    // Delete all ideas belonging to user from the database
    $sql = "DELETE FROM idea WHERE user__id=?";
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

    // Delete the user from the database
    $sql = "DELETE FROM user WHERE id=?";
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

    if ($id == $_SESSION['user_id']) {
        session_start();
        session_unset();
        session_destroy();

        // Return user to login page
        header("Location: ../../login.php");
    }
    else {
    // Return the user the 'Manage Categories' page with a success message
    header("Location:../manageusers.php?userdeleted");
    }

    // Close connection string
    mysqli_close($conn);

}

// If user clicks the 'Update' button
else if (isset($_POST['update-user'])) {

    // Database Connection
    require 'dbh.inc.php';

    // Declare variables
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['mail'];

    // Check if the user selected a user role
    if(isset($_POST["userrole"]))  
    { 
        // Retrieve the selected user role
        foreach ($_POST['userrole'] as $user_role);            
    }
    else {
        // Display an error if the user does not select a department
        header("Location: ../manageusers.php?error=emptydprtmnt&fname=".$firstname."&lname=".$lastname."&mail=".$email."&gndr=".$gender);
        exit();
    }

    // Check if the user selected a department
    if(isset($_POST["dprtmnt"]))  
    { 
        // Retrieve the selected department
        foreach ($_POST['dprtmnt'] as $department);            
    }
    else {
        // Display an error if the user does not select a department
        header("Location: ../manageusers.php?edit=$id?error=emptydprtmnt&fname=".$firstname."&lname=".$lastname."&mail=".$email."&gndr=".$gender);
        exit();
    }
    // Check if the user selected a gender 
    if(isset($_POST["gndr"]))  
    { 
        // Retrieve the selected gender
        foreach ($_POST['gndr'] as $gender);            
    }
    else {
        // Display an error if the user does not select a gender
        header("Location: ../manageusers.php?edit=$id?error=emptygndr&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department);
        exit();
    }

    // Display an error if the user leaves an empty field
    if (empty($firstname) || empty($lastname) || empty($email)) {
        header("Location: ../manageusers.php?edit=$id?error=emptyfields&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department."&gndr=".$gender);
        exit();
    }
    // Display an error if the user enters an invalid email, first name or last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstname) && !preg_match("/^[a-zA-Z0-9]*$/", $lastname)) {
        header("Location: ../manageusers.php?edit=$id?error=invalidmailfnamelname");
        exit();
    }
    // Display an error if the user enters an invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../manageusers.php?edit=$id?error=invalidmail&fname=".$firstname."&lname=".$lastname);
        exit();
    }
    // Display an error if the user enters an invalid first name
    else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        header("Location: ../manageusers.php?edit=$id?error=invalidfname&lname=".$lastname."&mail=".$email);
        exit();
    }
    // Display an error if the user enters an invalid last name
    else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header("Location: ../manageusers.php?edit=$id?error=invalidlname&fname=".$firstname."&mail=".$email);
        exit();
    }
    else {

        //Insert user details into the database
        $sql = "UPDATE user SET first_name='$firstname', last_name='$lastname', email='$email', department_id='$department', gender='$gender', user_role='$user_role' WHERE id='$id'";
        $stmt = mysqli_stmt_init($conn);
        // Check for sql syntax error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error if there is an sql syntax error in the 'INSERT INTO' statement
        header("Location: ../manageusers.php?edit=$id?error=sqlerror");
        exit();
        }
        else {
        // Bind varibales the variables to a prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $department, $gender, $user_role);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        // Return the user to the login page with a success message
        header("Location: ../manageusers.php?update=success");
        exit();
        }

    }

}

else {
    // Send user back to registration page, if page was accessed without clicking 'register' button
    header("Location: ../manageusers.php");
    exit();
}