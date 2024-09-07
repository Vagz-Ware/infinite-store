<?php 
    require 'connection.php';
    session_start();

    $name = $_SESSION['user_name'] ?? null;

    
    $count = $_SESSION['cart_count'] ?? 0; // Retrieve the cart count from the session

    function js_redirect($url) {
      echo "<script type='text/javascript'>setTimeout(function(){ window.location.href = '$url'; });</script>";
  }

    if (!isset($name)){
      echo "You are not logged in";
      js_redirect('login_form.php');
      exit;
    }

    if (!isset($count)){
      js_redirect('user.php');
      echo "Your Cart is empty";
      //header("refresh:2; http://localhost/dashboard/online-store-level-1/index.php");
      exit; // Ensure script execution stops after redirection
    }


    
    $fetch_user_info = mysqli_query($conn, "SELECT * FROM `users_tb` WHERE `user_fullname` = '$name' ") or die('Query Failed');

    if (mysqli_num_rows($fetch_user_info) > 0){
     $row = mysqli_fetch_assoc($fetch_user_info);}
?>

<?php
    // session_start();
    // include 'connection.php'; // Ensure this file has your database connection details

    if (isset($_POST['add_to_cart'])){
        $pid = $_POST['id'];
        $quantity = 1;

        if (isset($_SESSION['cart'][$pid])){
            $_SESSION['cart'][$pid]['quantity'] += 1;
        }
        else {
            $sql = "SELECT * FROM `product_tb` WHERE `product_id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $pid);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $pro = $result->fetch_assoc()) {
                
                $_SESSION['cart'][$pid] = [
                    'name' => $pro['product_name'],
                    'description' => $pro['product_description'],
                    'price' => $pro['product_price'],
                    'quantity' => $quantity,
                    'image' => $pro['product_image'],
                ];
            }
        }
    }

    if (isset($_POST['btn_del'])){
        $id = $_POST['remove_id'];
        if(isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id]['quantity'] <= 1){
            unset($_SESSION['cart'][$id]);
        }
        elseif(isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id]['quantity'] > 1){
            $_SESSION['cart'][$id]['quantity']--;
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <script defer src="js/main.js"></script>
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    
        
    <style>
   li.dropdown {
  display: inline-block;
    }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: whitesmoke;
        width: 560px;
        height: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        color: black;
          top: 40px;
          border-radius: 1rem;
      }

      .drop-down-icon {
          color: black;
      }


      .dropdown-content2 {
        display: none;
        position: absolute;
        background-color: whitesmoke;
        width: 300px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        color: black;
          top: 40px;
          border-radius: 1rem;
      }

      .dropdown-content2 a{
          text-decoration: none;
      }

      .dropdown-content3{
          
        display: none;
        position: absolute;
        background-color: whitesmoke;
        width: 300px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        color: black;
          top: 40px;
          right: 3px;
          border-radius: 1rem;
      }

      .dropdown-content4{
          
          display: none;
          position: absolute;
          background-color: whitesmoke;
          width: 300px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          color: black;
            top: 40px;
            right: 3px;
            border-radius: 1rem;
        }

      .dropdown-content3 ul li {
          padding: 5px;
          list-style-type: none;
      }

      .under-lined{
          border-bottom: silver 1px  solid;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }

      /* .dropdown:hover .dropdown-content2 {
        display: block;
      } */

      .dropdown:hover .dropdown-content3 {
        display: block;
      }

      /* .dropdown:hover .dropdown-content4 {
        display: block;
      } */
            </style>

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
            <a class="nav-link ms-3 sidebar-link" aria-current="page" href="#">Logout</a>
          </li>
        </ul>
        
      </div>
    </div>
    <a href="index.php" class="navbar-brand mx-auto company-logo">Infinite</a>

    <div class="d-flex align-items-center ms-auto">
      <!-- Add your items here -->
      <a href="#" class="nav-icons me-5"><i class="ri-user-line"></i></a>
      <a href="#" class="nav-icons me-5"><i class="ri-heart-line"></i></a>
      <a href="#" class="nav-icons me-5"><i class="ri-shopping-cart-line"></i></a>
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

    <div class="main">

    
    <div class="container py-5">
        <h3 style="text-align:center;">Let's Finalise the payment</h3>
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <h5>Fill in the form to finalise the payment</h5>
                    <div class="tab-content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <form id="paymentForm" action="customer_slip.php" role="form" method="POST">
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="Cardholder Name" required class="form-control" readonly value="<?php echo $row['user_fullname'] ?>">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number" name="cardNumber" placeholder="Card number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="number" placeholder="MM" name="pay_month" class="form-control" required>
                                                <input type="number" placeholder="YY" name="pay_year" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4">
                                            <input type="text" required class="form-control" placeholder="CVV" name="card_CVV">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="subscribe btn btn-outline-danger btn-block rounded-pill shadow-sm" name="purchase_btn">Confirm</button>
                            </form>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="processingMessage" class="hidden-processor">
    <div class="loader">
            <span style="--i:1;"></span>
            <span style="--i:2;"></span>
            <span style="--i:3;"></span>
            <span style="--i:4;"></span>
            <span style="--i:5;"></span>
            <span style="--i:6;"></span>
            <span style="--i:7;"></span>
            <span style="--i:8;"></span>
            <span style="--i:9;"></span>
            <span style="--i:10;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:13;"></span>
            <span style="--i:14;"></span>
            <span style="--i:15;"></span>
            <span style="--i:16;"></span>
            <span style="--i:17;"></span>
            <span style="--i:18;"></span>
            <span style="--i:19;"></span>
            <span style="--i:20;"></span>
        </div>
            Processing your payment, please wait...
        </div>
    </div>
    
    <script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting immediately
        
        // Show the processing message
        document.getElementById('processingMessage').classList.remove('hidden-processor');
        
        // Simulate a delay (e.g., processing time)
        setTimeout(function() {
            // Submit the form
            event.target.submit();
        }, 5000); // 3-second delay for simulation
    });
</script>

    <footer class="footer">
        <div class="main-footer">
            <div class="sub-f-grid-1">
                <div class="sub-f-item-1">
                    <h3>Customer Service</h3>
                    <ul>
                        <li>Help Center</li>
                        <li>Transaction Services Agreement for non-EU/UK Consumers</li>
                        <li>Terms and Conditions for EU/EEA/UK Consumers (Transactions)</li>
                        <li>Take our feedback survey</li>
                    </ul>
                </div>
                <div class="sub-f-item-2">
                    <h3>Shopping with us</h3>
                    <ul>
                        <li>Making payments</li>
                        <li>Delivery options</li>
                        <li>Buyer Protection</li>
                    </ul>

                    <br>
                    <h3>Collaborate With Us</h3>
                    <ul>
                        <li>Partnerships</li>
                        <li>Affiliate program</li>
                        <li>DS Center</li>
                        <li>Seller Log In</li>
                        <li>中国卖家入驻</li>
                        <li>Non-Chinese Seller Registration</li>
                    </ul>


                </div>
                <div class="sub-f-item-3">
                    <h3>Pay With</h3>
                    <div class="payment-container">
                        <img src="images/payment/visa.png" alt="" class="payment-images">
                        <img src="images/payment/A express.png" alt="" class="payment-images">
                        <img src="images/payment/bancontact.png" alt="" class="payment-images">
                        <img src="images/payment/bilk.png" alt="" class="payment-images">
                        <img src="images/payment/g pay.png" alt="" class="payment-images">
                        <img src="images/payment/ideal.png" alt="" class="payment-images">
                        <img src="images/payment/klarna.png" alt="" class="payment-images">
                        <img src="images/payment/master-c.png" alt="" class="payment-images">
                        <img src="images/payment/paypal.png" alt="" class="payment-images">
                        <img src="images/payment/payu.png" alt="" class="payment-images">
                        <img src="images/payment/payxley-ezgif.com-webp-to-png-converter.png" alt="" class="payment-images">
                        <img src="images/payment/iPay-ezgif.com-webp-to-png-converter.png" alt="" class="payment-images">
                        <img src="images/payment/jcb-ezgif.com-webp-to-png-converter.png" alt="" class="payment-images">
                    </div>


                </div>
                <div class="sub-f-item-4">
                    <h3>Stay Connected</h3>
                    <div class="social-icons">
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-facebook-messenger"></i>
                    </div>
                    
                </div>
            </div>
            <div class="sub-f-grid-2">
                <div class="sub-f-item-21">
                    <h3>Help</h3>
                    <ul>
                        <li><a href="">Help Center</a>, <a href="">Disputes & Reports</a>, <a href="">Buyer Protection</a>, <a href="">Report IPR infringement</a>, <a href="">Regulated Information</a> , <a href="">Integrity Compliance</a></li>
                    </ul>
                </div>
                <div class="sub-f-item-22">
                    <h3>AliExpress Multi-Language Sites</h3>
                    <ul>
                        <li>
                            <a href="">Russian</a>,  <a href="">Portuguese</a>,  <a href="">Spanish</a>, <a href="">French</a> , <a href="">German</a>, <a href="">Italian</a>, <a href="">Dutch</a>, <a href="">Turkish</a>, <a href="">Japanese</a>, <a href="">Korean</a>, <a href="">Thai</a> , <a href="">Vietnamese</a> , <a href="">Arabic</a>, <a href="">Hebrew</a>, <a href="">Polish</a> 
                        </li>
                    </ul>

                </div>
                <div class="sub-f-item-21">
                    <h3>Browse By Category</h3>
                    <ul>
                        <li>
                            <a href="">All Popular</a>, <a href="">Product</a>, <a href="">Promotion</a>, <a href="">Low Price</a> , <a href="">Great Value</a> , <a href="">Reviews</a>, <a href="">Blog</a>, <a href="">Seller Portal</a>,
                         <a href="">BLACK FRIDAY</a>,  <a href="">AliExpress Assistant</a>
                        </li>
                    </ul>
                </div>
                <div class="sub-f-item-22">
                    <h3>Alibaba Group</h3>
                    <ul>
                        <li>
                        <a href="">Alibaba Group Website</a>, <a href="">AliExpress</a> , <a href="">Alimama</a>, <a href="">Alipay</a> , <a href="">Fliggy</a>, <a href="">Alibaba Cloud</a>, <a href="">Alibaba International</a> , <a href="">AliTelecom</a> , <a href="">DingTalk</a>, <a href="">Juhuasuan</a>, <a href="">Taobao Marketplace, Tmall</a> , <a href="">Taobao Global, AliOS</a>, <a href="">1688</a> 
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sub-footer">
                <p>Intellectual Property Protection - Privacy Policy - Sitemap - Terms of Use - Information for EU consumers - Imprint - Transaction Services Agreement for non-EU/UK Consumers - Terms and Conditions for EU/EEA/UK Consumers - User Information Legal Enquiry Guide ©️2010-2023 AliExpress.com. All rights reserved. 增值电信业务经营许可证 增值电信业务经营许可证 浙B2-20120091-8 浙公网安备 浙公网安备 33010802002248号</p>
            </div>
        </div>
        
    </footer>

    
</body>
</html>