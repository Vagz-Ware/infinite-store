<?php

require 'connection.php';

session_start();

$name = $_SESSION['admin_name'] ?? null;

function js_redirect($url) {
    echo "<script type='text/javascript'>setTimeout(function(){ window.location.href = '$url'; });</script>";
}

$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session

$fetch_admin_info = mysqli_query($conn, "SELECT * FROM `admins_tb` WHERE `admin_fullname` = '$name'") or die("Failed to fetch admin information");

if (mysqli_num_rows($fetch_admin_info) > 0 ){
  $admin_info_row = mysqli_fetch_assoc($fetch_admin_info);
}



if (!isset($name)){
//  js_redirect('user_login.php');
  echo "You are not logged in, Please login";
 header("refresh:2; http://localhost/dashboard/infinite%20watches/user_login.php");
  exit; // Ensure script execution stops after redirection
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
} else {
    js_redirect('admin_view_admins.php');
    // header('location:view_admins.php');
    exit;
}

if (isset($_POST['update_product'])) {
    $admin_fullname = $_POST['admin_fullname'];
    $admin_email = $_POST['admin_email'];
    $admin_address = $_POST['admin_address'];
    $admin_mobile_number = $_POST['admin_mobile_number'];
    $admin_password = $_POST['admin_password'];
    $passwordHash = password_hash($admin_password, PASSWORD_DEFAULT);


    if (empty($admin_fullname) || empty($admin_email) || empty($admin_address) || empty($admin_mobile_number)) {
        echo '<span class="message">Please fill out all fields ecxept for the password if you do not want to change it!</span>';
    } else {

      if(!empty($admin_password)){
        $passwordHash = password_hash($admin_password, PASSWORD_DEFAULT);
        $update_data = "UPDATE `admins_tb` SET admin_fullname='$admin_fullname', admin_email='$admin_email', admin_address='$admin_address', admin_mobile_number='$admin_mobile_number', admin_password='$passwordHash' WHERE admin_id='$id'";
      }

      else{
        $update_data = "UPDATE `admins_tb` SET admin_fullname='$admin_fullname', admin_email='$admin_email', admin_address='$admin_address', admin_mobile_number='$admin_mobile_number' WHERE admin_id='$id'";
      }


      
        
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            js_redirect('admin_view_admins.php');
        } else {
            echo '<span class="message">Could not update the product!</span>';
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    
     
      
      
    </div>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title company-logo" id="offcanvasNavbarLabel">Infinite</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active-link ms-3 sidebar-link" aria-current="page" href="admin_dashboard.php">Admin Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="admin_users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="admin_products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="admin_admins.php">Admins

            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="admin_profile.php">Admin Profile

            </a>
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
    <a href="logout.php" class="me-5 nav-logout">Logout</a>

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



    <section class="update-admin-form">
      
    <div class="container">
        <div class="row">
            <div class="col">
            <div class="login-form mt-5 mb-5 mx-5 p-5">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM admins_tb WHERE admin_id='$id'");
        if ($select && mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <h3 class="title text-center">Update admin details</h3>

            <div class="form-group mt-5">
              
            <input type="text" class="form-control" name="admin_fullname" value="<?php echo $row['admin_fullname']; ?>" placeholder="Enter the admin's full name" readonly>
            </div>

            <div class="form-group my-3">
              
            <input type="text" class="form-control" name="admin_email"  value="<?php echo $row['admin_email']; ?>" placeholder="Enter the admin's email">
            </div>


            <div class="form-group my-3">
            <input type="text" class="form-control" name="admin_address" value="<?php echo $row['admin_address']; ?>" placeholder="Enter the admin's home address">
            </div>

            
            <div class="form-group my-3">
              
            <input type="text" class="form-control" name="admin_mobile_number"  value="<?php echo $row['admin_mobile_number']; ?>" placeholder="Enter the admin's mobile number">
            </div>


            <div class="form-group my-3">
              
            <input type="password" class="form-control" name="admin_password" placeholder="Insert password only if you want to change it">
            </div>

            <input type="submit" value="Update" name="update_product" class="btn px-4 infinite-btns mt-3">
            <a href="admin_view_admins.php" class="btn px-4 infinite-btns mt-3">Go Back</a>
        </form>
        <?php
        } else {
            echo '<p class="message">Admin not found!</p>';
        }
        ?>
    </div>
            </div>
        </div>
    </div>
    </section>

    
</body>
</html>