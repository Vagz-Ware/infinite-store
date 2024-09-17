<?php
require 'connection.php';
session_start();
$name = $_SESSION['user_name'] ?? null;


$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session

$fetch_user_info = mysqli_query($conn, "SELECT * FROM `users_tb` WHERE `user_fullname` = '$name'") or die("Failed to fetch user information");

if (mysqli_num_rows($fetch_user_info) > 0 ){
  $user_info_row = mysqli_fetch_assoc($fetch_user_info);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infinite-Home</title>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/main.js"></script>
    <script src="js/aos.js"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
    rel="stylesheet">


</head>
<body class="d-flex flex-column min-vh-100
">

<!-- Navbar -->
<nav class="navbar navbar-custom py-3 sticky-top">
  <div class="container-fluid top-nav py-1">

    
    <div class=" d-flex align-items-center">
      <button class="navbar-toggler remove-toggle-bg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <i class="ri-menu-line nav-icons"></i>
      <span class="ms-2">Menu</span>
      </button>
      <button class="nostyle-btn" onclick="displaySearchContainer()">
      <i class="ri-search-line ms-3 nav-icons"></i>
      <span class="ms-2">Search</span>
      </button>
     
      
      
    </div>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title company-logo" id="offcanvasNavbarLabel">Infinite</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active-link ms-3 sidebar-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-3 sidebar-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Brands
            </a>
            <ul class="dropdown-menu ms-4 custom-drop-link">
              <li><a class="dropdown-item brand-drop-links" href="AP_brand.php">Audemar Piguets</a></li>
              <li><a class="dropdown-item brand-drop-links" href="LV_brand.php">Louis Vuitton</a></li>
              <li><a class="dropdown-item brand-drop-links" href="Rolex_brand.php">Rolex</a></li>
          </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="user_profile.php">Profile</a>
          </li>

          <li class="nav-item">
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="user_login.php">Login/Register</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="logout.php">Logout</a>
          </li>
        </ul>
        
      </div>
    </div>
    <a href="index.php" class="navbar-brand mx-auto company-logo">Infinite</a>

    <div class="d-flex align-items-center ms-auto">
      <!-- Add your items here -->
      <a href="user_profile.php" class="nav-icons me-5"><i class="ri-user-line"></i></a>
      <a href="user_wishlist.php" class="nav-icons me-5"><i class="ri-heart-line"></i></a>
      <a href="view_cart.php" class="nav-icons me-5">
    <i class="ri-shopping-cart-line"></i>
    <span class="cart-count"><?php echo $count; ?></span>
</a>

    </div>

  </div>
  
  <div class="search-container w-100 sticky-top">
    <form class="d-flex w-auto search-form" role="search" action="search_page.php" method="POST">
            <button class="nostyle-btn me-5 search-btn-in-form" type="submit" name="search_btn">
           <i class="ri-search-line"></i>
           </button>
          <input class="form-control me-2 rounded-pill ms-5 border-dark search-input" type="search" placeholder="Search for 'Rolex Sky Dweller 3000'" aria-label="Search" name="search_data">
          <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
           
          <button class="nostyle-btn" onclick="hideSearchContainer()">
          <i class="ri-close-large-line ms-5 mt-1 me-2 search-cancel"></i>
          </button>
        </form>
    </div>
</nav>
    <!-- Navbar -->
     
<section class="view-cart-section mt-5">
  <div class="container"><div class="row">
    <div class="col-8">
      <h2 class="mb-5">Shopping Cart</h2>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Product</th>
      <th scope="col">Price</th>
      <th scope="col" class="text-center">Quantity</th>
      <th scope="col">Subtotal</th>
      <th scope="col" class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>

<?php 
  
  $shipping_fee = 700;
  $grand_total;

  if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
    $grand_subtotal = 0; // Initialize grand subtotal

    foreach($_SESSION['cart'] as $pid => $item){
      $item_subtotal = $item['price'] * $item['quantity'] ;
      $formatted_item_subtotal = number_format($item_subtotal, 2, '.', ',');
      $item['price'] = number_format($item_subtotal, 2, '.', ',');
      $grand_subtotal += $item_subtotal; // Add item subtotal to grand subtotal


      echo '<form action="cart_functions.php" method="post">';
      echo '<tr">';
      echo '<input type="hidden" name="pid" value="' . $pid . '">';
      echo '<th class="table-header-prod-title" scope="row" style="display: flex; align-items: center;">
        <button class="nostyle-btn" type="submit" name="btn_del" style="margin-right: 10px;">
            <i class="ri-close-large-line me-2"></i>
        </button> 
        <img class="view-cart-img me-3" src="images/' . $item["image"] . '" style="margin-right: 10px;">
        <p class="text-ellipsis" style="margin: 0;">' . $item['name'] . '</p>
      </th>';


      echo '<td class="table-header-cart-text text-ellipsis">R '.$item['price'].'</td>';
      echo '<td class="table-header-cart-text text-center"> <input type="number" min="1" class="w-50" name="new_item_quantity" value="'.$item['quantity'].'"></td>';
      echo '<td class="table-header-cart-text table-header-cart-text-price text-ellipsis"> R '.$formatted_item_subtotal.'</td>';
      echo ' <td class="table-header-cart-text"><div class="cart-btns"><button class="infinite-btns p-1 me-1" type="submit" name="update_quantity_btn">Update</button> <button class="infinite-btns p-1" type="submit" name="btn_del">Delete</button></div></td>';
      
      // echo '<td class="table-header-cart-text"><button class="infinite-btns p-1" type="submit" name="btn_del">Delete</button></td>';
      echo '</tr>';
      echo '</form>';
    }
  }
?>
  </tbody>
</table>
    </div>
    <div class=" col-4 text-center">
    <h2 class="mb-5">Cart Total</h2>
    <div class="ms-4 cart-total-displays">
      <div class="ps-2"><p>Subtotal</p></div>
      <div><p class="">R <?php
        if (isset($grand_subtotal)) {
            $formatted_grand_subtotal = number_format($grand_subtotal, 2, '.', ',');
            echo "$formatted_grand_subtotal";
        } else{
          echo "0.00";
        }
        ?>
</p></div>
      
    </div>

    <div class=" ms-4 mt-2 cart-total-displays">
      <div><p>Shipping</p></div>
      <div><p class="">R <?php
    if (isset($shipping_fee)) {
        $formatted_shipping_fee = number_format($shipping_fee, 2, '.', ',');
        echo "$formatted_shipping_fee";
    }
    ?></p></div>
      
    </div>
    <div class=" ms-4 mt-2 cart-grand-total-displays">
      <div class="ps-2"><p>Total</p></div>
      <div><p class="">R <?php 
if (isset($grand_subtotal) && isset($shipping_fee)) {
    $grand_total = $grand_subtotal + $shipping_fee;
    $formatted_grand_total = number_format($grand_total, 2, '.', ',');
    echo "$formatted_grand_total";
} else{
  echo "0.00";
}
?>
</p></div>
      
    </div>
    <button type="button" class="infinite-btns-xl py-2 mt-2" name="Submit_login_info" onclick="changeToCheckout()">Proceed To Checkout</button>
          
    </div>
  </div></div>
  
</section>


<!-- Footer -->
    <footer class="footer py-2 mt-auto ">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->

</body>
</html>