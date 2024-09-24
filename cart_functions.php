<?php
session_start();
include 'connection.php'; // Ensure this file has your database connection details
$custom_id = $_SESSION['custom_id'] ?? null;

// Function to redirect using JavaScript
function js_redirect($url) {
    echo "<script type='text/javascript'>setTimeout(function(){ window.location.href = '$url'; });</script>";
}


// Fetch user information from the database
// $fetch_user_info = mysqli_query($conn, "SELECT * FROM `users_tb` WHERE `user_fullname` = '$name'") or die('Query Failed');
// if (mysqli_num_rows($fetch_user_info) > 0) {
//     $row = mysqli_fetch_assoc($fetch_user_info);
// }

// Calculate the total quantity of items in the cart
function getCartCount() {
    $count = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
    }
    return $count;
}

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $pid = $_POST['id'];
    $quantity = 1;

    if (isset($_SESSION['cart'][$pid])) {
        $_SESSION['cart'][$pid]['quantity'] += 1;
    } else {
        $sql = "SELECT * FROM `products_tb` WHERE `product_barcode` = '$pid'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && $pro = mysqli_fetch_assoc($result)) {
            $price = $pro['product_price'];
            $discountPercentage = $pro['product_discount_percentage'];

            // Calculate the discounted price if applicable
            if ($discountPercentage > 0) {
                $discountedPrice = $price - ($price * ($discountPercentage / 100));
            } else {
                $discountedPrice = $price;
            }

            // Add the product to the cart
            $_SESSION['cart'][$pid] = [
                'name' => $pro['product_name'],
                'description' => $pro['product_description'],
                'price' => $discountedPrice,
                'quantity' => $quantity,
                'image' => $pro['product_image'],
            ];
        }
    }

    $count = getCartCount();
    $_SESSION['cart_count'] = $count; // Store the count in the session
    // Insert into cart_order_tb
    $item_image = $_SESSION['cart'][$pid]['image'];
    $item_name = $_SESSION['cart'][$pid]['name'];
    $item_price = $_SESSION['cart'][$pid]['price'];
    $item_description = $_SESSION['cart'][$pid]['description'];
    $item_barcode = $pid;
    // $customer_name = $row['user_fullname'];
    $item_total = $item_price * $quantity;

    // $insert_query = "INSERT INTO `cart_order_tb` (user_fullname, item_name, item_price, item_description, item_barcode, item_image, item_qty, item_total) VALUES ('$customer_name', '$item_name', '$item_price', '$item_description', '$item_barcode', '$item_image', '$quantity', '$item_total' )";
    
    // mysqli_query($conn, $insert_query);

    // if($insert_query){
    // js_redirect('index.php');
    // } else {
    //     echo "Insert query failed";
    // }

    js_redirect('index.php');
    exit;
}

// Handle updating item quantity in the cart
if (isset($_POST['update_quantity_btn'])) {
    $pid = $_POST['pid'];
    $new_quantity = intval($_POST['new_item_quantity']);

    
        // Update the session cart quantity
        $_SESSION['cart'][$pid]['quantity'] = $new_quantity;

        // Get the product price from cart_order_tb
        $select_query = "SELECT * FROM `cart_order_tb` WHERE item_barcode = '$pid'";
        $result = mysqli_query($conn, $select_query);

       

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $price = (float)$row['item_price']; // Cast to float


            // Calculate the new total price
            $total_price = $price * $new_quantity;

            // Update the quantity and total price in cart_tb
            $update_query = "UPDATE `cart_order_tb` SET item_qty = $new_quantity, item_total = $total_price WHERE item_barcode = '$pid'";
            mysqli_query($conn, $update_query);
        }

        $count = getCartCount();
        $_SESSION['cart_count'] = $count; // Store the count in the session
        js_redirect('view_cart.php');
    exit();
}


// Handle removing items from the cart
if (isset($_POST['btn_del'])) {
    $id = $_POST['pid'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);

        // Remove from cart_tb
        $delete_query = "DELETE FROM `cart_order_tb` WHERE item_barcode = '$id'";
        mysqli_query($conn, $delete_query);
    } elseif (isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id]['quantity'] > 1) {
        $_SESSION['cart'][$id]['quantity']--;

        // Optionally update quantity in cart_tb
        $update_query = "UPDATE `cart_tb` SET quantity = quantity - 1 WHERE item_barcode = '$id'";
        mysqli_query($conn, $update_query);
    }


    $count = getCartCount();
    $_SESSION['cart_count'] = $count; // Store the count in the session

    js_redirect('view_cart.php');
    exit;
}

// Handle add to wishlist

if (isset($_POST['add_to_wishlist'])) {

    
if($custom_id == null){
    echo "You need to login before adding to your wishlist";
    
    js_redirect('user_login.php');
    exit;
}

    $pid = $_POST['id'];



        $check_wishlist_for_duplicates = "SELECT * FROM `wishlist_tb` WHERE `product_barcode` = '$pid' AND `user_id` = '$custom_id'";

        $result_from_check_wish_duplicates = mysqli_query($conn, $check_wishlist_for_duplicates);

        if(!$result_from_check_wish_duplicates){
            echo"Error because: ". mysqli_error($conn);
        };

        if (mysqli_num_rows($result_from_check_wish_duplicates) >= 1){
            echo "You have already added this item to your wishlist";
            exit;
        } else {
            $get_from_product_tb = "SELECT * FROM `products_tb` WHERE `product_barcode` = '$pid'";
        $result = mysqli_query($conn, $get_from_product_tb);
        
        if ($result && $pro = mysqli_fetch_assoc($result)) {
            $price = $pro['product_price'];
            $discountPercentage = $pro['product_discount_percentage'];
            $product_barcode = $pro['product_barcode'];
            $product_name = $pro['product_name'];

            $insert_to_wishlist_tb = "INSERT INTO `wishlist_tb`( `product_barcode`, `product_name`, `product_price`, `user_id`) VALUES ('$product_barcode','$product_name','$price','$custom_id')";

            mysqli_query($conn, $insert_to_wishlist_tb);

        }

        }


        
        
        
    js_redirect('index.php');
    exit;
    }

    if (isset($_POST['remove_from_wishlist'])) {
        
        $pid = $_POST['id'];
        
        $remove_from_wishlist_tb = "DELETE FROM `wishlist_tb` WHERE `product_barcode` = '$pid' AND `user_id` = '$custom_id'";
        mysqli_query($conn, $remove_from_wishlist_tb);
        
    js_redirect('user_wishlist.php');
    exit;
    }