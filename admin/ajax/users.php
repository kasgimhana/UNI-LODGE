<?php
include '../essentials.php';
include '../db_config.php';
adminLogin();

if (isset($_POST['get_all_users'])) {
    $query = "SELECT * FROM `users`";
    $res = select($query);

    $data = "";
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        $userId = $row['id_no'];
        $statusText = $row['status'] ? 'active' : 'inactive';
        $statusBtnClass = $row['status'] ? 'btn-dark' : 'btn-danger';
        $statusBtnText = $row['status'] ? 'Active' : 'Inactive';

        echo "
        <tr>
            <td>$i</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone_number']}</td>
            <td>{$row['secondary_phone_number']}</td>
            <td>{$row['address']}</td>
            <td>{$row['role']}</td>
            <td>
                <button class='btn btn-sm shadow-none $statusBtnClass'>$statusBtnText</button>
            </td>
            <td>{$row['dateTime']}</td>
        </tr>";
        $i++;
    }
}


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
    $values = [$data['name'], $data['email'], $data['phone_number'], $data['secondary_phone_number'], $data['address'], $enc_password, $data['role']];

    if (insert($query, $values, 'sssssss')) {
        echo 1;
    } else {
        echo 'register_failed';
    }
}
