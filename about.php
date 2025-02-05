<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/about-img.png" alt="" style="border-radius:10px;">
         </div>

         <div class="content">
            <h2 class="section__header"><span class="left-line">WHO WE ARE</span></h2>
            <h2>About Us</h2>
            <p>
               LeadCo is where passion meets purpose in the world of agriculture. We are a dedicated team committed to
               driving innovation, sustainability, and transformative growth in the agricultural sector. By addressing
               the unique challenges of modern agriculture, we empower farmers, businesses, and communities to thrive in
               an ever-evolving landscape. With a steadfast focus on excellence, we aim to create a sustainable and
               prosperous future for all.</p>
            <p>
               At LeadCo, our vision is to be a global leader in revolutionizing agriculture through innovative and
               sustainable solutions. Our mission is to empower stakeholders by delivering tailored, comprehensive
               strategies that enhance productivity, promote environmental stewardship, and foster resilience. Together,
               we strive to build an agricultural ecosystem where progress, sustainability, and growth go hand in hand.
         </div>

      </div>

   </section>

   <section class="counter">
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

   <section class="reviews">

      <h1 class="heading">Client's Reviews.</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="images/pic-5.jpg" alt="">
               <p>LeadCo is a game-changer in the agricultural sector. Their innovative solutions and commitment to
                  sustainability have truly made a positive impact on our farming practices. The team is knowledgeable,
                  professional, and always goes the extra mile to support their clients. Highly recommended!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3> Sarah M.</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-1.jpg" alt="">
               <p>I've been working with LeadCo for over a year, and the experience has been exceptional. Their tailored
                  strategies have helped us overcome several challenges and improve our productivity. It's refreshing to
                  see a company so dedicated to empowering farmers and promoting eco-friendly practices.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>David L.</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-3.jpg" alt="">
               <p>LeadCo's approach to modern agriculture is inspiring. They combine cutting-edge technology with a deep
                  understanding of the industry, offering solutions that are both practical and sustainable. Their
                  dedication to fostering growth and collaboration truly sets them apart. </p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Emily W.</h3>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-7.jpg" alt="">
               <p>From the very first interaction, it was clear that LeadCo values its clients and the environment.
                  Their team is approachable and provides excellent guidance. Thanks to their innovative strategies,
                  we've seen remarkable growth in our business while adopting more sustainable practices. Highly
                  trustworthy and reliable! </p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Michael H.</h3>
            </div>

         </div>

         <div class="swiper-pagination"></div>

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

      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });

   </script>

</body>

</html>