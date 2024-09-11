<?php

@include 'connection.php';

require 'connection.php';
session_start();
$name = $_SESSION['admin_name'] ?? null;

if (!isset($name)){
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


// 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete_query = "DELETE FROM admins_tb WHERE admin_id='$id'";
    $delete = mysqli_query($conn, $delete_query);
    if ($delete) {
      // Delete the product image from the directory

      echo '<span class="message">Product deleted successfully!</span>';
      
  } else {
      echo '<span class="message">Could not delete the product from the database: ' . mysqli_error($conn) . '</span>';
  }
}

if (isset($_POST['add_admin'])) {
    $admin_fullname = mysqli_real_escape_string($conn, $_POST['admin_fullname']);
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $admin_address = mysqli_real_escape_string($conn, $_POST['admin_address']);
    $admin_mobile_number = mysqli_real_escape_string($conn, $_POST['admin_mobile_number']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);
   

    if (empty($admin_fullname) || empty($admin_email) || empty($admin_address) || empty($admin_mobile_number) || empty($admin_password)) {
        echo '<span class="message">Please fill out all fields!</span>';
    } else {
        $insert = "INSERT INTO admins_tb (admin_fullname, admin_email, admin_address, admin_mobile_number, admin_password ) VALUES ('$admin_fullname','$admin_email', '$admin_address', '$admin_mobile_number', '$admin_password')";
        $upload = mysqli_query($conn, $insert);

        if ($upload) {
         echo '<span class="message">New admin added successfully</span>';     
    }
    else {
      echo '<span class="message">Could not add the admin: ' . mysqli_error($conn) . '</span>';
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
    $select_query = "SELECT * FROM `admins_tb`";
    $select = mysqli_query($conn, $select_query);

    if (!$select) {
        die('Query Failed: ' . mysqli_error($conn));
    }
    ?>

    
<div class="container-fluid">

<h1 class="my-5 text-center">View All Admins</h1>

<div class="row">

    <div class="col-9">
        
<div class="product-display">
<table class="product-display-table table table-striped table-hover">
            <thead >
            <tr>
                <th>Admin Id</th>
                <th>Admin Fullname</th>
                <th>Admin Email</th>
                <th>Admin Address</th>
                <th>Admin Mobile Number</th>
                <!-- <th>admin Password</th> -->
                <th>Action</th>
            </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { 
               ;?>
            <tr>
                <!-- <td><img src="images/<?php echo $row['product_image']; ?>" height="100" alt=""></td> -->
                <td><?php echo $row['admin_id']; ?></td>
                <td><?php echo $row['admin_fullname']; ?></td>
                <td><?php echo $row['admin_email']; ?></td>
                <td><?php echo $row['admin_address']; ?></td>
                <td><?php echo $row['admin_mobile_number']; ?></td>
                
                <td>
                    <a href="admin_update_admins.php?edit=<?php echo $row['admin_id']; ?>" class="btn"> <i class="ri-file-edit-line"></i> Edit </a>
                    <a href="admin_view_admins.php?delete=<?php echo $row['admin_id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this product?');"> <i class="ri-delete-bin-line"></i> Delete </a>
                </td>
            </tr>
            <?php } ?>
        </table>
</div>
    </div>

    <div class="col-3">
    <div class="admin-product-form-container ">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Create a new Admin</h3>
            <input type="text" placeholder="Enter admin name" name="admin_fullname" class="box">
            <input type="email" placeholder="Enter admin email" name="admin_email" class="box">
            <input type="text" placeholder="Enter admin address" name="admin_address" class="box">
            <input type="text" placeholder="Enter admin mobile" name="admin_mobile_number" class="box">
            <input type="password" placeholder="Enter admin password" name="admin_password" class="box">
            <input type="submit" class="btn" name="add_admin" value="Add admin">
        </form>
    </div>
    </div>
</div>
</div>

</body>
</html>