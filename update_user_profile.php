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
    <title>Infinite-Product</title>
    
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
<body>

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
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="logout.php">Logout</a>
          </li>
        </ul>
        
      </div>
    </div>
    <a href="index.php" class="navbar-brand mx-auto company-logo">Infinite</a>

    <div class="d-flex align-items-center ms-auto">
      <!-- Add your items here -->
      <a href="#" class="nav-icons me-5"><i class="ri-user-line"></i></a>
      <a href="#" class="nav-icons me-5"><i class="ri-heart-line"></i></a>
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

    <!-- Update user section -->
<section class="update-user-section mt-5 mb-5">  
<div class="container">
<div class="user-update-form-container centered px-5">
        <h2 class="text-center mb-5 mt-5">Update the details below:</h2>
        <form action="update_user_profile.php" class="mb-5" autocomplete="off"  enctype="multipart/form-data" method="POST">
            <div class="form-group mb-3 hidden">
                <input type="hidden" class="form-control"  id="id" aria-describedby="id" name="id" value="<?php echo $user_info_row['user_id']; ?>">
            </div>
<!-- 
            <div class="form-group mt-3 mb-3 hidden">
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder ="Email">
                </div> -->

            <div class="form-group mt-3 mb-3">
                <input type="text" class="form-control" id="name" readonly aria-describedby="name" name="name" value="<?php echo $user_info_row['user_fullname']; ?>">
            </div>

            <div class="form-group mt-3 mb-3">
                
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" readonly value="<?php echo $user_info_row['user_email']; ?>">
                
            </div>
            <div class="form-group mt-3 mb-3">
                
                <input type="text" class="form-control" id="address" aria-describedby="address" name="address" 
                placeholder="Home Address"
                value="<?php echo $user_info_row['user_address']; ?>">
            </div>
            <div class="form-group mt-3 mb-3">
                
                <input type="text" class="form-control" id="mobile_number" aria-describedby="mobile_number" name="mobile_number" value="<?php echo $user_info_row['user_mobile_number']; ?>">
            </div>
            <!-- <div class="mb-3">
               
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $user_info_row['user_password']; ?>">
                
            </div> -->
            <div class="mb-3">
        <label for="profile_picture" class="form-label">Upload Profile Picture</label>
        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
    </div>

            <button type="submit" class="px-4 infinite-btns" name="Submit_update_info">Update</button>
            
            <button type="button" class="px-4 infinite-btns" onclick="changeToUserProfile()">Back to profile</button>
        </form>
    </div>
</div>
</section>


<!-- Update user section -->


<!-- Footer -->
<footer class="footer py-2 mt-auto">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->
</body>
</html>