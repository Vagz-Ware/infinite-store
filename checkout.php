<?php

require 'connection.php';

session_start();

$name = $_SESSION['user_name'] ?? null;
$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session

$fetch_user_info = mysqli_query($conn, "SELECT * FROM `users_tb` WHERE `user_fullname` = '$name'") or die("Failed to fetch user information");

if (mysqli_num_rows($fetch_user_info) > 0) {
  $user_info_row = mysqli_fetch_assoc($fetch_user_info);
}

if (!isset($name)) {
  echo "You are not logged in, Please login";
  header("refresh:2; url=user_login.php");
  exit; // Ensure script execution stops after redirection
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinite-Home</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-custom py-3 sticky-top">
        <div class="container-fluid top-nav py-1">
            <!-- Navbar content here -->
        </div>
        <div class="search-container w-100 sticky-top">
            <form class="d-flex w-auto search-form" role="search" action="search_page.php" method="POST">
                <button class="nostyle-btn me-5 search-btn-in-form" type="submit" name="search_btn">
                    <i class="ri-search-line"></i>
                </button>
                <input class="form-control me-2 rounded-pill ms-5 border-dark search-input" type="search" placeholder="Search" aria-label="Search" name="search_data">
                <button class="nostyle-btn" onclick="hideSearchContainer()">
                    <i class="ri-close-large-line ms-5 mt-1 me-2 search-cancel"></i>
                </button>
            </form>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Checkout and user details section -->
    <section class="checkout-section mb-5 mt-5">
        <div class="overlay-container" onclick="off()" id="overlay"></div>
        <div class="container checkout-main-container">
            <div class="row">
                <div class="col ms-5">
                    <h3 class="text-center mb-5">Billing Details</h3>
                    <div class="checkout-form-container">
                        <form id="checkout-form" action="checkout_func.php" method="POST">
                            <div class="fname-and-lname-container">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_first_name" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_last_name" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="user_street_address" placeholder="Street Address" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="user_house_number" placeholder="House Number/Apartment Unit Number" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="user_city" placeholder="City" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="user_province" placeholder="Province" required>
                            </div>
                            <div class="form-group my-3">
                                <input type="text" class="form-control" name="user_post_code" placeholder="Post Code or Zip Code" required>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="user_phone_number" placeholder="Phone Number" required>
                            </div>
                            <div class="form-group my-3">
                                <input type="email" class="form-control" name="user_email_address" placeholder="Email Address" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-5 me-2">
                    <h3 class="text-center mb-5">Your Order</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $shipping_fee = 700;
                            $grand_subtotal = 0; // Initialize grand subtotal

                            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                                foreach($_SESSION['cart'] as $pid => $item){
                                    $item_subtotal = $item['price'] * $item['quantity'];
                                    $formatted_item_subtotal = number_format($item_subtotal, 2, '.', ',');
                                    $grand_subtotal += $item_subtotal;
                                    echo '<tr>';
                                    echo '<th class="table-header-prod-title" scope="row">' . $item['name'] . ' x ' .$item['quantity'].' </th>';
                                    echo '<td class="table-header-cart-text">R '.$formatted_item_subtotal.'</td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                            <tr>
                                <th class="text-center">Subtotal</th>
                                <td>R <?php echo number_format($grand_subtotal, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <th class="text-center">Shipping</th>
                                <td>R <?php echo number_format($shipping_fee, 2, '.', ','); ?></td>
                            </tr>
                            <tr>
                                <th class="text-center">Total</th>
                                <td>R <?php 
                                $grand_total = $grand_subtotal + $shipping_fee;
                                echo number_format($grand_total, 2, '.', ','); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="py-3 infinite-btns w-100" id="placeOrderButton">Place Order</button>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="checkout-form mt-5 mb-5 mx-5 p-5 card-payment-row" style="display: none;">
                        <button class="payment-close-btn"><i class="ri-close-large-line payment-cancel"></i></button>
                        <center>
                            <div class="login-title">
                                <h3>Lets Finalise the Payment</h3>
                                <div class="info-protected">
                                    <p>Your information is protected</p>
                                </div>
                            </div>
                        </center>
                        <div class="payment-form-container">
                            <form class="mb-3 payment-form" id="payment-form" action="checkout_func.php" method="POST">
                                <div class="form-group mt-3">
                                    <input type="number" min="1" class="form-control" name="card_number" placeholder="Card Number" required>
                                </div>
                                <div class="cvv-and-dates mb-3">
                                    <div class="only-dates">
                                        <div class="form-group mt-3 dates">
                                            <input type="number" min="1" class="form-control" name="exp_year" placeholder="YY" required>
                                        </div>
                                        <div class="form-group mt-3 dates">
                                            <input type="number" min="1" class="form-control" name="exp_month" placeholder="MM" required>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="number" min="1" class="form-control" name="cvv" placeholder="CVV" required>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="px-4 infinite-btns submit-billing-details" id="proceedButton" name="submit_billing_details" form="checkout-form">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="processingMessage" class="hidden-processor">
                <div class="loader">
                    <span style="--i:1;"></span>
                    <span style="--i:2;"></span>
                    <span style="--i:3;"></span>
                    <span style="--i:4;"></span>
                    <span style="--i:5;"></span>
                    <span style="--i:6;"></span>
                    <span style="--i:7;"></span>
                    <span style="--i:8;"></span>
                    <span style="--i:9;"></span>
                    <span style="--i:10;"></span>
                    <span style="--i:11;"></span>
                    <span style="--i:12;"></span>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout and user details section -->
    
    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <!-- Footer content here -->
        </div>
    </footer>
    <!-- Footer -->

    <!-- Custom JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="js/script.js"></script>

    <script>
    // JavaScript handling the form submission and showing processing state
    $(document).ready(function(){
        $('#placeOrderButton').click(function(){
            $('.card-payment-row').slideDown(900);
            $('#overlay').fadeIn(300);
        });

        $('.payment-close-btn').click(function(){
            $('.card-payment-row').slideUp(300);
            $('#overlay').fadeOut(300);
        });

        $('#proceedButton').click(function(){
            // Simulate a delay for payment processing
            $('#processingMessage').fadeIn(300);
            setTimeout(function(){
                $('#payment-form').submit();
            }, 2000); // Adjust delay as needed (2 seconds here)
        });
    });
    </script>
</body>
</html>
