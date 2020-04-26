<?php

// If user clicks the 'Register' button
if (isset($_POST['register-submit'])) {

    // Database conneciton
    require 'dbh.inc.php';

    // Declare variables
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $user_role = "staff"; // Set the default user role as 'staff' for any user that registers using the 'Register' page

    // Check if the user selected a department
    if(isset($_POST["dprtmnt"]))  
    { 
        // Retrieve the selected department
        foreach ($_POST['dprtmnt'] as $department);            
    }
    else {
        // Display an error if the user does not select a department
        header("Location: ../register.php?error=emptydprtmnt&fname=".$firstname."&lname=".$lastname."&mail=".$email."&gndr=".$gender);
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
        header("Location: ../register.php?error=emptygndr&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department);
        exit();
    }

    // Display an error if the user leaves an empty field
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../register.php?error=emptyfields&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department."&gndr=".$gender);
        exit();
    }
    // Display an error if the user enters an invalid email, first name or last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstname) && !preg_match("/^[a-zA-Z0-9]*$/", $lastname)) {
        header("Location: ../register.php?error=invalidmailfnamelname");
        exit();
    }
    // Display an error if the user enters an invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail&fname=".$firstname."&lname=".$lastname);
        exit();
    }
    // Display an error if the user enters an invalid first name
    else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        header("Location: ../register.php?error=invalidfname&lname=".$lastname."&mail=".$email);
        exit();
    }
    // Display an error if the user enters an invalid last name
    else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header("Location: ../register.php?error=invalidlname&fname=".$firstname."&mail=".$email);
        exit();
    }
    // Check if passwords match
    else if ($password !== $passwordRepeat) {
        // Display error if passwords do not match
        header("Location: ../register.php?error=passwordcheck&fname=".$firstname."&lname=".$lastname."&mail=".$email);
        exit();
    }
    else {

        // Check if email address the user entered already exists in the database
        $sql = "SELECT email FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is an sql syntax error in the 'SELECT' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        }
        else {
            // Bind varibales the variables to a prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $email);
            // Execute prepared statement
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            // Display error if email address already exists in database
            if ($resultCheck > 0) {
                header("Location: ../register.php?error=emailtaken&fname=".$firstname."&lname=".$lastname);
                exit();
            }
            else {

                //Insert user details into the database
                $sql = "INSERT INTO user (first_name, last_name, email, user_password, department, gender, user_role) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                // Check for sql syntax error
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                // Display error if there is an sql syntax error in the 'INSERT INTO' statement
                header("Location: ../register.php?error=sqlerror");
                exit();
                }
                else {

                // Hash the user password
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                // Bind varibales the variables to a prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $email, $hashedPwd, $department, $gender, $user_role);
                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
                // Return the user to the login page with a success message
                header("Location: ../login.php?register=success");
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
else {
    // Send user back to registration page, if page was accessed without clicking 'register' button
    header("Location: ../register.php");
    exit();
}