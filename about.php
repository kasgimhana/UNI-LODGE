<!DOCTYPE html>
<html>
<head>
	<title>Uni-Lodge- About Us</title>
	<!-- CSS only -->
<?php include 'includes/links.php'; ?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<link rel="stylesheet" type="text/css" href="includes/style.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<style>
  .box{
    border-top-color: var(--teal) !important;
  }
</style>

</head>
<body>

<?php require('includes/header.php'); ?>

<div class="my-5 px-4">
  <h2 class="fw-bold h-font text-center">WHO WE ARE</h2>

  <div class="h-line bg-dark"></div>
  <p class="text-center mt-3">
  
UNI-LODGE  Is Your Go-To Resource For  find accommodation for NSBM students Which Is A Product Of A Group Of Undergraduate Students In NSBM Green University Under The Software Development and Tools Module.
Our Website Features A Wide Range Of Information On The accommodation near the university,  facilities, locations Etc. Whether You're Looking To best accomadations  has You Covered.
  </p>
</div>

<div class="container">
  <div class="row justify-content-between align-items-center">
    <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
      <h3 class="mb-3">WHAT IS NSBM</h3>
      <p>
       
NSBM Green University, The Nation’s Premier Degree-Awarding Institute, Is The First Of Its Kind In South Asia. It Is A Government-Owned Self-Financed Institute That Operates Under The Purview Of The Ministry Of Education. As A Leading Educational Centre In The Country, NSBM Has Evolved Into Becoming A Highly Responsible Higher Education Institute That Offers Unique Opportunities And Holistic Education On Par With International Standards While Promoting 

Inspired By The Vision Of Being Sri Lanka’s Best-Performing Graduate School And Being Recognised Internationally, NSBM Currently Achieves Approximately 3000 New Enrollments Per Year And Houses Above 11,000 Students Reading Over 50 Degree Programmes Under 4 Faculties. Moreover, Over The Years, NSBM Green University Has Gifted The Nation With 14,000+ Graduates And Has Proved Its Global Presence With An Alumni Network Spread All Across The World.
Nestling On A 40-Acre Land Amidst The Greenery And Serenity In Pitipana, Homagama, NSBM Green University, Is An Ultra-Modern University Complex Constructed With State-Of-The-Art Facilities And Amenities That Provides The Perfect Setting For High-Quality Teaching, Learning And Research.
      </p>
    </div>
    <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
      <img src="images/about/Q.png" class="w-100">
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/hotel.svg" width="70px">
        <h4 class="mt-3">100+ ANNEX</h4>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/customers.svg" width="70px">
        <h4 class="mt-3">200+ CUSTOMERS</h4>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/rating.svg" width="70px">
        <h4 class="mt-3">150+ REVIEWS</h4>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
        <img src="images/about/staff.svg" width="70px">
        <h4 class="mt-3">5 DEVELOPERS</h4>
      </div>
    </div>
  
  </div>
</div>

<h3 class="my-5 fw-bold h-font text-center">DEVELOPMENT TEAM</h3>

<div class="container px-4">
   <div class="swiper mySwiper">
      <div class="swiper-wrapper mb-5">
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="images/about/TT.jpg" class="w-50"  style="min-height: 250px;max-height: 250px">
          <h5 class="mt-2">THEEKSHANA</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="images/about/I.jpg" class="w-50" style="min-height: 250px;max-height: 250px">
          <h5 class="mt-2">ISHADI</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="images/about/AA.jpg" class="w-50" style="min-height: 250px;max-height: 250px">
          <h5 class="mt-2">ACHINTHA</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="images/about/SS.jpg" class="w-50" style="min-height: 250px;max-height: 250px">
          <h5 class="mt-2">SHALINDA</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="images/about/K.jpg" class="w-50" style="min-height: 250px;max-height: 250px">
          <h5 class="mt-2">KAVINDI</h5>
        </div>
        
        
      </div>
      <div class="swiper-pagination"></div>
    </div>
</div>

<?php require('includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

 <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        spaceBetween: 40,
        pagination: {
          el: ".swiper-pagination",
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 3,
          },
          1024: {
            slidesPerView: 3,
          },
        }
      });
    </script>
</body>
</html>