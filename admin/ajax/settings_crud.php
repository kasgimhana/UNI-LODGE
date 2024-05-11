<?php
include '../essentials.php';
include '../db_config.php';
adminLogin();

if (isset($_POST['get_general_data'])) {
    $query = "SELECT * FROM `settings` WHERE `id_no`=?";
    $values = [1];
    $res = select($query, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['update_general_data'])) {
    $form_data = filteration($_POST);
    $query = "UPDATE `settings` SET `site_title`=?, `site_about`=? WHERE `id_no`=?";
    $values = [$form_data['site_title'], $form_data['site_about'], 1];
    $res = update($query, $values, 'ssi');
    echo $res;
}

if (isset($_POST['update_shutdown'])) {
    $form_data = ($_POST['update_shutdown'] == 0) ? 1 : 0 ;
    $query = "UPDATE `settings` SET `shutdown`=? WHERE `id_no`=?";
    $values = [$form_data, 1];
    $res = update($query, $values, 'ii');
    echo $res;
}

if (isset($_POST['get_contacts_data'])) {
    $query = "SELECT * FROM `contact_details` WHERE `id_no`=?";
    $values = [1];
    $res = select($query, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['update_contacts_data'])) {
    $form_data = filteration($_POST);
    $query = "UPDATE `contact_details` SET `address`=?,`googleMap`=?,`phone_number_1`=?,`phone_number_2`=?,`email`=?,`facebook`=?,`instagram`=?,`twitter`=?,`iframe`=? WHERE `id_no`=?";
    $values = [$form_data['address'], $form_data['googleMap'], $form_data['phone_number_1'], $form_data['phone_number_2'], $form_data['email'], $form_data['facebook'], $form_data['instagram'], $form_data['twitter'], $form_data['iframe'], 1];
    $res = update($query, $values, 'sssssssssi');
    echo $res;
}

