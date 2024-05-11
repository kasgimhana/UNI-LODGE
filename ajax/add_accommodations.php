<?php
include '../admin/db_config.php';
include '../admin/essentials.php';

if (isset($_POST['add_accommodation'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $lon = $_POST['lon'];
    $lat = $_POST['lat'];
    $address = $_POST['address'];
    $thumbnail = $_FILES['thumbnail'];
    $images = $_FILES['images'];
    $bathrooms = $_POST['bathrooms'];
    $kitchens = $_POST['kitchens'];
    $rooms = $_POST['rooms'];
    $beds = $_POST['beds'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];

    $uId = $_POST['uId'];

    $thumbnailName = uploadImage($thumbnail, '');
    $imageNames = [];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $imageNames[] = uploadImage(['tmp_name' => $tmp_name, 'name' => $images['name'][$key]], '');
    }

    // Insert accommodation details into the accommodations table
    $sql = "INSERT INTO accommodations (name, description, lon, lat, address, thumbnail, bathrooms, kitchens, rooms, beds, price, capacity, uId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $values = [$name, $description, $lon, $lat, $address, $thumbnailName, $bathrooms, $kitchens, $rooms, $beds, $price, $capacity, $uId];
    $data_types = "ssssssiiiidii";
    $result = insert($sql, $values, $data_types);

    if ($result) {
        // Get the ID of the newly inserted accommodation
        $accommodation_id = mysqli_insert_id($connection); // Assuming $connection is your database connection variable

        // Insert image names into the accommodation_images table
        foreach ($imageNames as $imageName) {
            $sql = "INSERT INTO accommodation_images (image_path, accommodation_id) VALUES (?, ?)";
            $values = [$imageName, $accommodation_id]; // Use the accommodation ID from the first insert
            $data_types = "si";
            insert($sql, $values, $data_types);
        }

        echo 1;
    } else {
        echo 'failed';
    }
} else {
    echo 'failed';
}

function uploadImage($file)
{
    $target_dir = __DIR__ . '/uploads/';
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $uniqueName = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $uniqueName;

    // Check if the 'size' key exists in the $_FILES array
    if (isset($file['size']) && $file['size'] > 0) {
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            return null;
        }

        if ($file['size'] > 5000000) {
            return null;
        }
    }

    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        return null;
    }

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $uniqueName;
    } else {
        return null;
    }
}
