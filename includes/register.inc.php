<?php

if (isset($_POST['register-submit'])) {

    require 'dbh.inc.php';

    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $user_role = "staff";

    // Check if department is selected 
    if(isset($_POST["dprtmnt"]))  
    { 
        // Retrieve each selected option 
        foreach ($_POST['dprtmnt'] as $department);            
    }
    else {
        header("Location: ../register.php?error=emptydprtmnt&fname=".$firstname."&lname=".$lastname."&mail=".$email."&gndr=".$gender);
        exit();
    }

    // Check if gender is selected 
    if(isset($_POST["gndr"]))  
    { 
        // Retrieve each selected option 
        foreach ($_POST['gndr'] as $gender);            
    }
    else {
        header("Location: ../register.php?error=emptygndr&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department);
        exit();
    }

    // Validate for empty fields
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../register.php?error=emptyfields&fname=".$firstname."&lname=".$lastname."&mail=".$email."&dprtmnt=".$department."&gndr=".$gender);
        exit();
    }
    // Validate for invalid email, first name and last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstname) && !preg_match("/^[a-zA-Z0-9]*$/", $lastname)) {
        header("Location: ../register.php?error=invalidmailfnamelname");
        exit();
    }
    // Validate for invalid email address
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail&fname=".$firstname."&lname=".$lastname);
        exit();
    }
    // Validate for invalid first name
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $firstname)) {
        header("Location: ../register.php?error=invalidfname&lname=".$lastname."&mail=".$email);
        exit();
    }
    // Validate for invalid last name
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $lastname)) {
        header("Location: ../register.php?error=invalidlname&fname=".$firstname."&mail=".$email);
        exit();
    }
    // Check if passwords match
    else if ($password !== $passwordRepeat) {
        header("Location: ../register.php?error=passwordcheck&fname=".$firstname."&lname=".$lastname."&mail=".$email);
        exit();
    }
    else {

        // Check if email address user typed already exists in database
        $sql = "SELECT email FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../register.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../register.php?error=emailtaken&fname=".$firstname."&lname=".$lastname);
                exit();
            }
            else {

                //Inserting user details into database
                $sql = "INSERT INTO user (first_name, last_name, email, user_password, department, gender, user_role) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                // Check for sql syntax error
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../register.php?error=sqlerror");
                exit();
                }
                else {

                // Hash user password
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $email, $hashedPwd, $department, $gender, $user_role);
                mysqli_stmt_execute($stmt);
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