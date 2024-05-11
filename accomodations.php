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



        #map {
            height: 100%;
            width: 100%;
            border-radius: 10px;
            transition: all;
        }

        .card:hover {
            border: 1px solid gray;
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
            }

            50% {
                box-shadow: 0 0 20px rgba(0, 0, 255, 0.8);
            }

            100% {
                box-shadow: 0 0 10px rgba(0, 0, 255, 0.5);
            }
        }

        .glow-button {
            animation: glow 1s infinite;
        }

        .carousel-item img {
            max-width: 300px;
            margin: 0 auto;
        }

        .carousel {
            margin: 0 auto;
        }

        #image-preview {
            margin-top: 10px;
        }

        .image-preview {
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .image-preview button {
            position: absolute;
            top: 0;
            right: 0;
            padding: 2px 6px;
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 0 0 0 5px;
            cursor: pointer;
        }
    </style>
</head>

<!-- Header -->
<?php include 'includes/header.php'; ?>
<?php include('ajax/get_accommodations.php'); ?>

<?php
$add_accommodation_btn = "";
$reserve_button = "";
if (!$settings_result['shutdown']) {
    $reserve_button = "";
    if (!$settings_result['shutdown'] && (!isset($_SESSION['uRole']) || ($_SESSION['uRole'] !== 'landlord' && $_SESSION['uRole'] !== 'warden'))) {
        $reserve_button = '<button type="button" onclick="book_accommodation();" class="btn btn-success" id="reserveButton">Reserve</button>';
    }

    if (isset($_SESSION['uRole']) && $_SESSION['uRole'] == 'landlord') {
        $add_accommodation_btn = '<button data-bs-toggle="modal" data-bs-target="#addAccommodationModal" class="btn btn-primary position-fixed translate-middle-y m-3 glow-button" style="z-index: 1000; top: 110px; right: 0px">Add +</button>';
    }
}
?>

<body class="bg-light">

    <?php echo ($add_accommodation_btn) ?>

    <!-- Add Accommodation Modal -->
    <div class="modal fade" id="addAccommodationModal" tabindex="-1" aria-labelledby="addAccommodationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccommodationModalLabel">Add Accommodation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Accommodation Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lon" class="form-label">Location Longitude</label>
                            <input type="text" class="form-control" id="lon" required>
                        </div>
                        <div class="mb-3">
                            <label for="lat" class="form-label">Location Latitude</label>
                            <input type="text" class="form-control" id="lat" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail Image</label>
                            <input type="file" class="form-control" id="thumbnail" accept=".jpg, .png, .jpeg, .gif" onchange="handleThumbnailSelect(event)" required>
                            <div id="thumbnail-preview"></div>
                            <button type="button" class="btn btn-danger mt-2" id="remove-thumbnail" accept=".jpg, .png, .jpeg, .gif" disabled>Remove Thumbnail</button>
                        </div>
                        <div id="image-preview-thumbnail" class="d-flex flex-wrap"></div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Images (up to 5 files)</label>
                            <input type="file" class="form-control" id="images" accept="image/*" onchange="handleFileSelect(event)" required>
                        </div>
                        <div id="image-preview" class="d-flex flex-wrap"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="bathrooms" class="form-label">No. of Bathrooms</label>
                                <input type="number" class="form-control" id="bathrooms" required>
                            </div>
                            <div class="col-md-6">
                                <label for="kitchens" class="form-label">No. of Kitchens</label>
                                <input type="number" class="form-control" id="kitchens" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="rooms" class="form-label">No. of Rooms</label>
                                <input type="number" class="form-control" id="rooms" required>
                            </div>
                            <div class="col-md-6">
                                <label for="beds" class="form-label">No. of Beds</label>
                                <input type="number" class="form-control" id="beds" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (Per Month)</label>
                            <input type="number" class="form-control" id="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" required>
                        </div>
                        <div class="text-end my-1">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <input type="hidden" id="uId" value="<?php echo $_SESSION['uId']; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Accommodations</h2>
    </div>

    <?php
    $accommodations = getAccommodations()
    ?>

    <!-- List of Accommodations -->
    <div class="container">
        <div class="row mb-5 bg-white rounded shadow p-4 mb-5" id="cardContainer">
            <div class="col-12 col-md-5 col-lg-4 col-xl-3 mb-3" style="overflow-y: auto; height: 400px;">
                <?php
                if (empty($accommodations)) {
                    echo '<div style="height: 50vh; display: flex; justify-content:center; align-items:center" class="text-center"><span>No accommodations at the moment.</span></div>';
                } else {
                    foreach ($accommodations as $accommodation) {
                        $thumbnailPath = 'ajax/uploads/' . $accommodation['thumbnail'];
                        $isReserved = $accommodation['reserved'] !== -1;
                        $phoneNumbers = $accommodation['phoneNumbers'];

                        echo '
                        <div class="col">
                            <div class="card h-100 d-flex flex-column justify-content-center align-items-center" style="cursor:pointer; position: relative;"
                                data-reserved="' . $accommodation['reserved'] . '"
                                data-status="' . $accommodation['status'] . '"
                                data-name="' . $accommodation['name'] . '"
                                data-description="' . $accommodation['description'] . '"
                                data-thumbnail="' . $thumbnailPath . '"
                                data-lon="' . $accommodation['lon'] . '"
                                data-lat="' . $accommodation['lat'] . '"
                                data-address="' . $accommodation['address'] . '"
                                data-phone1="' . $phoneNumbers['phone_number'] . '"
                                data-phone2="' . $phoneNumbers['secondary_phone_number'] . '"
                                data-bathrooms="' . $accommodation['bathrooms'] . '"
                                data-kitchens="' . $accommodation['kitchens'] . '"
                                data-rooms="' . $accommodation['rooms'] . '"
                                data-beds="' . $accommodation['beds'] . '"
                                data-price="' . $accommodation['price'] . '"
                                data-capacity="' . $accommodation['capacity'] . '"
                                data-id_no="' . $accommodation['id_no'] . '"';

                        // Add data attributes for each image URL
                        foreach ($accommodation['images'] as $index => $image) {
                            echo ' data-image-' . $index . '="' . $image . '"';
                        }

                        // Add style for reserved accommodations
                        $reservedStyle = $isReserved ? 'position: absolute; top: 0; left: 0; background-color: red; color: white; padding: 5px;' : '';

                        echo '>
                                <img src="' . $thumbnailPath . '" class="img-thumbnail mt-3" alt="Accommodation Thumbnail" style="width: 250px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . $accommodation['name'] . '</h5>
                                    <p class="card-text">' . $accommodation['description'] . '</p>
                                    <span style="' . $reservedStyle . '">' . ($isReserved ? 'Reserved' : '') . '</span>
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>
            </div>
            <div class="col-12 col-md-7 col-lg-8 col-xl-9 d-flex flex-column justify-content-center align-items-center">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>

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
                    <p><strong>Address:</strong> <span id="accommodationAddress"></span></p>
                    <p><strong>phone 1:</strong> <span id="accommodationPhone1"></span></p>
                    <p><strong>Phone 2:</strong> <span id="accommodationPhone2"></span></p>
                    <p><strong>Bathrooms:</strong> <span id="accommodationBathrooms"></span></p>
                    <p><strong>Kitchens:</strong> <span id="accommodationKitchens"></span></p>
                    <p><strong>Rooms:</strong> <span id="accommodationRooms"></span></p>
                    <p><strong>Beds:</strong> <span id="accommodationBeds"></span></p>
                    <p><strong>Price:</strong> <span id="accommodationPrice"></span></p>
                    <p><strong>Capacity:</strong> <span id="accommodationCapacity"></span></p>
                    <input type="hidden" id="accommodationId" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <?php echo $reserve_button; ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9C3ZQP5xjNW21JgyEmpfXX5nCRASZ4XI&loading=async&callback=initMap">
    </script>

    <script>
        function book_accommodation() {
            const accommodationId = document.getElementById('accommodationId').value;
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/reserve_accommodation.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("Success", "Accommodation booked", "success");
                    location.reload();
                } else {
                    alert("Attention", "Failed to book accommodation");
                }
            };

            xhr.send('id_no=' + accommodationId + '&action=book');
        }
    </script>

    <script>
        var locations = [];

        // Load accommodation data
        <?php
        foreach ($accommodations as $accommodation) {
            $acc_id = $accommodation['id_no'];
            $lat = $accommodation['lat'];
            $lon = $accommodation['lon'];
            $name = $accommodation['name'];
            $address = $accommodation['address'];
            $phoneNumbers = $accommodation['phoneNumbers'];

            // Create an array to hold image URLs
            $images = [];
            foreach ($accommodation['images'] as $index => $image) {
                $images[] = $image;
            }

            // Add accommodation data to locations array
            echo "locations.push({
                reserved: '{$accommodation['reserved']}',
                status: '{$accommodation['status']}',
                id: $acc_id,
                lat: $lat,
                lng: $lon,
                name: '$name',
                address: '$address',
                description: '{$accommodation['description']}',
                phone1: '{$phoneNumbers['phone_number']}',
                phone2: '{$phoneNumbers['secondary_phone_number']}',
                kitchens: '{$accommodation['kitchens']}',
                rooms: '{$accommodation['rooms']}',
                beds: '{$accommodation['beds']}',
                price: '{$accommodation['price']}',
                capacity: '{$accommodation['capacity']}',
                thumbnail: '{$accommodation['thumbnail']}',
                images: " . json_encode($images) . "
            });";
        }
        ?>

        function initMap() {
            // Initialize the map
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 6.821788505674078,
                    lng: 80.04165336626556
                },
                zoom: 12
            });

            locations.forEach(function(location) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });

                var infowindowContent = '<strong>' + location.name + '</strong><br>' + location.address;
                if (location.thumbnail) {
                    infowindowContent += '<br><img src="' + "ajax/uploads/" + location.thumbnail + '" style="max-width: 100px; max-height: 100px; margin-top: 5px;" />';
                }

                var infowindow = new google.maps.InfoWindow({
                    content: infowindowContent
                });

                marker.addListener('mouseover', function() {
                    infowindow.open(map, marker);
                });

                marker.addListener('mouseout', function() {
                    infowindow.close();
                });

                marker.addListener('click', function() {
                    // Show the accommodation details modal
                    var modal = new bootstrap.Modal(document.getElementById('accommodationDetailsModal'));
                    modal.show();

                    // Set modal content
                    document.getElementById('accommodationId').value = location.id;
                    document.getElementById('accommodationModalLabel').textContent = location.name;
                    document.getElementById('accommodationDescription').textContent = location.description;
                    document.getElementById('accommodationAddress').textContent = location.address;
                    document.getElementById('accommodationPhone1').textContent = location.phone1;
                    document.getElementById('accommodationPhone2').textContent = location.phone2;
                    document.getElementById('accommodationBathrooms').textContent = location.bathrooms;
                    document.getElementById('accommodationKitchens').textContent = location.kitchens;
                    document.getElementById('accommodationRooms').textContent = location.rooms;
                    document.getElementById('accommodationBeds').textContent = location.beds;
                    document.getElementById('accommodationPrice').textContent = location.price;
                    document.getElementById('accommodationCapacity').textContent = location.capacity;

                    // Clear previous carousel items
                    const modalCarouselInner = document.querySelector('#accommodationCarousel .carousel-inner');
                    modalCarouselInner.innerHTML = '';

                    // Add images to the carousel
                    for (let i = 0; i < location.images.length; i++) {
                        const carouselItem = document.createElement('div');
                        carouselItem.classList.add('carousel-item');
                        if (i === 0) {
                            carouselItem.classList.add('active');
                        }
                        const image = document.createElement('img');
                        image.src = 'ajax/uploads/' + location.images[i];
                        image.classList.add('d-block', 'w-100');
                        carouselItem.appendChild(image);
                        modalCarouselInner.appendChild(carouselItem);
                    }

                    if (location.status != -1) {
                        var reserveButton = document.getElementById('reserveButton');
                        if (reserveButton) {
                            reserveButton.style.display = 'none';
                        }
                    }
                });
            });
        }

        // Initialize the map with accommodation locations
        initMap();
    </script>
    <script>
        function handleThumbnailSelect(event) {
            thumbnailFile = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const thumbnailPreview = document.getElementById('thumbnail-preview');
                thumbnailPreview.innerHTML = ''; // Clear previous preview

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail', 'mt-3');
                img.style.width = '250px';

                thumbnailPreview.appendChild(img);

                // Enable the "Remove Thumbnail" button
                document.getElementById('remove-thumbnail').removeAttribute('disabled');
            };

            reader.readAsDataURL(thumbnailFile);
        }

        document.getElementById('remove-thumbnail').addEventListener('click', function() {
            const thumbnailPreview = document.getElementById('thumbnail-preview');
            thumbnailPreview.innerHTML = ''; // Clear the preview
            thumbnailFile = null; // Reset the selected file
            document.getElementById('remove-thumbnail').setAttribute('disabled', 'disabled');
            document.getElementById('thumbnail').value = ''; // Clear the input value
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            const modalId = document.getElementById('accommodationId');
            const modalTitle = document.getElementById('accommodationModalLabel');
            const modalDescription = document.getElementById('accommodationDescription');
            const modalAddress = document.getElementById('accommodationAddress');
            const modalPhone1 = document.getElementById('accommodationPhone1');
            const modalPhone2 = document.getElementById('accommodationPhone2');
            const modalBathrooms = document.getElementById('accommodationBathrooms');
            const modalKitchens = document.getElementById('accommodationKitchens');
            const modalRooms = document.getElementById('accommodationRooms');
            const modalBeds = document.getElementById('accommodationBeds');
            const modalPrice = document.getElementById('accommodationPrice');
            const modalCapacity = document.getElementById('accommodationCapacity');
            const modalCarouselInner = document.querySelector('#accommodationCarousel .carousel-inner');

            cards.forEach(card => {
                card.addEventListener('click', function() {
                    modalId.value = card.dataset.id_no;
                    modalTitle.textContent = card.dataset.name;
                    modalDescription.textContent = card.dataset.description;
                    modalAddress.textContent = card.dataset.address;
                    modalPhone1.textContent = card.dataset.phone1;
                    modalPhone2.textContent = card.dataset.phone2;
                    modalBathrooms.textContent = card.dataset.bathrooms;
                    modalKitchens.textContent = card.dataset.kitchens;
                    modalRooms.textContent = card.dataset.rooms;
                    modalBeds.textContent = card.dataset.beds;
                    modalPrice.textContent = card.dataset.price;
                    modalCapacity.textContent = card.dataset.capacity;
                    console.log(card.dataset.reserved);

                    // Clear previous carousel items
                    modalCarouselInner.innerHTML = '';

                    // Add images to the carousel
                    for (let i = 0; i < 5; i++) {
                        if (card.dataset['image-' + i]) {
                            const carouselItem = document.createElement('div');
                            carouselItem.classList.add('carousel-item');
                            if (i === 0) {
                                carouselItem.classList.add('active');
                            }
                            const image = document.createElement('img');
                            image.src = 'ajax/uploads/' + card.dataset['image-' + i];
                            image.classList.add('d-block', 'w-100');
                            carouselItem.appendChild(image);
                            modalCarouselInner.appendChild(carouselItem);
                        }
                    }

                    if (card.dataset.reserved != -1) {
                        var reserveButton = document.getElementById('reserveButton');
                        if (reserveButton) {
                            reserveButton.style.display = 'none';
                        }
                    }

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('accommodationDetailsModal'));
                    modal.show();
                });
            });
        });
    </script>

    <script>
        let selectedFiles = [];

        function handleFileSelect(event) {
            const files = event.target.files;
            if (files.length + selectedFiles.length > 5) {
                alert("Attention", "You can only select up to 5 files.");
                event.target.value = ""; // Clear the selected files
                return;
            }
            for (let i = 0; i < files.length; i++) {
                selectedFiles.push(files[i]);

                let container = document.createElement('div');
                container.classList.add('image-preview');

                let img = document.createElement('img');
                img.src = URL.createObjectURL(files[i]);
                img.width = 100;
                img.height = 100;

                let removeBtn = document.createElement('button');
                removeBtn.textContent = 'Remove';
                removeBtn.addEventListener('click', function() {

                    let index = selectedFiles.indexOf(files[i]);
                    if (index !== -1) {
                        selectedFiles.splice(index, 1);
                    }
                    container.remove();
                });

                container.appendChild(img);
                container.appendChild(removeBtn);


                let previewContainer = document.getElementById('image-preview');
                previewContainer.appendChild(container);
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            let addAccommodationForm = document.querySelector('#addAccommodationModal form');
            addAccommodationForm.addEventListener('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(addAccommodationForm);
                let uId = document.getElementById('uId').value;
                formData.append('add_accommodation', '');

                // Retrieve specific form field values and append to formData
                let name = document.getElementById('name').value;
                let description = document.getElementById('description').value;
                let lon = document.getElementById('lon').value;
                let lat = document.getElementById('lat').value;
                let address = document.getElementById('address').value;
                let thumbnail = document.getElementById('thumbnail').files[0];
                for (let i = 0; i < selectedFiles.length; i++) {
                    formData.append('images[]', selectedFiles[i]);
                }
                let bathrooms = document.getElementById('bathrooms').value;
                let kitchens = document.getElementById('kitchens').value;
                let rooms = document.getElementById('rooms').value;
                let beds = document.getElementById('beds').value;
                let price = document.getElementById('price').value;
                let capacity = document.getElementById('capacity').value;

                formData.append('name', name);
                formData.append('description', description);
                formData.append('lon', lon);
                formData.append('lat', lat);
                formData.append('address', address);
                formData.append('thumbnail', thumbnail);
                formData.append('bathrooms', bathrooms);
                formData.append('kitchens', kitchens);
                formData.append('rooms', rooms);
                formData.append('beds', beds);
                formData.append('price', price);
                formData.append('capacity', capacity);
                formData.append('uId', uId);

                console.log("Thumbnail File : " + thumbnail);
                console.log("Selected Files : " + selectedFiles);

                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'ajax/add_accommodations.php', true);
                xhr.onload = function() {
                    if (this.responseText == 1) {

                        alert("Success", "Accommodation added successfully!", "success");

                        addAccommodationForm.reset();

                        // Clear thumbnail preview
                        document.getElementById('thumbnail-preview').innerHTML = '';
                        document.getElementById('remove-thumbnail').setAttribute('disabled', 'disabled');
                        document.getElementById('thumbnail').value = '';

                        // Clear selected images preview
                        document.getElementById('image-preview').innerHTML = '';
                        selectedFiles = [];

                        var modalReference = document.getElementById('addAccommodationModal');
                        var modal = bootstrap.Modal.getInstance(modalReference);
                        modal.hide();

                    } else if (this.responseText == 'file-size-error') {
                        alert("Attention", "Invalid Image File Sizes Found", "danger");
                    } else if (this.responseText == 'file-type-error') {
                        alert("Attention", "Invalid File Types Found", "danger");
                    } else {
                        alert("Attention", "Server error. Please try again later.", "danger");
                    }
                }
                xhr.send(formData);
            });
        });
    </script>

</body>

</html>