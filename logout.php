<?php
include 'connection.php';

// Initialise the session
session_start();


// Unset all the session variables
$_SESSION['cart_count'] = array();

// Destroy the session
session_destroy();
session_abort();

// Redirect the user to the login page
echo "We are about to redirect you to the login page";
echo '<script>window.location.href = "index.php";</script>';
exit();
?>
