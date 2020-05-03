<?php

// If user clicks the 'Update' button
if (isset($_POST['update-account'])) {

    // Database Connection
    require 'dbh.inc.php';

    // Declare variables
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    // Check if the user selected a department
    if(isset($_POST["dprtmnt"]))  
    { 
        // Retrieve the selected department
        foreach ($_POST['dprtmnt'] as $department);            
    }
    else {
        // Display an error if the user does not select a department
        header("Location: ../account.php?edit=$id?error=emptydprtmnt&fname=".$firstname."&lname=".$lastname."&mail=".$email."&gndr=".$gender);
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
        header("Location: ../account.php?edit=$id?error=emptygndr&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department);
        exit();
    }

    // Display an error if the user leaves an empty field
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../account.php?edit=$id?error=emptyfields&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department."&gndr=".$gender);
        exit();
    }
    // Display an error if the user enters an invalid email, first name or last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstname) && !preg_match("/^[a-zA-Z0-9]*$/", $lastname)) {
        header("Location: ../account.php?edit=$id?error=invalidmailfnamelname");
        exit();
    }
    // Display an error if the user enters an invalid email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../account.php?edit=$id?error=invalidmail&fname=".$firstname."&lname=".$lastname);
        exit();
    }
    // Display an error if the user enters an invalid first name
    else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        header("Location: ../account.php?edit=$id?error=invalidfname&lname=".$lastname."&mail=".$email);
        exit();
    }
    // Display an error if the user enters an invalid last name
    else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header("Location: ../account.php?edit=$id?error=invalidlname&fname=".$firstname."&mail=".$email);
        exit();
    }
    // Check if passwords match
    else if ($password !== $passwordRepeat) {
        // Display error if passwords do not match
        header("Location: ../account.php?edit=$id?error=passwordcheck&fname=".$firstname."&lname=".$lastname."&mail=".$email);
        exit();
    }
    else {

        //Insert user details into the database
        $sql = "UPDATE user SET first_name=?, last_name=?, email=?, user_password=?, department_id=?, gender=?, user_role=? WHERE id='$id'";
        $stmt = mysqli_stmt_init($conn);
        // Check for sql syntax error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Display error if there is an sql syntax error in the 'INSERT INTO' statement
        header("Location: ../account.php?edit=$id?error=sqlerror");
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
        header("Location: ../account.php?update=success");
        exit();
        }

    }

}