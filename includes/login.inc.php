<?php

// If user clicks the login button
if (isset($_POST['login-submit'])) {

    // Database connection
    require 'dbh.inc.php';

    // Declare variables
    $email = $_POST['mail'];
    $password = $_POST['pwd'];

    // Display error if user leaves fields empty
    if (empty($email) || empty($password)) {
        header("Location: ../login.php?error=emptyfields&mail=".$email);
        exit();
    }
    else {
        $sql = "SELECT * FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        // Display error if there is a mysql syntax error when executing the 'SELECT' statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {

                // Verify user password
                $pwdCheck = password_verify($password, $row['user_password']);

                // Display error and return user to login page if password is incorrect
                if ($pwdCheck == false) {
                    header("Location: ../login.php?error=wrongpwd&mail=".$email);
                    exit();
                }

                // Start session if password is correct
                else if ($pwdCheck == true) {

                    session_start();

                    // Declare session variables to track of user information
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_role'] = $row['user_role'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['department'] = $row['department_id'];
                    $_SESSION['login'] = true;

                    header("Location: ../index.php?login=success");
                    exit();

                }
                // Display error and return user to login page if password is incorrect
                else {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }

}
else {
    header("Location: ../login.php");
    exit();
}