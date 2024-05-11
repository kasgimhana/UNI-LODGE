<?php
include 'essentials.php';
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel : Users</title>
    <?php include 'links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3>Users</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="bi bi-person-add"></i>
                                Add User
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width: 1300px;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Secondary phone Number</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="users-data"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Data Modal -->
    <div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="add-new-user-form">
                    <div class="modal-header">
                        <i class="bi bi-person-vcard-fill fs-3 me-2"></i>
                        <h5 class="modal-title d-flex align-items-center">User Registration</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge text-bg-light mb-3 text-wrap lh-base">Note: Your details will be verified after entered </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input name="phone_number" type="number" class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Secondary Phone Number</label>
                                    <input name="secondary_phone_number" type="number" class="form-control shadow-none">
                                </div>

                                <div class="col-md-12 p-0 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                                </div>

                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control shadow-none" required>
                                </div>

                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input name="confirm_password" type="password" class="form-control shadow-none" required>
                                </div>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select shadow-none" required>
                                    <option value="" selected disabled>Select Role</option>
                                    <option value="landlord">Landlord</option>
                                    <option value="student">Student</option>
                                    <option value="warden">Warden</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" class="btn btn-dark shadow-none">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="users.js"></script>
    <?php include 'scripts.php'; ?>
</body>

</html>