<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Choco Choko</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="header-bg">
      <section class="header-content">
         <div class="text-content">
            <h1>We Take Care of Your Garden & Tree</h1>
            <p>GardenTree has blossomed into a leading company dedicated to providing innovative solutions for
               gardening.</p>
            <div class="buttons">
               <a href="about.php" class="btn-secondary">Who We Are</a>

               <a href="shop.php " class="btn-secondary">Shop</a>

            </div>
         </div>
      </section>
   </div>


   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/about-img.png" alt="" style="border-radius:10px;">
         </div>

         <div class="content">
            <h2 class="section__header"><span class="left-line">WHO WE ARE</span></h2>
            <h2>About Us</h2>
            <p>Welcome to LeadCo, where passion meets purpose in the heart of agriculture. We are a dedicated team of
               professionals committed to fostering innovation, sustainability, and growth within the agricultural
               sector. LeadCo is dedicated to providing comprehensive solutions that address the unique challenges of
               modern agriculture.</p>

            <div class="feature__grid">
               <div class="feature__card">
                  <div class="feature__icon">
                     <i class="fa-solid fa-seedling"></i>
                  </div>
                  <div class="feature__content">
                     <h4>Sustainability</h4>
                  </div>
               </div>
               <div class="feature__card">
                  <div class="feature__icon">
                     <i class="fa-solid fa-tractor"></i>
                  </div>
                  <div class="feature__content">
                     <h4>Innovation</h4>
                  </div>
               </div>
               <div class="feature__card">
                  <div class="feature__icon">
                     <i class="fa-solid fa-handshake"></i>
                  </div>
                  <div class="feature__content">
                     <h4>Community Empowerment</h4>
                  </div>
               </div>
            </div>
            <a href="about.php" class="btn">Read More</a>
         </div>

      </div>

   </section>

   <section class="service">
      <img src="images\img-2.png " class="img-1" alt="">
      <h2 class="section__header"><span class="left-line">OUR SERVICES</span></h2>
      <h2>Exlpore Our Best Offer <br>For Agriculture</h2>
      <div class="service__grid">
         <div class="service__card">
            <img src="images\service-1.jpg " alt="class" />
            <div class="class__content">
               <div class="popular__img--icon">
                  <i class="fa-solid fa-leaf"></i>
               </div>
               <h4>Precision Good Farming Services</h4>
               <p>Utilizing advanced technologies such as GPS, sensors, and data analytics to optimize farming
                  practices. This includes precision planting, variable rate fertilization, and automated monitoring for
                  increased efficiency and yield.</p>
               <button class="getbtn">Get Started</button>
            </div>
         </div>
         <div class="service__card">
            <img src="images\service-2.jpg " alt="class" />
            <div class="class__content">
               <div class="popular__img--icon">
                  <i class="fa-solid fa-sun-plant-wilt"></i>
               </div>
               <h4>Crop Consulting and Management</h4>
               <p>Providing expert advice on crop selection, cultivation practices, and pest management. Crop
                  consultants can offer personalized strategies to maximize productivity and address specific challenges
                  faced by farmers</p>
               <button class="getbtn">Get Started</button>
            </div>
         </div>
         <div class="service__card">
            <img src="images\service-3.jpg " alt="class" />
            <div class="class__content">
               <div class="popular__img--icon">
                  <i class="fa-solid fa-tractor"></i>
               </div>
               <h4>Agricultural Technology Integration</h4>
               <p>Assisting farmers in adopting and integrating modern agricultural technologies. This may include the
                  installation and maintenance of smart irrigation systems, drone-based crop monitoring, and farm
                  management software.</p>
               <button class="getbtn">Get Started</button>
            </div>
         </div>
      </div>
   </section>

   <section class="counter">
      <img src="images\img-1.png " class="img-2" alt="">
      <div class="counter__grid">
         <div class="counter__item">
            <span class="counter">250</span>
            <p>Happy Farmers</p>
         </div>

         <div class="counter__item">
            <span class="counter">150</span>
            <p>Successful Harvests</p>
         </div>

         <div class="counter__item">
            <span class="counter">50</span>
            <p>Awards Won</p>
         </div>

         <div class="counter__item">
            <span class="counter">50</span>
            <p>Awards Won</p>
         </div>
      </div>
   </section>

   <section class="home-products">
      <h2 class="section__header"><span class="left-line">OUR PRODUCTS</span></h2>

      <div class="swiper products-slider">

         <div class="swiper-wrapper">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <form action="" method="post" class="swiper-slide slide">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name"><?= $fetch_product['name']; ?></div>
                     <div class="flex">
                        <div class="price"><span>LKR.</span><?= $fetch_product['price']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99"
                           onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                  </form>
                  <?php
               }
            } else {
               echo '<p class="empty">no products added yet!</p>';
            }
            ?>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="about">

      <div class="row">

         <div class="content">
            <h2 class="section__header"><span class="left-line">WHY CHOOSE US</span></h2>
            <p class="section__description">
               Highlight the extensive knowledge and experience of your team in the agriculture industry. Showcase how
               your
               team's expertise contributes to successful and sustainable farming practices.
            </p>
            <p class="section__description">
               Emphasize how your company is at the forefront of adopting and implementing innovative agricultural
               technologies. Showcase specific technologies or practices that set your services apart.
            </p>

            <div class="feature__grid">
               <div class="feature__card">
                  <div class="feature__icon">
                     <i class="fa-solid fa-seedling"></i>
                  </div>
                  <div class="feature__content">
                     <h4>We Are Professional And Experts</h4>
                  </div>
               </div>
               <div class="feature__card">
                  <div class="feature__icon">
                     <i class="fa-solid fa-hand-holding-heart"></i>
                  </div>
                  <div class="feature__content">
                     <h4>We Love Takes Your Challenge</h4>
                  </div>
               </div>
               <div class="feature__card">
                  <div class="feature__icon">
                     <i class="fa-solid fa-thumbs-up"></i>
                  </div>
                  <div class="feature__content">
                     <h4>Innovative Solutions</h4>
                  </div>
               </div>
            </div>
            <a href="contact.php" class="btn">Choose Us</a>
         </div>

         <div class="image">
            <img src="images\about2-img.png" alt="about" />
         </div>

      </div>

   </section>

   <section class="section__container work__container" id="work">
      <img src="images\img-3.png " class="img-3" alt="">
      <h2 class="section__header"><span class="left-line">OUR WORK PROCESS</span></h2>
      <h2>How Does We Works</h2>
      <div class="work__grid">
         <div class="work__step">
            <img src="images\process-1.png " alt="Step 1" />
            <h3>Seed Selection & Planting</h3>
            <p>Choose the best seeds for optimal crop yield. Plant with care and precision</p>
         </div>

         <div class="work__step">
            <img src="images\process-2.png " alt="Step 2" />
            <h3>Crop Care & Management</h3>
            <p>Monitor weather conditions for irrigation needs. Implement sustainable practices for pest control</p>
         </div>

         <div class="work__step">
            <img src="images\process-3.png " alt="Step 3" />
            <h3>Harvesting & Distribution</h3>
            <p>Harvest crops efficiently with modern machinery. Distribute products to markets promptly for freshness
            </p>
         </div>
      </div>
   </section>

   <section class="section__container partners__container" id="partners">
      <h2 class="section__header"><span class="left-line">OUR PARTNERS</span></h2>
      <h2>We Are Globally Trusted</h2>
      <div class="partners__grid">
         <div class="partner__card">
            <img src="images\logo-1.png" alt="Partner 1" />
         </div>
         <div class="partner__card">
            <img src="images\logo-2.png" alt="Partner 2" />
         </div>
         <div class="partner__card">
            <img src="images\logo-3.png" alt="Partner 3" />
         </div>
         <div class="partner__card">
            <img src="images\logo-2.png" alt="Partner 2" />
         </div>
         <div class="partner__card">
            <img src="images\logo-1.png" alt="Partner 1" />
         </div>
         <div class="partner__card">
            <img src="images\logo-3.png" alt="Partner 3" />
         </div>
      </div>
   </section>


   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>

      var swiper = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
               slidesPerView: 3,
            },
            768: {
               slidesPerView: 4,
            },
            1024: {
               slidesPerView: 5,
            },
         },
      });

      var swiper = new Swiper(".products-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });

   </script>

</body>

</html>