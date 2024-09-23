<?php
require 'connection.php';

session_start();

$custom_id = $_SESSION['custom_id'] ?? null;

$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session

$fetch_user_info = mysqli_query($conn, "SELECT * FROM `users_tb` WHERE `user_id` = '$custom_id'") or die("Failed to fetch user information");

if (mysqli_num_rows($fetch_user_info) > 0 ){
  $user_info_row = mysqli_fetch_assoc($fetch_user_info);
}



if (!isset($custom_id)){
//  js_redirect('user_login.php');
  echo "You are not logged in, Please login";
 header("refresh:2; http://localhost/dashboard/infinite%20watches/user_login.php");
  exit; // Ensure script execution stops after redirection
}


function js_redirect($url) {
    echo "<script type='text/javascript'>setTimeout(function(){ window.location.href = '$url'; });</script>";
}

// if (!isset($session_name)) {
//     echo "You are not logged in";
//     header("refresh:2; url=http://localhost/dashboard/login%20details/index.php");
//     exit;
// }

if (isset($_POST['Submit_update_info'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['mobile_number'];

    $user_image = $_FILES['profile_picture'];

    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $uploadDir = 'uploads/profile_pictures/';
        $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);
    
        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the server
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile);
        
        $user_image = $uploadFile; // Save the file path in a variable
    } else {
        $user_image = null; // Set to null if no image is uploaded
    }

    // Build the query
    $query = "UPDATE `users_tb` SET `user_fullname` = '$name', `user_email` = '$email', `user_address` = '$address', `user_mobile_number` = '$number'";

    // Only include the image update if a new image is uploaded
    if ($user_image) {
        $query .= ", `user_image` = '$user_image'";
    }

    $query .= " WHERE `user_id` = '$id'";

    // Execute the update query
    $update_user_info = mysqli_query($conn, $query);

    if ($update_user_info) {
        echo "Update was successful";
        js_redirect('user_profile.php');
        exit;
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}
?>
