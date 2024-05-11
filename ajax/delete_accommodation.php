<?php
include '../admin/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_no']) && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id_no = $_POST['id_no'];

    // Prepare the SELECT query to get the image names
    $select_query = "SELECT thumbnail FROM accommodations WHERE id_no = ?";
    $values = [$id_no];
    $thumbnail = selectSingle($select_query, $values, 'i');

    $select_query = "SELECT image_path FROM accommodation_images WHERE accommodation_id = ?";
    $values = [$id_no];
    $images = select($select_query, $values, 'i');

    // Prepare the DELETE query
    $query = "DELETE FROM accommodations WHERE id_no = ?";
    $values = [$id_no];

    // Delete the accommodation
    $result = delete($query, $values, 'i');

    if ($result === 1) {
        // Delete the files
        $target_dir = __DIR__ . '/uploads/';
        foreach ($images as $image) {
            $file_path = $target_dir . $image['image_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        // Delete the thumbnail
        $thumbnail_path = $target_dir . $thumbnail['thumbnail'];
        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }

        // Delete images from the database
        $delete_images_query = "DELETE FROM accommodation_images WHERE accommodation_id = ?";
        $values = [$id_no];
        delete($delete_images_query, $values, 'i');

        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}
