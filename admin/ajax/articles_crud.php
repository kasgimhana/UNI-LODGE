<?php
include '../essentials.php';
include '../db_config.php';
adminLogin();

if (isset($_POST['get_article_data'])) {
    $query = "SELECT * FROM `articles`";
    $res = select($query);

    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }

    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['update_article_data'])) {
    $form_data = filteration($_POST);
    $query = "UPDATE `articles` SET `article_title`=?, `article_content`=? WHERE `id_no`=?";
    $values = [$form_data['article_title'], $form_data['article_content'], $form_data['id_no']];
    $res = update($query, $values, 'ssi');
    echo $res;
}

if (isset($_POST['add_new_article'])) {
    $form_data = filteration($_POST);
    $query = "INSERT INTO `articles` (`article_title`, `article_content`) VALUES (?, ?)";
    $values = [$form_data['article_title'], $form_data['article_content']];
    $res = update($query, $values, 'ss');
    echo $res;
}

if (isset($_POST['delete_article'])) {
    $form_data = filteration($_POST);
    $query = "DELETE FROM `articles` WHERE `id_no`=?";
    $values = [$form_data['id_no']];
    $res = update($query, $values, 'i');
    echo $res;
}
