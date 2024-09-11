<?php
require 'connection.php';
session_start();
$name = $_SESSION['admin_name'] ?? null;

if (!isset($name)) {
    echo "You are not logged in";
    echo "<script>
            setTimeout(function(){
                window.location.href = 'index.php';
            }, 2000);
          </script>";
    exit();
}

$fetch_user_info = mysqli_query($conn, "SELECT * FROM `admins_tb` WHERE `admin_fullname` = '$name'") or die('Query Failed');

if (mysqli_num_rows($fetch_user_info) > 0) {
    $row = mysqli_fetch_assoc($fetch_user_info);
} else {
    echo "No user found.";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
} else {
    echo "<script>
            setTimeout(function(){
                window.location.href = 'admin_product_page.php';
            }, 0);
          </script>";
    exit();
}

if (isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'images/' . $product_image;

    if (empty($product_name) || empty($product_description) || empty($product_price) || empty($product_image)) {
        echo '<span class="message">Please fill out all fields!</span>';
    } else {
        $update_data = "UPDATE `products_tb` SET product_name='$product_name', product_description='$product_description', product_price='$product_price', product_image='$product_image' WHERE product_barcode='$id'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'admin_products.php';
                    }, 0);
                  </script>";
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

    <?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<span class="message">' . $msg . '</span>';
    }
}
?>


<section class="product-update">
  
<div class="container mt-5 ">
    <div class="login-form mt-5 mb-5 mx-5 p-5">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM products_tb WHERE product_barcode='$id'");
        if ($select && mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
        ?>
        <form action="" method="post" enctype="multipart/form-data">

            <h3 class="title text-center">Update the Product</h3>

            <div class="form-group mt-5">
            <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="Enter the product name">
            </div>

            <div class="form-group my-3">
            <input type="text" class="form-control" name="product_description" value="<?php echo $row['product_description']; ?>" placeholder="Enter the product description">
            </div>

            <div class="form-group my-3">
              
            <input type="number" step="any" min="0" class="form-control" name="product_price" value="<?php echo $row['product_price']; ?>" placeholder="Enter the product price">
            </div>

            <div class="form-group my-3"></div>

            <input type="file" class="form-control" name="product_image" accept="image/png, image/jpeg, image/jpg">
            <input type="submit" value="Update Product" name="update_product" class="btn px-4 infinite-btns mt-3">
            <a href="admin_products.php" class="btn px-4 infinite-btns mt-3">View Products</a>
        </form>
        <?php
        } else {
            echo '<p class="message">Product not found!</p>';
        }
        ?>
    </div>
</div>
</section>



<!-- Footer -->
<footer class="footer py-2 mt-auto">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->

</body>
</html>