<?php
include '../admin/db_config.php';
include '../admin/essentials.php';


if (isset($_POST['register'])) {
    $data = filteration($_POST);

    // Checking for password match
    if ($data['password'] != $data['confirm_password']) {
        echo 'password_mismatch';
        exit;
    }

    // checking whether user exists
    $query = select("SELECT * FROM `users` WHERE `email` = ? LIMIT 1", [$data['email']], "s");

    if (mysqli_num_rows($query) != 0) {
        echo ("already_exits");
        exit;
    }
    $enc_password = password_hash($data['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO `users`(`name`, `email`, `phone_number`, `secondary_phone_number`, `address`, `password`, `role`) VALUES (?,?,?,?,?,?,?)";
    $values = [$data['name'], $data['email'], $data['phone_number'], $data['secondary_phone_number'], $data['address'], $enc_password, "landlord"];

    if (insert($query, $values, 'sssssss')) {
        echo 1;
    } else {
        echo 'register_failed';
    }
}

if (isset($_POST['login'])) {
    $data = filteration($_POST);

    // checking whether user exists
    $query = select("SELECT * FROM `users` WHERE `email` = ? LIMIT 1", [$data['email']], "s");

    if (mysqli_num_rows($query) == 0) {
        echo 'user-not-found';
        exit;
    } else {
        $user = mysqli_fetch_assoc($query);

        if ($user['status'] == 0) {
            echo 'inactive';
            exit;
        } else if (!password_verify($data['password'], $user['password'])) {
            echo 'invalid-password';
            exit;
        } else {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['uId'] = $user['id_no'];
            $_SESSION['uName'] = $user['name'];
            $_SESSION['uEmail'] = $user['email'];
            $_SESSION['uAddress'] = $user['address'];
            $_SESSION['uTelNum_1'] = $user['phone_number'];
            $_SESSION['uTelNum_2'] = $user['secondary_phone_number'];
            $_SESSION['uRole'] = $user['role'];
            echo 1;
        }
    }
}
