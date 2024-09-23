<?php
session_start();

$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session
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
<body>

    <!-- Navbar -->
<nav class="navbar navbar-custom py-3 sticky-top">
  <div class="container-fluid top-nav py-1">
    <div class=" d-flex align-items-center">
      <button class="navbar-toggler remove-toggle-bg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"      aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
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

    <!--Slider section  -->

    <section class="hero-slide">
      <div class="container hero-slide-container">
        <div class="row hero-slide-row">
          <div class="col-12 hero-slide-col">
          <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner hero-slider w-100">
    <div class="carousel-item active">
      <img src="images\wallpaperflare.com_wallpaper.jpg" class="d-block w-100 slider-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images\rolex submarine bg.jpg" class="d-block w-100 slider-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images\lvbg-ezgif.com-webp-to-png-converter.png" class="d-block w-100 slider-img" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
          </div>
        </div>
      </div>
    </section>

    <!--Slider section  -->

    <!-- New Arrival Section -->
      <section class="arrival-section pb-3">
        <h1 class="text-center mt-5">New Arrival</h1>
      <div class="container-fluid text-center">
  <div class="row">
  <?php
  require 'connection.php';

  $collect_from_db = mysqli_query($conn, "SELECT * FROM `products_tb` WHERE product_arrival_status = 'new' ") or die ('Query Failed');

  if (mysqli_num_rows($collect_from_db) > 0) {
    while($row = mysqli_fetch_assoc($collect_from_db)){
      // var_dump($row);
      echo "
      <div class='col-lg-3 col-md-6 col-sm-6 mt-5'>
      <div class='card p-5 new-arrival-cards' >
      <form action='cart_functions.php' method='post'>
      <input type='hidden' name='id' value='{$row['product_barcode']}'>
      <a target='_blank' href='product_page.php?id=" . urlencode($row['product_barcode']) . "'>
          <img class='card-img-top new-arrival-pic' src='images/{$row['product_image']}'>
      </a>
      <div class='card-body'>
        <h6 class='card-title text-ellipsis'>{$row['product_name']}</h6>
        <p class='card-text text-center'>R {$row['product_price']}</p>

      </div>
      <button type='submit' name ='add_to_cart' class='nostyle-btn'><i class='ri-shopping-cart-line'></i>Add To Cart</button>
      <button type='submit' name ='add_to_wishlist' class='nostyle-btn mt-3 text-center ms-2'><i class='ri-heart-line'></i>Add To Wishlist</button>
      </form>
  
  
</div>
    </div>
      ";
    }
  }


  ?>
  </div>
</div>

  
      </section>
    <!-- New Arrival Section -->

  
    <!-- On Sale Section -->
    <section class="on-sale-section pb-5 pt-4">
      
        <h1 class="text-center on-black-bg">On Sale</h1>
      <div class="container-fluid text-center">
  <div class="row">
  <?php
require 'connection.php';
define('SECRET_KEY', 'your-secret-key');


// Function to calculate the discounted price
function calculateDiscountedPrice($originalPrice, $discountPercentage) {
    // Ensure the discount percentage is between 0 and 100
    if ($discountPercentage < 0 || $discountPercentage > 100) {
        throw new Exception("Discount percentage must be between 0 and 100.");
    }

    // Calculate the discount amount
    $discountAmount = ($originalPrice * $discountPercentage) / 100;

    // Calculate the final price after discount
    $discountedPrice = $originalPrice - $discountAmount;

        return number_format($discountedPrice, 2, '.', ',');

}

$collect_from_db = mysqli_query($conn, "SELECT * FROM `products_tb` WHERE product_discount = 'true'") or die('Query Failed');

if (mysqli_num_rows($collect_from_db) > 0) {
    while ($row = mysqli_fetch_assoc($collect_from_db)) {
        $originalPrice = $row['product_price'];
        $discountPercentage = $row['product_discount_percentage'];

        // Calculate the discounted price
        $discountedPrice = calculateDiscountedPrice($originalPrice, $discountPercentage);
        $token = md5($row['product_barcode'] . SECRET_KEY); // SECRET_KEY is a constant key you define


        // var_dump($_SESSION['cart']);
        
        echo "
        <div class='col-lg-3 col-md-6 col-sm-6 mt-5 on-sale-container'>
        <div class='discount-circle mt-1'>
        <h3 class='discount-percentage-amount'>{$row['product_discount_percentage']}%</h3>
        </div>
            <div class='card p-5 on-sale-cards'>
                <form action='cart_functions.php' method='post'>
                    <input type='hidden' name='id' value='{$row['product_barcode']}'>
                    <a target='_blank' href='product_page.php?id=" . urlencode($row['product_barcode']) . "'>
                        <img class='card-img-top new-arrival-pic w-100' src='images/{$row['product_image']}'>
                    </a>
                    <div class='card-body'>
                        <h6 class='card-title on-black-bg text-ellipsis'>{$row['product_name']}</h6>
                        <span class=''>
                         
                        <p class='card-text text-center on-black-bg text-decoration-line-through'>  R {$row['product_price']}</p></span>

                        <span class=''>
                         <p class='card-text text-center on-black-bg new-price'>R {$discountedPrice}</p></span>
                        
                        
                    </div>
                    <button type='submit' name ='add_to_cart' class='nostyle-btn on-black-bg'><i class='ri-shopping-cart-line on-black-bg'></i>Add To Cart</button>
                    <button type='submit' name ='add_to_wishlist' class='nostyle-btn on-black-bg mt-3 text-center ms-2'><i class='ri-heart-line'></i>Add To Wishlist</button>
                </form>
            </div>
        </div>
        ";
    }
}
?>

  </div>
</div>

  
      </section>
    <!-- On Sale Section -->

    

<!-- Brands Section -->
<section class="brands-section mt-5">
  <h1 class="text-center ">Brands</h1>
  <div class="container mt-5 mb-3">
    <div class="row">
      <div class="col-lg-4 col-sm-12 opacity-75 mb-3">
        <a href="rolex_brand.php">
      <div class="card text-bg-dark ">
      <img src="images\Rolex Daytona 126503 Gold_Steel Black 40mm 2024-min.png" class="img-fluid brand-img" alt="...">
  <div class="card-img-overlay">
    <h5 class="card-title text-center card-brand-title">Rolex </h5>
  </div>
</div>
</a>
</div>
        <div class="col-lg-4 col-sm-12 opacity-75 mb-3">
          <a href="AP_brand.php">
        <div class="card text-bg-dark">
        <img src="images\ap in case.jpg" class="img-fluid brand-img" alt="...">
  <div class="card-img-overlay ">
    <h5 class="card-title text-center card-brand-title">Audemar Piguets</h5>
  </div>
  </a>
</div>
      </div>
       <div class="col-lg-4 col-sm-12 opacity-75 mb-3">
        <a href="LV_brand.php">
       <div class="card text-bg-dark">
       <img src="images\Louis Vuitton® Tambour Street Diver, Automatic, 44MM, Steel Blue_ Size-min.png" class="img-fluid brand-img" alt="...">
  <div class="card-img-overlay">
    <h5 class="card-title text-center card-brand-title">Louis Vuitton</h5>
  </div>
</div>
</a>
      </div>
    </div>
  </div>
</section>
<!-- Brands Section -->

<!-- Footer -->
    <footer class="footer py-2">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->

</body>
</html>