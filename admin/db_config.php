<?php
$hostName = 'localhost';
$username = 'root';
$password = '';

$connection = mysqli_connect($hostName, $username, $password);

if (!$connection) {
    die("Cannot Connect to Database" . mysqli_connect_error());
}

// Create the database if it doesn't exist
$database = 'nsbm_accommodation';
$query = "CREATE DATABASE IF NOT EXISTS $database";

if (!mysqli_query($connection, $query)) {
    die("Error creating database: " . mysqli_error($connection));
}

// Select the database
mysqli_select_db($connection, $database);


function filteration($data)
{
    foreach ($data as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        $data[$key] = $value;
    }
    return $data;
}

function select($sql, $values = [], $data_types = '')
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        if (!empty($values)) {
            mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        }
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - SELECT");
        }
    } else {
        die("Query cannot be prepared - SELECT");
    }
}

function update($sql, $values, $data_types)
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - UPDATE");
        }
    } else {
        die("Query cannot be prepared - UPDATE");
    }
}

function insert($sql, $values, $data_types)
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - INSERT");
        }
    } else {
        die("Query cannot be prepared - INSERT");
    }
}

function delete($sql, $values, $data_types)
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - DELETE");
        }
    } else {
        die("Query cannot be prepared - DELETE");
    }
}

function selectSingle($query, $values, $data_types)
{
    global $connection;
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, $data_types, ...$values);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row;
}

$create_tables_query = "
CREATE TABLE IF NOT EXISTS `settings` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `site_title` varchar(50) NOT NULL DEFAULT 'Not Set',
    `site_about` varchar(500) NOT NULL DEFAULT 'Not Set',
    `shutdown` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id_no`)
  );

  INSERT INTO `settings` (`site_title`, `site_about`, `shutdown`) VALUES ('Not Set', 'Not Set', 0);

  CREATE TABLE IF NOT EXISTS `contact_details` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `address` varchar(100) NOT NULL DEFAULT 'Not Set',
    `googleMap` varchar(100) DEFAULT 'Not Set',
    `phone_number_1` bigint(10) NOT NULL DEFAULT 0000000000,
    `phone_number_2` bigint(10) NOT NULL DEFAULT 0000000000,
    `email` varchar(200) NOT NULL DEFAULT 'Not Set',
    `facebook` varchar(100) NOT NULL DEFAULT 'Not Set',
    `instagram` varchar(100) NOT NULL DEFAULT 'Not Set',
    `twitter` varchar(100) NOT NULL DEFAULT 'Not Set',
    `iframe` varchar(300) NOT NULL DEFAULT 'Not Set',
    PRIMARY KEY (`id_no`)
);

INSERT INTO `contact_details` (`address`, `googleMap`, `phone_number_1`, `phone_number_2`, `email`, `facebook`, `instagram`, `twitter`, `iframe`)
VALUES ('Not Set', 'Not Set', 0000000000, 0000000000, 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4047213.2839410105!2d80.70625!3d7.857684999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2593cf65a1e9d%3A0xe13da4b400e2d38c!2sSri%20Lanka!5e0!3m2!1sen!2slk!4v1710822734078!5m2!1sen!2slk');


CREATE TABLE IF NOT EXISTS `admin_credentials` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `admin_username` varchar(50) NOT NULL,
    `admin_password` varchar(50) NOT NULL,
    PRIMARY KEY (`id_no`)
  );

  CREATE TABLE IF NOT EXISTS `users` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(200) NOT NULL,
    `phone_number` varchar(100) NOT NULL,
    `secondary_phone_number` varchar(100) NOT NULL,
    `address` varchar(120) NOT NULL,
    `password` varchar(200) NOT NULL,
    `status` int(11) NOT NULL DEFAULT 1,
    `role` varchar(100) NOT NULL,
    `dateTime` datetime NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id_no`)
  );

  CREATE TABLE IF NOT EXISTS `articles` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `article_title` varchar(100) NOT NULL,
    `article_content` varchar(500) NOT NULL,
    PRIMARY KEY (`id_no`)
  );

  CREATE TABLE IF NOT EXISTS `accommodations` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(200) NOT NULL,
    `description` varchar(500) NOT NULL,
    `address` varchar(255) NOT NULL,
    `thumbnail` varchar(255) NOT NULL,
    `bathrooms` int(11) NOT NULL,
    `kitchens` int(11) NOT NULL,
    `rooms` int(11) NOT NULL,
    `beds` int(11) NOT NULL,
    `price` decimal(10,0) NOT NULL,
    `capacity` int(11) NOT NULL,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `message` varchar(200) DEFAULT NULL,
    `lon` varchar(250) NOT NULL,
    `lat` varchar(250) NOT NULL,
    `uid` int(11) NOT NULL,
    `reserved` int(11) NOT NULL DEFAULT -1,
    PRIMARY KEY (`id_no`),
    KEY `uid` (`uid`),
    CONSTRAINT `accommodations_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id_no`)
  );

  CREATE TABLE IF NOT EXISTS `accommodation_images` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `accommodation_id` int(11) NOT NULL,
    `image_path` varchar(255) NOT NULL,
    PRIMARY KEY (`id_no`),
    KEY `accommodation_id` (`accommodation_id`),
    CONSTRAINT `accommodation_images_ibfk_1` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id_no`) ON DELETE CASCADE
  );

  CREATE TABLE IF NOT EXISTS `bookings` (
    `id_no` int(11) NOT NULL AUTO_INCREMENT,
    `accommodation_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`id_no`),
    KEY `accommodation_id` (`accommodation_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id_no`),
    CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_no`)
  );

";

mysqli_multi_query($connection, $create_tables_query);

while (mysqli_next_result($connection)) {
    if (!mysqli_more_results($connection)) {
        break;
    }
}
