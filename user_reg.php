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

<section class="register-section">

    <div class="container">
        <div class="row">
            <div class="col">
                
<div class="register-form mt-5 mb-5 mx-5 p-5">
        <center><div class="register-title">
            <h3>Register Form</h3>
            <div class="info-protected">
                <P>Your information is protected</P>
            </div>
        </div></center>
        
        <div class="register-form-container">
            <form action="sign_up.php" method="POST">
                <div class="form-group ">
                    <input type="text" class="form-control" id="email" name="first_name" aria-describedby="emailHelp" placeholder ="First Name" required >
                </div>
            <div class="form-group mt-3">
                    <input type="text" class="form-control" id="email" name="last_name" aria-describedby="emailHelp" placeholder ="Last Name" required>
                </div>
                <div class="form-group mt-3">
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder ="Email" required>
                </div>
                <div class="form-group mt-3">
                    <input type="text" class="form-control" id="email" name="address" aria-describedby="emailHelp" placeholder ="Home Address" required>
                </div>
                <div class="form-group mt-3">
                    <input type="number" class="form-control" id="email" name="number" aria-describedby="emailHelp" placeholder ="Mobile Phone Number" required minlength="10">
                </div>
                <div class="form-group mt-3">
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Password" required minlength="8">
                </div>
                <div class="form-group my-3">
                    <input type="password" class="form-control" id="password" name="confirm_password" aria-describedby="passwordHelp" placeholder="Confirm password" required minlength="8">
                </div>
                <button type="submit" class="px-4 infinite-btns" name="submit_registration_info">Register</button>
                
                <button type="button" class="px-4 infinite-btns" name="Submit_login_info" onclick="changeToLogin()">Login</button>
          
    </div>
    </div>
            </div>
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