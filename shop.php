<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

include 'components/wishlist_cart.php';

$select_categories = $conn->prepare("SELECT * FROM `categories`");
$select_categories->execute();

$select_subcategories = $conn->prepare("SELECT * FROM `subcategories`");
$select_subcategories->execute();

$filter_query = "SELECT * FROM `products`"; // Default query
$filter_params = [];

if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
   $filter_query = "SELECT * FROM `products` WHERE main_category_id = :category_id";
   $filter_params[':category_id'] = $_GET['category_id'];
} elseif (isset($_GET['subcategory_id']) && !empty($_GET['subcategory_id'])) {
   $filter_query = "SELECT * FROM `products` WHERE sub_category_id = :subcategory_id";
   $filter_params[':subcategory_id'] = $_GET['subcategory_id'];
}

$select_products = $conn->prepare($filter_query);

foreach ($filter_params as $param => $value) {
   $select_products->bindParam($param, $value, PDO::PARAM_INT);
}

$select_products->execute();


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="products">

      <div class="sidebar">
         <h2 class="sidebar-heading">Product Categories</h2>
         <ul class="category-list">
            <li>
               <a href="shop.php">All</a>
            </li>
            <?php while ($category = $select_categories->fetch(PDO::FETCH_ASSOC)) { ?>

               <li>
                  <a href="shop.php?category_id=<?= $category['id']; ?>">
                     <?= $category['name']; ?>
                  </a>

               </li>
            <?php } ?>
         </ul>
      </div>

      <div class="products-content">
         <div class="box-container">

            <?php
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <form action="" method="post" class="box">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name"><?= $fetch_product['name']; ?></div>
                     <div class="flex">
                        <div class="price"><span>LKR </span><?= $fetch_product['price']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99"
                           onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                  </form>
                  <?php
               }
            } else {
               echo '<p class="empty">No products found!</p>';
            }
            ?>

         </div>
      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>