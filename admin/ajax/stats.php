<?php

include "./db_config.php";

function getStudentCount()
{
    $query = "SELECT COUNT(*) AS student_count FROM users WHERE role = 'student'";
    $res = select($query);
    $row = mysqli_fetch_assoc($res);
    return $row['student_count'];
}

function getLandlordCount()
{
    $query = "SELECT COUNT(*) AS landlord_count FROM users WHERE role = 'landlord'";
    $res = select($query);
    $row = mysqli_fetch_assoc($res);
    return $row['landlord_count'];
}

function getWardenCount()
{
    $query = "SELECT COUNT(*) AS warden_count FROM users WHERE role = 'warden'";
    $res = select($query);
    $row = mysqli_fetch_assoc($res);
    return $row['warden_count'];
}

function getTotalAccommodations()
{
    $query = "SELECT COUNT(*) AS accommodation_count FROM accommodations";
    $res = select($query);
    $row = mysqli_fetch_assoc($res);
    return $row['accommodation_count'];
}


function getReservedAccommodations()
{
    $query = "SELECT COUNT(*) AS reserved_count FROM accommodations WHERE reserved IS NOT NULL";
    $res = select($query);
    $row = mysqli_fetch_assoc($res);
    return $row['reserved_count'];
}

function getAvailableAccommodations()
{
    $query = "SELECT COUNT(*) AS available_count FROM accommodations WHERE reserved IS NULL";
    $res = select($query);
    $row = mysqli_fetch_assoc($res);
    return $row['available_count'];
}


