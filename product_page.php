<?php
  session_start();
$count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session
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

<!-- Product display -->
<section class="product-display mt-5">
<?php
  $product_barcode_encoded = isset($_GET['id']) ? $_GET['id'] : '';
  $product_barcode = urldecode($product_barcode_encoded);


  $requested_pid;
  require 'connection.php';

  $collect_from_db = mysqli_query($conn, "SELECT * FROM `products_tb` WHERE product_barcode = $product_barcode ") or die ('Query Failed');

  if (mysqli_num_rows($collect_from_db) > 0) {
    while($row = mysqli_fetch_assoc($collect_from_db)){
      // var_dump($row);
            // Store necessary data in variables
            $product_name = $row['product_name'];
            $product_image = $row['product_image'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_case = $row['product_case'];
            $product_movement = $row['product_movement'];
            $product_brand = $row['product_brand'];
            $product_dial = $row['product_dial'];
            $product_strap = $row['product_strap'];
            $product_style_code = $row['product_style_code'];

      echo "
          <div class='container'>
    <div class='row'>
        <div class='col-lg-6'><img src='images/{$row['product_image']}' class='img-fluid product-img' alt='...'></div>
        <div class='col-lg-6 '>
        <h2 class='text-center '>{$row['product_name']}</h2>
        <p class='lead'>{$row['product_description']}</p>
        <p class='lead text-center'>R {$row['product_price']}</p>
        <div class='product-btn'><button class='nostyle-btn product-add-to-cart-btn p-2 '>Add To Cart</button></div>
        
        </div>
    </div>
    </div>
      ";
    }
  }
  ?>  
</section>

<!-- Product display Section-->

<!-- Additional Information Section -->
  <section class="additional-information mt-5 text-center mb-3">
    <h3>Additional Information</h3>


    <?php

    echo"

    
    <table class='table w-50 text-center mx-auto mt-5 mb-5 product-additional-info-tbl'>
  <thead>
    
  </thead>
  <tbody>
    <tr>
      <th scope='row'>Case</th>
      <td>$product_case</td>
    </tr>
    <tr>
      <th scope='row'>Movement </th>
      <td>$product_movement</td>
    </tr>
    
    <tr>
      <th scope='row'>Dial</th>
      <td>$product_dial</td>
    </tr>
    <tr>
      <th scope='row'>Strap</th>
      <td>$product_strap</td>
    </tr>
    
    <tr>
      <th scope='row'>Style Code</th>
      <td>$product_style_code</td>
    </tr>
  </tbody>
</table>


    
    "  
    ?>
  </section>
<!-- Additional Information Section -->




<!-- Related Information Section -->

<section class="related-information mt-5 mb-1 py-3">
    <div class="container-fluid">
        <h3 class="text-center on-black-bg">Related Items</h3>
        <div class="container-fluid pb-3">
            <div class="row">
                <?php
                    $collect_from_db = mysqli_query($conn, "SELECT * FROM `products_tb` WHERE product_brand = '$product_brand' LIMIT 4 ") or die ('Query Failed');

                    if (mysqli_num_rows($collect_from_db) > 0) {
                      while($row = mysqli_fetch_assoc($collect_from_db)){
                        // var_dump($row);
                        echo "
                        <div class='col-lg-3 col-md-6 col-sm-6 mt-5'>
                        <div class='card p-5 related-items-cards' >
                        <form>
                        <input type='hidden' name='id' value='{$row['product_barcode']}'>
                        <a target='_blank' href='{$row['product_link']}?id=" . urlencode($row['product_barcode']) . "'>
                            <img class='card-img-top new-arrival-pic' src='images/{$row['product_image']}'>
                        </a>
                        <div class='card-body'>
                          <h6 class='card-title on-black-bg text-ellipsis' >{$row['product_name']}</h6>
                          <p class='card-text on-black-bg'>R {$row['product_price']}</p>
                  
                        </div>
                        <button class='nostyle-btn on-black-bg ms-2'><i class='ri-shopping-cart-line on-black-bg ms-2'></i>Add To Cart</button>
                        </form>
                    
                    
                  </div>
                      </div>
                        ";
                      }
                    }
                  
                  
                    
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Related Information Section -->


  


<!-- Footer -->
    <footer class="footer py-2">
      
  
      <a href="#" class="navbar-brand mx-auto company-logo on-black-bg">Infinite</a>
    <br>
    <p class="text-center on-black-bg mt-4 mb-0">Created By Loyiso Ndlovu</p>
      
      
    </footer>
<!-- Footer -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const textElement = document.getElementById('text');
      const readMoreLink = document.getElementById('read-more');
      const fullText = `<?php echo addslashes($product_description); ?>`; // Insert PHP variable here

      const maxChar = 200; // Set a character limit (e.g., 200 characters)

      if (fullText.length > maxChar) {
        const truncatedText = fullText.substring(0, maxChar) + '...';
        textElement.innerHTML = truncatedText;

        readMoreLink.style.display = 'inline';
        readMoreLink.addEventListener('click', function(e) {
          e.preventDefault();
          if (textElement.classList.contains('expanded')) {
            textElement.innerHTML = truncatedText;
            textElement.classList.remove('expanded');
            readMoreLink.textContent = 'Read More';
          } else {
            textElement.innerHTML = fullText;
            textElement.classList.add('expanded');
            readMoreLink.textContent = 'Read Less';
          }
        });
      } else {
        textElement.innerHTML = fullText;
        readMoreLink.style.display = 'none';
      }
    });
  </script>



</body>
</html>