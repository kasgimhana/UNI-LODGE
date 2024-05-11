<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/links.php'; ?>
    <title><?php echo $settings_result['site_title'] ?> : My Accommodations</title>

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
<?php include('ajax/my_accommodations.php'); ?>

<body class="bg-light" style="display: flex; flex-direction: column; min-height: 100vh; ">
    <main style="flex:1">
        <div class="container-fluid my-5">
            <h2 class="fw-bold h-font text-center">My Accommodations</h2>

            <?php
            $myAccommodations = getMyAccommodations();
            ?>
            <!-- Check if the array is empty -->
            <?php if (empty($myAccommodations)) : ?>
                <div style="height: 50vh; display: flex; justify-content:center; align-items:center" class="text-center"><span>No accommodations found.</span></div>
            <?php else : ?>
                <!-- List of Pending Accommodations -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php
                    foreach ($myAccommodations as $accommodation) {
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

                        $decline_banner = '';
                        $reason = '';

                        if ($accommodation['status'] == -1) {
                            $banner = "<div class='bg-danger text-light'>Declined</div>";
                            $reason = "<p style='padding-left:20px; padding-right:20px;'>" . $accommodation['message'] . "</p>";
                        } else if ($accommodation['status'] == 0) {
                            $banner = "<div class='bg-warning text-light'>Pending</div>";
                        } else {
                            $banner = "<div class='bg-success text-light'>Approved</div>";
                        }

                        echo '>
            ' . $banner . '
            <br>' . $reason . '<br>
            <img src="' . $thumbnailPath . '" class="img-thumbnail mt-3" alt="Accommodation Thumbnail" style="width: 250px;">
            <div class="card-body text-center">
                <h5 class="card-title">' . $accommodation['name'] . '</h5>
                <p class="card-text">' . $accommodation['description'] . '</p>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary mt-1 view-more">View Details</button>
                <button type="button" class="btn btn-secondary mt-1 edit-accommodation-btn">Edit</button>
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
                    <button type="button" class="btn btn-danger" onclick="delete_accommodation('<?php echo $accommodation['id_no']; ?>')">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Accommodation Modal -->
    <div class="modal fade" id="editAccommodationModal" tabindex="-1" aria-labelledby="editAccommodationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccommodationModalLabel">Edit Accommodation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAccommodationForm" method="POST">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Accommodation Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editLon" class="form-label">Location Longitude</label>
                            <input type="text" class="form-control" id="editLon" name="lon" required>
                        </div>
                        <div class="mb-3">
                            <label for="editLat" class="form-label">Location Latitude</label>
                            <input type="text" class="form-control" id="editLat" name="lat" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="address" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="editBathrooms" class="form-label">No. of Bathrooms</label>
                                <input type="number" class="form-control" id="editBathrooms" name="bathrooms" required>
                            </div>
                            <div class="col-md-6">
                                <label for="editKitchens" class="form-label">No. of Kitchens</label>
                                <input type="number" class="form-control" id="editKitchens" name="kitchens" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="editRooms" class="form-label">No. of Rooms</label>
                                <input type="number" class="form-control" id="editRooms" name="rooms" required>
                            </div>
                            <div class="col-md-6">
                                <label for="editBeds" class="form-label">No. of Beds</label>
                                <input type="number" class="form-control" id="editBeds" name="beds" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="editPrice" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCapacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="editCapacity" name="capacity" required>
                        </div>
                        <input type="hidden" id="editId" name="id">
                        <div class="text-end my-1">
                            <button type="button" class="btn btn-primary save-accommodation-btn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.save-accommodation-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = document.getElementById('editId').value;
                var name = document.getElementById('editName').value;
                var description = document.getElementById('editDescription').value;
                var lon = document.getElementById('editLon').value;
                var lat = document.getElementById('editLat').value;
                var address = document.getElementById('editAddress').value;
                var bathrooms = document.getElementById('editBathrooms').value;
                var kitchens = document.getElementById('editKitchens').value;
                var rooms = document.getElementById('editRooms').value;
                var beds = document.getElementById('editBeds').value;
                var price = document.getElementById('editPrice').value;
                var capacity = document.getElementById('editCapacity').value;

                var formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                formData.append('description', description);
                formData.append('lon', lon);
                formData.append('lat', lat);
                formData.append('address', address);
                formData.append('bathrooms', bathrooms);
                formData.append('kitchens', kitchens);
                formData.append('rooms', rooms);
                formData.append('beds', beds);
                formData.append('price', price);
                formData.append('capacity', capacity);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'ajax/update_accommodation.php', true);
                xhr.onload = function() {
                    if (this.responseText == 1) {

                        var modalReference = document.getElementById('editAccommodationModal');
                        var modal = bootstrap.Modal.getInstance(modalReference);
                        modal.hide();

                        alert('Success', "Accommodation details updated", "success")
                        location.reload();

                    } else {
                        alert("Alert", 'Accommodation did not get updated')
                    }
                };
                xhr.send(formData);
            });
        });
    </script>

    <script>
        document.querySelectorAll('.edit-accommodation-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var card = button.closest('.card');
                var id_no = card.dataset.id_no;
                var name = card.dataset.name;
                var description = card.dataset.description;
                var lon = card.dataset.lon;
                var lat = card.dataset.lat;
                var address = card.dataset.address;
                var thumbnail = card.dataset.thumbnail;
                var bathrooms = card.dataset.bathrooms;
                var kitchens = card.dataset.kitchens;
                var rooms = card.dataset.rooms;
                var beds = card.dataset.beds;
                var price = card.dataset.price;
                var capacity = card.dataset.capacity;

                document.getElementById('editId').value = id_no;
                document.getElementById('editName').value = name;
                document.getElementById('editDescription').value = description;
                document.getElementById('editLon').value = lon;
                document.getElementById('editLat').value = lat;
                document.getElementById('editAddress').value = address;
                document.getElementById('editBathrooms').value = bathrooms;
                document.getElementById('editKitchens').value = kitchens;
                document.getElementById('editRooms').value = rooms;
                document.getElementById('editBeds').value = beds;
                document.getElementById('editPrice').value = price;
                document.getElementById('editCapacity').value = capacity;

                var modal = new bootstrap.Modal(document.getElementById('editAccommodationModal'));
                modal.show();
            });
        });
    </script>


    <script>
        document.querySelectorAll('.view-more').forEach(function(button) {
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
                    carouselItem.innerHTML = '<img src="ajax/uploads/' + image + '" class="d-block" alt="Accommodation Image">';
                    modalCarousel.appendChild(carouselItem);
                });

                var modal = new bootstrap.Modal(document.getElementById('accommodationDetailsModal'));
                modal.show();
            });
        });

        function delete_accommodation(id_no) {
            console.log(id_no);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/delete_accommodation.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("Success", "Accommodation deleted", "success");
                    location.reload();
                } else {
                    alert("Attention", "Failed to delete accommodation");
                }
            }

            xhr.send('id_no=' + id_no + '&action=delete');
        }
    </script>

    <?php include 'includes/scripts.php'; ?>

</body>

</html>