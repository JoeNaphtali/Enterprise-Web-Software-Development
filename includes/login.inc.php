<?php

if (isset($_POST['login-submit'])) {


    require 'dbh.inc.php';

    $email = $_POST['mail'];
    $password = $_POST['pwd'];

    if (empty($email) || empty($password)) {
        header("Location: ../login.php?error=emptyfields&mail=".$email);
        exit();
    }
    else {
        $sql = "SELECT * FROM user WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['user_password']);
                if ($pwdCheck == false) {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
                else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_role'] = $row['user_role'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
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