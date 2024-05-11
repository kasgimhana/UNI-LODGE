<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : Pending Accommodations</title>

    <style>
        .carousel-item img {
            max-width: 300px;
            margin: 0 auto;
        }

        .carousel {
            margin: 0 auto;
        }

        .carousel-inner img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>
<?php include('ajax/get_pending_accommodations.php'); ?>

<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh; ">
    <main style="flex:1">
        <div class="container-fluid my-5">
            <h2 class="fw-bold h-font text-center">Pending Accommodations</h2>

            <?php
            $pendingAccommodations = getPendingAccommodations();
            ?>
            <!-- Check if the array is empty -->
            <?php if (empty($pendingAccommodations)) : ?>
                <div style="height: 50vh; display: flex; justify-content:center; align-items:center" class="text-center"><span>No pending accommodations found.</span></div>
            <?php else : ?>
                <!-- List of Pending Accommodations -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php
                    foreach ($pendingAccommodations as $accommodation) {
                        $thumbnailPath = 'ajax/uploads/' . $accommodation['thumbnail'];
                        echo '
                        <div class="col">
                            <div class="card h-100 d-flex flex-column justify-content-center align-items-center"
                                data-name="' . $accommodation['name'] . '"
                                data-description="' . $accommodation['description'] . '"
                                data-thumbnail="' . $thumbnailPath . '"
                                data-lat="' . $accommodation['lat'] . '"
                                data-lon="' . $accommodation['lon'] . '"
                                data-address="' . $accommodation['address'] . '"
                                data-bathrooms="' . $accommodation['bathrooms'] . '"
                                data-kitchens="' . $accommodation['kitchens'] . '"
                                data-rooms="' . $accommodation['rooms'] . '"
                                data-beds="' . $accommodation['beds'] . '"
                                data-price="' . $accommodation['price'] . '"
                                data-capacity="' . $accommodation['capacity'] . '"
                                data-id_no="' . $accommodation['id_no'] . '"
                                ';

                        // Add data attributes for each image URL
                        foreach ($accommodation['images'] as $index => $image) {
                            echo 'data-image-' . $index . '="' . $image . '" ';
                        }

                        echo '>
                                <img src="' . $thumbnailPath . '" class="img-thumbnail mt-3" alt="Accommodation Thumbnail" style="width: 250px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . $accommodation['name'] . '</h5>
                                    <p class="card-text">' . $accommodation['description'] . '</p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-primary mt-1 view-more-btn">View Details</a>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- Accommodation Details Modal -->
    <div class="modal fade" id="accommodationDetailsModal" tabindex="-1" aria-labelledby="accommodationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accommodationModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="accommodationCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-dark">
                            <!-- Carousel items will be dynamically added here -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#accommodationCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#accommodationCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p id="accommodationDescription"></p>
                    <!-- Add other details here -->
                    <p><strong>Address:</strong> <span id="accommodationAddress"></span></p>
                    <p><strong>Bathrooms:</strong> <span id="accommodationBathrooms"></span></p>
                    <p><strong>Kitchens:</strong> <span id="accommodationKitchens"></span></p>
                    <p><strong>Rooms:</strong> <span id="accommodationRooms"></span></p>
                    <p><strong>Beds:</strong> <span id="accommodationBeds"></span></p>
                    <p><strong>Price:</strong> <span id="accommodationPrice"></span></p>
                    <p><strong>Capacity:</strong> <span id="accommodationCapacity"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="decline_accommodation()" class="btn btn-danger" id="declineButton">Decline</button>
                    <button type="button" onclick="accept_accommodation()" class="btn btn-success" id="acceptButton">Accept</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.view-more-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var card = button.closest('.card');
                var id_no = card.dataset.id_no;
                var name = card.dataset.name;
                var description = card.dataset.description;
                var thumbnailPath = card.dataset.thumbnail;
                var lon = card.dataset.lon;
                var lat = card.dataset.lat;
                var address = card.dataset.address;
                var bathrooms = card.dataset.bathrooms;
                var kitchens = card.dataset.kitchens;
                var rooms = card.dataset.rooms;
                var beds = card.dataset.beds;
                var price = card.dataset.price;
                var capacity = card.dataset.capacity;

                var images = [];
                var index = 0;
                while (card.dataset['image-' + index]) {
                    images.push(card.dataset['image-' + index]);
                    index++;
                }

                var modalTitle = document.getElementById('accommodationModalLabel');
                var modalDescription = document.getElementById('accommodationDescription');
                var modalAddress = document.getElementById('accommodationAddress');
                var modalBathrooms = document.getElementById('accommodationBathrooms');
                var modalKitchens = document.getElementById('accommodationKitchens');
                var modalRooms = document.getElementById('accommodationRooms');
                var modalBeds = document.getElementById('accommodationBeds');
                var modalPrice = document.getElementById('accommodationPrice');
                var modalCapacity = document.getElementById('accommodationCapacity');
                var modalCarousel = document.querySelector('#accommodationCarousel .carousel-inner');

                modalTitle.textContent = name;
                modalDescription.textContent = description;
                modalAddress.textContent = address;
                modalBathrooms.textContent = bathrooms;
                modalKitchens.textContent = kitchens;
                modalRooms.textContent = rooms;
                modalBeds.textContent = beds;
                modalPrice.textContent = price;
                modalCapacity.textContent = capacity;

                modalCarousel.innerHTML = '';
                images.forEach(function(image, index) {
                    var activeClass = index === 0 ? 'active' : '';
                    var carouselItem = document.createElement('div');
                    carouselItem.className = 'carousel-item ' + activeClass;
                    carouselItem.innerHTML = '<img src="ajax/uploads/' + image + '" class="d-block w-100" alt="Accommodation Image">';
                    modalCarousel.appendChild(carouselItem);
                });

                var modal = new bootstrap.Modal(document.getElementById('accommodationDetailsModal'));
                modal.show();

                document.getElementById('acceptButton').addEventListener('click', function() {
                    accept_accommodation(id_no);
                });

                document.getElementById('declineButton').addEventListener('click', function() {
                    var reason = prompt("Enter the reason for declining:");
                    decline_accommodation(id_no);

                    if (reason !== null) {
                        decline_accommodation(id_no, reason);
                    }
                });
            });
        });


        function accept_accommodation(id_no) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/pending_accommodations.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                console.log(this.response);

                if (this.responseText == 1) {
                    alert("Success", "Accommodation accepted", "success");
                    location.reload(); // Reload the page after accepting
                } else {
                    alert("Attention", "Failed to accept accommodation");
                }
            }

            xhr.send('id_no=' + id_no + '&action=accept');
        }

        function decline_accommodation(id_no, reason) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/pending_accommodations.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {

                if (this.responseText == 1) {
                    alert("Success", "Accommodation declined", "success");
                    location.reload(); // Reload the page after declining
                } else {
                    alert("Attention", "Failed to decline accommodation");
                }
            }

            xhr.send('id_no=' + id_no + '&action=decline&reason=' + encodeURIComponent(reason));
        }
    </script>
    <?php include 'includes/scripts.php'; ?>

</body>

</html>