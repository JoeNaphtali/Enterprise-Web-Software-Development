<?php

if (isset($_POST["add_users_btn"])) {

    require 'dbh.inc.php';
   
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_role = "user_role";

    // Check if department is selected 
   
    if(isset($_POST["Departments"]))  
    { 
        // Retrieve each selected option 
        
        foreach ($_POST['Departments'] as $department);            
    }
    else {
        header("Location: ../add_user.php?error=emptyDepartments&fname=".$firstname."&lname=".$lastname."&email=".$email."&gender=".$gender);
        exit();
    }
    if(isset($_POST["User_roles"]))  
    { 
        // Retrieve each selected option 
        
        foreach ($_POST['User_roles'] as $user_role);            
    }
    else {
        header("Location: ../add_user.php?error=emptyDepartments&fname=".$firstname."&lname=".$lastname."&email=".$email."&gender=".$gender);
        exit();
    }

    // Check if gender is selected 
    if(isset($_POST["Gender"]))  
    { 
        // Retrieve each selected option 
       foreach ($_POST['Gender'] as $gender);            
    }
    else {
        header("Location: ../add_user.php?error=emptyGender&fname=".$firstname."&lname=".$lastname."&email=".$email."&Departments=".$department);
        exit();
    }

    // Validate for empty fields
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        header("Location: ../add_user.php?error=emptyfields&fname=".$firstname."&lname=".$lastname."&email=".$email."&Departments=".$department."&gender=".$gender);
        exit();
    }
    // Validate for invalid email, first name and last name
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstname) && !preg_match("/^[a-zA-Z0-9]*$/", $lastname)) {
        header("Location: ../add_user.php?error=invalidemailfnamelname");
        exit();
    }
    // Validate for invalid email address
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../add_user.php?error=invalidemail&fname=".$firstname."&lname=".$lastname);
        exit();
    }
    // Validate for invalid first name
    else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
        header("Location: ../add_user.php?error=invalidfname&lname=".$lastname."&email=".$email);
        exit();
    }
    // Validate for invalid last name
    else if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
        header("Location: ../add_user.php?error=invalidlname&fname=".$firstname."&email=".$email);
        exit();
    }
    else {

        // Check if email address user typed already exists sin database
        $sql = "SELECT email FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../add_user.php?error=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../add_user.php?error=emailtaken&fname=".$firstname."&lname=".$lastname);
                exit();
            }
            else {
                //Inserting user details into database
                $sql = "INSERT INTO user (first_name, last_name, email, user_password, department, gender, user_role) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                // Check for sql syntax error
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../add_user.php?error=sqlerror2");
                exit();
                }
                else {

                // Hash user password
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $email, $hashedPwd, $department, $gender, $user_role);
                mysqli_stmt_execute($stmt);
                header("Location: ../add_user.php?add_user=success");
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
    // Send user back to registration page, if page was accessed without clicking 'add_user' button
    header("Location: ../add_user.php");
    exit();
}