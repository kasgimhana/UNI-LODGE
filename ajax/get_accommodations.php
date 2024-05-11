<?php
function getAccommodations()
{
    // Check if uRole session is 'warden'
    $sql = "SELECT a.*, GROUP_CONCAT(ai.image_path) AS image_paths
            FROM accommodations a
            LEFT JOIN accommodation_images ai ON a.id_no = ai.accommodation_id
            WHERE a.status = 1
            GROUP BY a.id_no";
    $result = select($sql);

    $accommodations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $images = explode(",", $row['image_paths']);
        $userId = $row['uid'];
        
        $phoneNumbers = getUserPhoneNumbers($userId);

        $accommodations[] = [
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
            'images' => $images,
            'reserved' => $row['reserved'],
            'status' => $row['status'],
            'phoneNumbers' => $phoneNumbers,
        ];
    }
    return $accommodations;
}

function getUserPhoneNumbers($userId)
{
    $sql = "SELECT phone_number, secondary_phone_number FROM users WHERE id_no = ?";
    $values = [$userId];
    $data_types = 'i'; 

    $result = select($sql, $values, $data_types);
    return $result->fetch_assoc(); 
}