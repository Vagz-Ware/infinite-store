<?php
require 'connection.php';
session_start();

if (isset($_POST['submit_registration_info'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $user_email = trim($_POST['email']);
    $user_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $home_address = trim($_POST['address']);
    $mobile_number = trim($_POST['number']);
    $errors = [];

    // Validate first name and last name
    if (!preg_match("/^[a-zA-Z]+$/", $first_name)) {
        $errors[] = "First name is invalid. Only letters are allowed.";
    }

    if (!preg_match("/^[a-zA-Z]+$/", $last_name)) {
        $errors[] = "Last name is invalid. Only letters are allowed.";
    }

    // Validate email
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is invalid.";
    }

    // Ensure email contains '@admin'
    if (strpos($user_email, '@admin') === false) {
        $errors[] = "Email must contain '@admin'.";
    }

    // Validate password length
    if (strlen($user_password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    // Validate password and confirm password match
    if ($user_password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Validate mobile number
    if (!preg_match("/^[0-9]{10,15}$/", $mobile_number)) {
        $errors[] = "Mobile number is invalid. It should contain only numbers and be between 10 to 15 digits long.";
    }

    if (empty($errors)) {
        $passwordHash = password_hash($user_password, PASSWORD_DEFAULT);

        // Check for duplicate email
        $user_email = mysqli_real_escape_string($conn, $user_email);
        $check_for_duplicates = mysqli_query($conn, "SELECT * FROM `admins_tb` WHERE `admin_email` = '$user_email'") or die('Query Failed');
        if (mysqli_num_rows($check_for_duplicates) > 0) {
            echo "User with this email already exists.";
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'admin_register_form.php';
                    }, 2000);
                  </script>";
            exit;
        }

        $first_name = ucwords($first_name);
        $last_name = ucwords($last_name);
        $full_name = $first_name . " " . $last_name;
        $home_address = mysqli_real_escape_string($conn, $home_address);
        $mobile_number = mysqli_real_escape_string($conn, $mobile_number);
        $query = "INSERT INTO `admins_tb` (admin_fullname, admin_email, admin_address, admin_mobile_number, admin_password) VALUES ('$full_name', '$user_email', '$home_address', '$mobile_number', '$passwordHash')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Registration was successful. In 1 second you will be redirected to the login to sign in.";
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'admin_signin_form.php';
                    }, 1000);
                  </script>";
        } else {
            echo "Registration failed. Please try again.";
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'admin_register_form.php';
                    }, 2000);
                  </script>";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo "<script>
                setTimeout(function(){
                    window.location.href = 'admin_register_form.php';
                }, 2000);
              </script>";
    }
}
?>
