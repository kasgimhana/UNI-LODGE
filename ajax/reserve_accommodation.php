<?php
include '../admin/db_config.php';
include '../admin/essentials.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    if (isset($_POST['id_no']) && isset($_POST['action']) && $_POST['action'] === 'book') {
        $accommodation_id = $_POST['id_no'];

        // Perform the booking action here, for example, insert into a bookings table
        $sql = "INSERT INTO bookings (accommodation_id, user_id) VALUES (?, ?)";
        $values = [$accommodation_id, $_SESSION['uId']];
        $data_types = 'ii';

        $booking_id = insert($sql, $values, $data_types);

        // Update the reserved column in the accommodations table
        if ($booking_id) {
            $sql = "UPDATE accommodations SET reserved = ? WHERE id_no = ?";
            $values = [$booking_id, $accommodation_id];
            $data_types = 'ii';

            $result = update($sql, $values, $data_types);

            if ($result) {
                echo "1"; // Success
            } else {
                echo "Failed to update the reserved column in the accommodations table.";
            }
        } else {
            echo "Failed to insert booking data into the bookings table.";
        }
    } else {
        echo "Invalid parameters or action.";
    }
} else {
    echo "Invalid request method.";
}
