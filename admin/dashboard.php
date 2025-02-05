<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="dashboard">

      <div class="box-container">

         <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if ($select_pendings->rowCount() > 0) {
               while ($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)) {
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
            ?>
            <i class="fas fa-hourglass-half"></i>
            <h3><span>LKR </span> <?= $total_pendings; ?><span>/-</span></h3>
            <p>Total pendings</p>
            <a href="placed_orders.php" class="btn">See Orders.</a>
         </div>

         <div class="box">
            <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if ($select_completes->rowCount() > 0) {
               while ($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)) {
                  $total_completes += $fetch_completes['total_price'];
               }
            }
            ?>
            <i class="fas fa-check-circle"></i>
            <h3><span>LKR </span> <?= $total_completes; ?><span>/-</span></h3>
            <p>Completed orders</p>
            <a href="placed_orders.php" class="btn">See orders</a>
         </div>

         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
               ?>
            <i class="fas fa-shopping-cart"></i>
            <h3><?= $number_of_orders; ?></h3>
            <p>Orders Placed.</p>
            <a href="placed_orders.php" class="btn">See orders.</a>
         </div>

         <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
               ?>
            <i class="fas fa-box-open"></i>
            <h3><?= $number_of_products; ?></h3>
            <p>Products added</p>
            <a href="products.php" class="btn">See products</a>
         </div>

         <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
               ?>
            <i class="fas fa-users"></i>
            <h3><?= $number_of_users; ?></h3>
            <p>Normal users</p>
            <a href="users_accounts.php" class="btn">See Users</a>
         </div>

         <div class="box">
            <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
               ?>
            <i class="fas fa-user-shield"></i>
            <h3><?= $number_of_admins; ?></h3>
            <p>Admin users</p>
            <a href="admin_accounts.php" class="btn">See admins</a>
         </div>

         <div class="box">
            <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
               ?>
            <i class="fas fa-envelope"></i>
            <h3><?= $number_of_messages; ?></h3>
            <p>New messages</p>
            <a href="messages.php" class="btn">See messages</a>
         </div>

      </div>

   </section>

   <script src="../js/admin_script.js"></script>

</body>

</html>