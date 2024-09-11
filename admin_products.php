<?php
session_start();

$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the 
require 'connection.php';

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  
  // Fetch the product image to delete it from the directory
  $fetch_image_query = "SELECT product_image FROM products_tb WHERE product_barcode='$id'";
  $fetch_image_result = mysqli_query($conn, $fetch_image_query);
  
  if ($fetch_image_result && mysqli_num_rows($fetch_image_result) > 0) {
      $product = mysqli_fetch_assoc($fetch_image_result);
      $product_image_path = 'images/' . $product['product_image'];
      
      // Delete the product record from the database
      $delete_query = "DELETE FROM products_tb WHERE product_barcode='$id'";
      $delete = mysqli_query($conn, $delete_query);
      
      if ($delete) {
          // Delete the product image from the directory
          if (file_exists($product_image_path)) {
              unlink($product_image_path);
          }
          echo '<span class="message">Product deleted successfully!</span>';
      } else {
          echo '<span class="message">Could not delete the product from the database: ' . mysqli_error($conn) . '</span>';
      }
  } else {
      echo '<span class="message">Product not found!</span>';
  }
}

if (isset($_POST['add_product'])) {
  $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
  $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
  $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
  $product_image_folder = 'images/' . $product_image;

  if (empty($product_name) || empty($product_description) || empty($product_price) || empty($product_image)) {
      echo '<span class="message">Please fill out all fields!</span>';
  } else {
       $barcode = rand(1000, 10000000);
      $insert = "INSERT INTO products_tb (product_barcode,product_name, product_description, product_price, product_image) VALUES ('$barcode','$product_name', '$product_description', '$product_price', '$product_image')";
      $upload = mysqli_query($conn, $insert);

      if ($upload) {
        // Move the uploaded image to the "uploaded_img/" folder
        if (move_uploaded_file($product_image_tmp_name, $product_image_folder)) {
            echo '<span class="message">New product added successfully with image uploaded</span>';
        } else {
            echo '<span class="message">Product added but failed to upload image</span>';
        }
    } else {
        echo '<span class="message">Could not add the product: ' . mysqli_error($conn) . '</span>';
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
    $select_query = "SELECT * FROM `products_tb`";
    $select = mysqli_query($conn, $select_query);

    if (!$select) {
        die('Query Failed: ' . mysqli_error($conn));
    }
    ?>

    <div class="container-fluid">

        <h1 class="my-5 text-center">View All Products</h1>

        <div class="row">

        
        <div class="col my-5">
            <div class="login-form mt-5 mb-5 mx-5 p-5">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

            <h3 class="text-center">Add a New Product</h3>

            <div class="form-group mt-5">              
            <input type="text" placeholder="Enter product name" name="product_name" class="form-control ">
            </div>

            <input type="text" placeholder="Enter product description" name="product_description" class="form-control my-3">
            <input type="number" placeholder="Enter product price" name="product_price" class="form-control my-3">
            <input type="text" placeholder="Enter product brand" name="product_brand" class="form-control my-3">
            <input type="text" placeholder="Enter product arrival status" name="product_arrival_status" class="form-control my-3">
            <input type="text" placeholder="Is the product on discount?" name="product_discount_status" class="form-control my-3">
            
            <input type="text" placeholder="Is the product on discount?" name="product_discount_status" class="form-control my-3">
            
            <input type="text" placeholder="Is the product on discount?" name="product_discount_status" class="form-control my-3">
            
            <input type="text" placeholder="Is the product on discount?" name="product_discount_status" class="form-control my-3">
            
            <input type="text" placeholder="Is the product on discount?" name="product_discount_status" class="form-control my-3">
            
            <input type="text" placeholder="Is the product on discount?" name="product_discount_status" class="form-control my-3">
            
            <input type="text" placeholder="Is the product on discount?" name="product_discount_status" class="form-control my-3">
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="form-control my-3">
            <input type="submit" class="btn" name="add_product" value="Add Product">
        </form>
    </div>
            </div>

            <div class="col-12">
                
    <div class="product-display">
        <table class="product-display-table table table-striped table-hover">
            <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><img src="images/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['product_description']; ?></td>
                <td>R<?php echo $row['product_price']; ?></td>
                <td>
                    <a href="admin_product_update.php?edit=<?php echo $row['product_barcode']; ?>" class="btn"> <i class="ri-file-edit-line"></i> Edit </a>
                    <a href="admin_products.php?delete=<?php echo $row['product_barcode']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this product?');"> <i class="ri-delete-bin-line"></i> Delete </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
            </div>

        </div>
    </div>

    
<!-- Footer -->
<footer class="footer py-2 mt-auto">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->
    
</body>
</html>