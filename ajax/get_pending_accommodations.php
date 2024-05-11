<?php
function getPendingAccommodations()
{
    // Check if uRole session is 'warden'
    if (isset($_SESSION['uRole']) && $_SESSION['uRole'] == 'warden') {
        $sql = "SELECT a.*, GROUP_CONCAT(ai.image_path) AS image_paths
                FROM accommodations a
                LEFT JOIN accommodation_images ai ON a.id_no = ai.accommodation_id
                WHERE a.status = '0'
                GROUP BY a.id_no";
        $result = select($sql);

        $pendingAccommodations = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $images = explode(",", $row['image_paths']);
            $pendingAccommodations[] = [
                'id_no' => $row['id_no'],
                'name' => $row['name'],
                'description' => $row['description'],
                'lon' => $row['lon'],
                'lat' => $row['lat'],
                'address' => $row['address'],
                'thumbnail' => $row['thumbnail'],
                'bathrooms' => $row['bathrooms'],
                'kitchens' => $row['kitchens'],
                'rooms' => $row['rooms'],
                'beds' => $row['beds'],
                'price' => $row['price'],
                'capacity' => $row['capacity'],
                'uId' => $row['uid'],
                'images' => $images
            ];
        }
        return $pendingAccommodations;
    } else {
        // Redirect to index.php and destroy session
        header("Location: index.php");
        session_destroy();
        exit();
    }
}
