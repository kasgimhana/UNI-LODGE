<?php
include '../admin/db_config.php';
include '../admin/essentials.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['lon']) && isset($_POST['lat']) && isset($_POST['address']) && isset($_POST['bathrooms']) && isset($_POST['kitchens']) && isset($_POST['rooms']) && isset($_POST['beds']) && isset($_POST['price']) && isset($_POST['capacity'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $lon = $_POST['lon'];
        $lat = $_POST['lat'];
        $address = $_POST['address'];
        $bathrooms = $_POST['bathrooms'];
        $kitchens = $_POST['kitchens'];
        $rooms = $_POST['rooms'];
        $beds = $_POST['beds'];
        $price = $_POST['price'];
        $capacity = $_POST['capacity'];

        $sql = "UPDATE accommodations SET name = ?, description = ?, lon = ?, lat = ?, address = ?, bathrooms = ?, kitchens = ?, rooms = ?, beds = ?, price = ?, capacity = ? WHERE id_no = ?";
        $values = [$name, $description, $lon, $lat, $address, $bathrooms, $kitchens, $rooms, $beds, $price, $capacity, $id];
        $data_types = 'sssssiiiidii';

        // Call the update function
        $result = update($sql, $values, $data_types);

        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    } else {
        echo "Missing parameters in the form submission.";
    }
} else {
    echo "Invalid request method.";
}
