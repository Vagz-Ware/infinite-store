<?php

function js_redirect($url, $delay=5000) {


    echo "<script type='text/javascript'>setTimeout(function(){ window.location.href = '$url';  }, $delay);</script>";
}



// Check if the form has been submitted
if(isset($_POST['submit_billing_details'])){
    $user_first_name = trim($_POST['user_first_name']);
    $user_last_name = trim($_POST['user_last_name']);
    $user_street_address = trim($_POST['user_street_address']);
    $user_house_number = trim($_POST['user_house_number']);
    $user_city = trim($_POST['user_city']);
    $user_province = trim($_POST['user_province']);
    $user_post_code = trim($_POST['user_post_code']);
    $user_phone_number = trim($_POST['user_phone_number']);
    $user_email_address = trim($_POST['user_email_address']);
    js_redirect('order_slip.php');
    exit;
} else {
    echo "There was a mistake with your delivery details or Card information, please verify them then try again";
    js_redirect('checkout.php');
}

?>
