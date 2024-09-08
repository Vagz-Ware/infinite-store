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

        // Query to retrieve the user with the provided email
        $loginQuery = mysqli_query($conn, "SELECT * FROM `admins_tb` WHERE `admin_email` = '$email'") or die('Query Failed');

        if ($loginQuery) {
            // If there is a result for the email
            if (mysqli_num_rows($loginQuery) > 0) {
                $row = mysqli_fetch_assoc($loginQuery);
                
                // Verify the password using password_verify
                if (password_verify($password, $row['admin_password'])) {
                    $_SESSION['admin_name'] = $row['admin_fullname'];
                    // Password is correct, perform further actions
                    echo "Logging you in 2 seconds...";
                    // Redirect the user to the desired page
                    echo "<script>
                            setTimeout(function(){
                                window.location.href = 'admin_dashboard.php';
                            }, 2000);
                          </script>";
                    exit; // Ensure script execution stops after redirection
                } else {
                    // Password is incorrect
                    echo "Password is incorrect.";
                    echo "<script>
                            setTimeout(function(){
                                window.location.href = 'admin_signin_form.php';
                            }, 2000);
                          </script>";
                }
            } else {
                // No user found with the provided email
                echo "User does not exist.";
                echo "<script>
                        setTimeout(function(){
                            window.location.href = 'admin_signin_form.php';
                        }, 2000);
                      </script>";
            }
        } else {
            // Query failed
            die('Query Failed');
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo "<script>
                setTimeout(function(){
                    window.location.href = 'admin_signin_form.php';
                }, 2000);
              </script>";
    }
}
?>
