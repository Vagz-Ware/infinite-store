<?php

@include 'connection.php';

if (!$conn) {
    die('Connection Failed: ' . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Fetch the product image to delete it from the directory
    $fetch_image_query = "SELECT product_image FROM tbl_products WHERE product_id='$id'";
    $fetch_image_result = mysqli_query($conn, $fetch_image_query);
    
    if ($fetch_image_result && mysqli_num_rows($fetch_image_result) > 0) {
        $product = mysqli_fetch_assoc($fetch_image_result);
        $product_image_path = 'uploaded_img/' . $product['product_image'];
        
        // Delete the product record from the database
        $delete_query = "DELETE FROM tbl_products WHERE product_id='$id'";
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
    $product_image_folder = 'uploaded_img/' . $product_image;

    if (empty($product_name) || empty($product_description) || empty($product_price) || empty($product_image)) {
        echo '<span class="message">Please fill out all fields!</span>';
    } else {
        $insert = "INSERT INTO tbl_products (product_name, product_description, product_price, product_image) VALUES ('$product_name', '$product_description', '$product_price', '$product_image')";
        $upload = mysqli_query($conn, $insert);

        if ($upload) {
            if (move_uploaded_file($product_image_tmp_name, $product_image_folder)) {
                echo '<span class="message">New product added successfully</span>';
            } else {
                echo '<span class="message">Failed to upload image</span>';
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root{
   --green:#27ae60;
   --black:#333;
   --white:#fff;
   --bg-color:#eee;
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   --border:.1rem solid var(--black);
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   text-transform: capitalize;
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

.btn{
   display: block;
   width: 100%;
   cursor: pointer;
   border-radius: .5rem;
   margin-top: 1rem;
   font-size: 1.7rem;
   padding:1rem 3rem;
   background: var(--green);
   color:var(--white);
   text-align: center;
}

.btn:hover{
   background: var(--black);
}

.message{
   display: block;
   background: var(--bg-color);
   padding:1.5rem 1rem;
   font-size: 2rem;
   color:var(--black);
   margin-bottom: 2rem;
   text-align: center;
}

.container{
   max-width: 1200px;
   padding:2rem;
   margin:0 auto;
}

.admin-product-form-container.centered{
   display: flex;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
   
}

.admin-product-form-container form{
   max-width: 50rem;
   margin:0 auto;
   padding:2rem;
   border-radius: .5rem;
   background: var(--bg-color);
}

.admin-product-form-container form h3{
   text-transform: uppercase;
   color:var(--black);
   margin-bottom: 1rem;
   text-align: center;
   font-size: 2.5rem;
}

.admin-product-form-container form .box{
   width: 100%;
   border-radius: .5rem;
   padding:1.2rem 1.5rem;
   font-size: 1.7rem;
   margin:1rem 0;
   background: var(--white);
   text-transform: none;
}

.product-display{
   margin:2rem 0;
}

.product-display .product-display-table{
   width: 100%;
   text-align: center;
}

.product-display .product-display-table thead{
   background: var(--bg-color);
}

.product-display .product-display-table th{
   padding:1rem;
   font-size: 2rem;
}


.product-display .product-display-table td{
   padding:1rem;
   font-size: 2rem;
   border-bottom: var(--border);
}

.product-display .product-display-table .btn:first-child{
   margin-top: 0;
}

.product-display .product-display-table .btn:last-child{
   background: crimson;
}

.product-display .product-display-table .btn:last-child:hover{
   background: var(--black);
}





@media (max-width:991px){

   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   .product-display{
      overflow-y:scroll;
   }

   .product-display .product-display-table{
      width: 80rem;
   }

}

@media (max-width:450px){

   html{
      font-size: 50%;
   }

}
</style>
<body>

<div class="container">
    <div class="admin-product-form-container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Add a New Product</h3>
            <input type="text" placeholder="Enter product name" name="product_name" class="box">
            <input type="text" placeholder="Enter product description" name="product_description" class="box">
            <input type="number" placeholder="Enter product price" name="product_price" class="box">
            <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
            <input type="submit" class="btn" name="add_product" value="Add Product">
        </form>
    </div>

    <?php
    $select_query = "SELECT * FROM tbl_products";
    $select = mysqli_query($conn, $select_query);

    if (!$select) {
        die('Query Failed: ' . mysqli_error($conn));
    }
    ?>

    <div class="product-display">
        <table class="product-display-table">
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
                <td><img src="uploaded_img/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['product_description']; ?></td>
                <td>R<?php echo $row['product_price']; ?></td>
                <td>
                    <a href="admin_update.php?edit=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
                    <a href="admin_page.php?delete=<?php echo $row['product_id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this product?');"> <i class="fas fa-trash"></i> Delete </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
