<!DOCTYPE html>
<html>
<head>
	<title>UNI-LODGE</title>
	<!-- CSS only -->
<?php include 'includes/links.php'; ?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<link rel="stylesheet" type="text/css" href="includes/style.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<style type="text/css">
	
	.availability-form{
		margin-top: -50px;
		z-index: 2;
		position: relative;
	}

	@media screen and (max-width: 575px) {
	.availability-form{
		margin-top: 25px;
		padding: 0 35px;
	}

	}
</style>
</head>
<body>

<?php require('includes/header.php'); ?>
<!-- Swiper Carousal-->
 <div class="container-fluid px-lg-4 mt-4">
 	 <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="images/bgImage/R.jpeg" class="w-100  d-block" style="min-height: 550px;max-height: 550px" />
        </div>
       
       
       
      </div>
      
    </div>
 </div>

 <!-- check avilability form-->
 <div class="container availability-form">
 	<div class="row">
 		<div class="col-lg-12 bg-white shadow p-4 rounded">
 			<h5 class="col-lg-3">Check Annex in here</h5>
 			<form>
 				<div class="row align-items-end">
 					<div class="col-lg-3 mb-3">
 						<label class="form-label" style="font-weight: 500;">Gender</label>
 						<select class="form-select shadow-none">
  					
  						<option value="1">Male</option>
  						<option value="2">female</option>
  						
						</select>
 					</div>
 					<div class="col-lg-3 mb-3">
 						<label class="form-label" style="font-weight: 500;">Price range</label>
 						<select class="form-select shadow-none">
  					
  						<option value="1">5000-10000</option>
  						<option value="2">10000-20000</option>
  						<option value="3">20000-30000</option>
  						<option value="4">30000 more</option>
						</select>
 					</div>
 					<div class="col-lg-3 mb-3">
 						<label class="form-label" style="font-weight: 500;">Location</label>
 						<select class="form-select shadow-none">
  					
  						<option value="1">Pitipana</option>
  						<option value="2">Homagama</option>
  						<option value="3">Kottawa</option>
						</select>
 					</div>
 					<div class="col-lg-2 mb-3">
 						<label class="form-label" style="font-weight: 500;">Type</label>
 						<select class="form-select shadow-none">
  						
  						<option value="1">Annex</option>
  						<option value="2">Room</option>
  						<option value="3">Boarding House</option>
						</select>
 					</div>
 					<div class="col-lg-1 mb-lg-3 mt-2">
 						<button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
 					</div>

 				</div>
 			</form>
 		</div>
 	</div>
 </div>
 
<!---our annex-->

<?php include('ajax/get_accommodations.php'); ?>

 <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Available Annex</h2>
 <div class="container">
 	<div class="row">

 		<div class="col-lg-4 col-md-6 my-3">
 			<div class="card border-0 shadow" style="max-width: 350px;min-width:350px ;min-height: 600px;max-height: 600px; margin: auto;">
			  <img src="images/rooms/2.jpg" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">Annex in Homagama</h5>
			    <h6 class="mb-4">45000 per night </h6>
			    <div class="features mb-4">
			    	<h6 class="mb-1">Features</h6>
			    	<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		4 Rooms
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		2 Bathroom
    				</span>
    				
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		4 beds
    				</span>
			    </div>
			    <div class="Facilities mb-4">
			    	<h6 class="mb-1">Facilities</h6>
			    	<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		Car parking
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		AC bedroom
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		Kitchen
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		Roll door
    				</span>
    			</div>

    			
    				<div class="d-flex justify-content-evenly mb-2">
    					
    					<a href=accomodations.php class="btn btn-sm btn-outline-dark shadow-none mt-1">More details</a>

    				</div>
			  </div>
			</div>
 		</div>

 		<div class="col-lg-4 col-md-6 my-3">
 			<div class="card border-0 shadow" style="max-width: 350px;min-width: 350px;min-height: 600px;max-height: 600px; margin: auto;">
			  <img src="images/rooms/p.jpg" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">Room in pitipana</h5>
			    <h6 class="mb-4">25000 per night </h6>
			    <div class="features mb-4">
			    	<h6 class="mb-1">Features</h6>
			    	<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		1 Rooms only
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		1 Bathroom
    				</span>
    				
			    </div>
			    <div class="Facilities mb-4">
			    	<h6 class="mb-1">Facilities</h6>
			    	<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		Wifi
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		KingSize bed
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		AC
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    	Attached bathroom
    				</span>
    				
    				<div class="guests mb-4">
			    	
			    	
    				
    				</div>	
    				
    				<div class="d-flex justify-content-evenly mb-2">
    					
    					<a href=accomodations.php class="btn btn-sm btn-outline-dark shadow-none mt-1">More details</a>
    				</div>
			    </div>
			  </div>
			</div>
 		</div>

 		<div class="col-lg-4 col-md-6 my-3">
 			<div class="card border-0 shadow" style="max-width: 350px;min-width: 350px;min-height: 600px;max-height: 600px; margin: auto;">
			  <img src="images/rooms/s.jpg" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title">Rooms for girls only</h5>
			    <h6 class="mb-4">30000 per month </h6>
			    <div class="features mb-4">
			    	<h6 class="mb-1">Features</h6>
			    	<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		10 Rooms
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		10 Bathroom
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		1 Balcony
    				</span>
    			
			    </div>
			    <div class="Facilities mb-4">
			    	<h6 class="mb-1">Facilities</h6>
			    	<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		Wifi
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		Attached Bathroom
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    		AC
    				</span>
    				<span class="badge rounded-pill bg-light text-dark text-wrap">
			    	Pool
    				</span>

    				<div class="d-flex justify-content-evenly mb-2">

    					<a href="accomodations.php" class="btn btn-sm btn-outline-dark shadow-none; mt-5">More details</a>
    				</div>
			    </div>
			  </div>
			</div>
 		</div>


 		<div class="col-lg-12 text-center mt-5">
 			<a href="accomodations.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Accomadations</a>
 		</div>
 	</div>	
 </div>

 

 

<!-- User comments -->

 <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">COMMENTS</h2>

 <div class="container mt-5">
 	<!-- Swiper -->
    <div class="swiper swiper-testimonials">
      <div class="swiper-wrapper mb-5">

        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
          	<img src="images/facilities/stars.png" width="30px">
          	<h6 class="m-0 ms-2">Random user2</h6>
          </div>
          <p>
          	"Easy to navigate and find exactly what I was looking for. The filter options made it simple to narrow down my search, and the detailed listings provided all the information I needed. Definitely my go-to site for finding a rental property!".
          </p>
          <div class="rating">
          	<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>

        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
          	<img src="images/facilities/stars.png" width="30px">
          	<h6 class="m-0 ms-2">Random user3</h6>
          </div>
          <p>
          	"Highly impressed with this house rental site! It's user-friendly interface and extensive listings made my search for a new home a breeze. From budget-friendly options to luxurious accommodations, there's something for everyone. Plus, the quick response from landlords and agents ensured a smooth renting process. Definitely recommend it to anyone in search of their next home!" 
          </p>
          <div class="rating">
          	<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>

        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
          	<img src="images/facilities/stars.png" width="30px">
          	<h6 class="m-0 ms-2">Random user1</h6>
          </div>
          <p>
          "This room rental website exceeded my expectations! It's incredibly user-friendly, allowing me to easily browse through numerous listings and find the perfect room that fits my budget and preferences. The detailed descriptions and photos provided valuable insights, and the communication with landlords was seamless. I'm grateful for such a convenient platform to find my ideal living space. Highly recommend it to anyone in search of a room rental!"
          </p>
          <div class="rating">
          	<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
    		<i class="bi bi-star-fill text-warning"></i>
          </div>
        </div>

      </div>
      <div class="swiper-pagination"></div>
    </div>
 </div>

<hr>
 <?php require('includes/footer.php') ?>
 <?php include 'includes/scripts.php'; ?>
<!-- JavaScript Bundle with Popper -->


 <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

 <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
        	delay: 3500,
        	disableOnInteraction: false,
        }
      });

      var swiper = new Swiper(".swiper-testimonials", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        slidesPerView: "3",
        loop: true,
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: false,
        },
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
        		slidesPerView: 2,
        	},
        	1024: {
        		slidesPerView: 3,
        	},
        }
      });
    </script>
</body>
</html>