<?php

require 'connection.php';
session_start();

if (isset($_POST['Submit_login_info'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors = [];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is invalid.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password cannot be empty.";
    }

    if (empty($errors)) {
        // Sanitize email before using in SQL query
        $email = mysqli_real_escape_string($conn, $email);

        // Determine the type of user based on the email domain
        if (strpos($email, '@admin.com') !== false) {
            $query = "SELECT * FROM `admins_tb` WHERE `admin_email` = '$email'";
            $redirectUrl = "view_admin_profile.php";
            $sessionVar = 'admin_name';
            $passwordField = 'admin_password';
            $fullnameField = 'admin_fullname';
        } else {
            $query = "SELECT * FROM `users_tb` WHERE `user_email` = '$email'";
            $redirectUrl = "index.php";
            $sessionVar = 'user_name';
            $passwordField = 'user_password';
            $fullnameField = 'user_fullname';
        }

        // Query to retrieve the user with the provided email
        $loginQuery = mysqli_query($conn, $query) or die('Query Failed');

        if ($loginQuery && mysqli_num_rows($loginQuery) > 0) {
            $row = mysqli_fetch_assoc($loginQuery);

            // Verify the password using password_verify
            if (password_verify($password, $row[$passwordField])) {
                $_SESSION[$sessionVar] = $row[$fullnameField];
                echo "Logging you in...";
                echo "<script>window.location.href = '$redirectUrl';</script>";
                exit; // Ensure script execution stops after redirection
            } else {
                // Password is incorrect
                echo "Password is incorrect.";
                echo "<script>window.location.href = 'user_login.php';</script>";
                exit;
            }
        } else {
            // No user found with the provided email
            echo "User does not exist.";
            echo "<script>window.location.href = 'user_login.php';</script>";
            exit;
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo "<script>window.location.href = 'admin_signin_form.php';</script>";
        exit;
    }
}
?>
