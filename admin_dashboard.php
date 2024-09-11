<?php
session_start();

$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the 
require 'connection.php';
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
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="admin_view_admins.php">Admins

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

<section class="admin-dashboard">
  
<div class="container my-5">

<?php 
  $get_rows_from_users = mysqli_query($conn, "SELECT COUNT(*) AS total_rows FROM users_tb" );
  
  if ($get_rows_from_users){
    $user_row = mysqli_fetch_assoc($get_rows_from_users);
  }
  else{
    echo"Failed to get the number of users";}

  
    $get_rows_from_products_tb = mysqli_query($conn, "SELECT COUNT(*) AS total_rows FROM products_tb" );
  
    if ($get_rows_from_products_tb){
      $product_row = mysqli_fetch_assoc($get_rows_from_products_tb);
    }
    else{
      echo"Failed to get the number of products";}

    
    $get_rows_from_sales_tb = mysqli_query($conn, "SELECT COUNT(*) AS total_rows FROM sales_tb" );
  
    if ($get_rows_from_sales_tb){
      $sales_row = mysqli_fetch_assoc($get_rows_from_sales_tb);
    }
    else{
      echo"Failed to get the number of sales";}

    
      $get_rows_from_admins_tb = mysqli_query($conn, "SELECT COUNT(*) AS total_rows FROM admins_tb" );
  
      if ($get_rows_from_admins_tb){
        $admins_row = mysqli_fetch_assoc($get_rows_from_admins_tb);
      }
      else{
        echo"Failed to get the number of admins";}
      

?>

    <div class="row mb-5">
        <div class="col admin-dashboard-icon-container rounded mx-2">
            <div class="admin-dashboard-text-container"><p class="admin-info-text">
            <?php echo $user_row['total_rows'] ?>
            </p>
        <p class="admin-info-text-mini">
            Users
        </p></div>
            <div class="admin-dashboard-icon-container"><i class="ri-user-line admin-dashboard-icon"></i></div>
    </div>

    <div class="col admin-dashboard-icon-container rounded mx-2">
            <div class="admin-dashboard-text-container"><p class="admin-info-text">
                <?php echo $sales_row['total_rows'] ?>
            </p>
        <p class="admin-info-text-mini">
            Sales
        </p></div>
            <div class="admin-dashboard-icon-container"><i class="ri-shopping-cart-line admin-dashboard-icon"></i></div>
    </div>

    <div class="col admin-dashboard-icon-container rounded mx-2">
            <div class="admin-dashboard-text-container"><p class="admin-info-text">
            <?php echo $product_row['total_rows'] ?>
            </p>
        <p class="admin-info-text-mini">
            Products
        </p></div>
            <div class="admin-dashboard-icon-container"><i class="bi bi-smartwatch admin-dashboard-icon"></i></div>
    </div>

    <div class="col admin-dashboard-icon-container rounded mx-2">
            <div class="admin-dashboard-text-container"><p class="admin-info-text">
            <?php echo $admins_row['total_rows'] ?>
            </p>
        <p class="admin-info-text-mini">
            Admins
        </p></div>
            <div class="admin-dashboard-icon-container"><i class="ri-admin-line admin-dashboard-icon"></i></div>
    </div>
    
</div>
<div class="row">
<?php
    $select_query = "SELECT * FROM `sales_tb`";
    $select = mysqli_query($conn, $select_query);

    if (!$select) {
        die('Query Failed: ' . mysqli_error($conn));
    }
    ?>
<table class="product-display-table mt-5 p-2">
            <thead class="p-3">
            <tr class="p-3">
                <th class="p-3 text-center">User Fullname</th>
                <th class="text-center">Products Ordered</th>
                <th class="text-center">Price</th>
                <th class="text-center">Delovery Address</th>
                <th class="text-center">Order Number</th>
                <th class="text-center">Order Date</th>
            </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { 
               ;?>
            <tr class="border border-dark">
                
                <td class="p-3"><?php echo $row['user_fullname']; ?></td>
                <td class="p-3"><?php echo $row['products_ordered']; ?></td>
                <td class="p-3"><?php echo $row['price']; ?></td>
                <td class="p-3"><?php echo $row['delivery_address']; ?></td>
                <td class="p-3"><?php echo $row['order_number']; ?></td>
                <td class="p-3"><?php echo $row['order_date']; ?></td>
                
            </tr>
            <?php } ?>
        </table>
</div>
</div>
</section>  





    


<!-- Footer -->
    <footer class="footer py-2">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->

</body>
</html>