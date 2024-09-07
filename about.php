<?php
session_start();

$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session
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
    
    <!-- About Section -->

<section  class="aboutSection mt-5 pb-5 mb-5"  >

  <div class="container">
      
  <h1 style="text-align: center;" class="main-heading" >About Us</h1>

<!-- On the founder and company -->

<div class="row mt-5" >

  <!-- On The Company's Values -->
  
  <h3 style="text-align: center;" class="mb-5 sub-heading">Meet Teboho Mngomezulu, The CEO </h3>

  <div class="col-5 service-img-column">
    <img src="Images\The ‘Well-Spoken’ Black Person Stereotype Still Thrives In 2018.jpg" class="rounded float-start service-img" alt="..." data-aos="flip-right" data-aos-delay="100">
  </div>
  <div class="info-on-services col-7">
    <p data-aos="flip-left" data-aos-delay="300">Founded in 2007 by Teboho Mngomezulu, Infinite emerged with a visionary purpose: to uplift and empower black communities. Khosa's foresight led to the establishment of a company dedicated to providing financial services that specifically addressed the needs and challenges faced by black individuals and communities. Over the years, Credible Management has grown into a symbol of inclusive financial empowerment, offering a range of services tailored to promote economic well-being within black populations. Teboho Mngomezulu's commitment to social impact has shaped Credible Management into a beacon of financial support, striving to create positive change and opportunities for advancement within historically marginalized communities.</p>
  </div>
</div>

<h3 class="mt-5 sub-heading" style="text-align: center;">What Are Our Values, Mission and Vision?</h3>

<div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
 
  <div class="col">
    <div class="card" data-aos="flip-right">
      <img src="Images\shared-vision.png" class="card-img-top mini-icons" alt="...">
      <div class="card-body">
        <h5 class="card-title icon-text sub-heading text-center">Vision</h5>
        <p class="card-text ">Infinite envisions being a leading force in inclusive financial empowerment. Through innovation and ethical practices, we aim to redefine the financial industry.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" data-aos="flip-right" data-aos-delay="300">
      <img src="Images\value.png" class="card-img-top mini-icons " alt="...">
      <div class="card-body">
        <h5 class="card-title icon-text sub-heading text-center">Values</h5>
        <p class="card-text">At Infinite, our core value is "Inclusivity with Integrity." We are committed to providing inclusive financial solutions that empower individuals and communities.</p>
      </div>
    </div>
  </div>
  <div class="col">

    <div class="card" data-aos="flip-right" data-aos-delay="600">
      <img src="Images\mission.png" class="card-img-top mini-icons" alt="...">
      <div class="card-body">
        <h5 class="card-title icon-text sub-heading text-center">Mission</h5>
        <p class="card-text">Infinite is on a mission to empower lives through financial excellence. Our goal is to provide accessible and innovative financial solutions that cater to diverse needs.</p>
      </div>
    </div>
  </div>
</div>
  </div>

</section>

<!-- //About Section -->


<!-- Footer -->
<footer class="footer py-2">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->
</body>
</html>