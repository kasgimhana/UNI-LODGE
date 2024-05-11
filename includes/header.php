<nav id="nav-bar" class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
       <a class="navbar-brand me-5 fw-bold fs-3 h1-font" href="index.php">UNI-LODGE</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                 <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="accomodations.php">Accomodations</a>
                </li>
                <li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Contact Us</a>
        </li>
                <li class="nav-item">
          <a class="nav-link me-2" href="about.php">About</a>
        </li>
            </ul>
            

            <div class="d-flex">
                <a href="admin/index.php" class="btn btn-outline-dark shadow-none me-2 role=button">Admin Login</a>
               <!-- Admin Login User name:Theekshana Password:123 -->

                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    echo '<div class="btn-group">';
                    echo '<button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">';
                    echo $_SESSION['uName'];
                    echo '</button>';
                    echo '<ul class="dropdown-menu dropdown-menu-lg-end">';
                    echo '<li><a href="profile.php" class="dropdown-item" type="button">Profile</a></li>';
                    if ($_SESSION['uRole'] === 'warden') {
                        echo '<li><a href="pendingAccommodations.php" class="dropdown-item" type="button">Pending Accommodations</a></li>';
                    } else if ($_SESSION['uRole'] === 'student') {
                        echo '<li><a href="myReservedAccommodations.php" class="dropdown-item" type="button">My Accommodations</a></li>';
                    } else {
                        echo '<li><a href="myAccommodations.php" class="dropdown-item" type="button">My Accommodations</a></li>';
                    }
                    echo '<li><a href="logout.php" class="dropdown-item" type="button">Logout</a></li>';
                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo '<button type="button" class="btn btn-outline-dark shadow-none me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
                    echo '<button type="button" class="btn btn-outline-dark shadow-none me-2" data-bs-toggle="modal" data-bs-target="#confirmationModal">Register</button>';

                    

                    
                }
                ?>

            </div>
        </div>
    </div>
</nav>




<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login-form">
                <div class="modal-header">
                    <i class="bi bi-person-circle fs-3 me-2"></i>
                    <h5 class="modal-title d-flex align-items-center">User Login</h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">password</label>
                        <input type="password" name="password" class="form-control shadow-none" required>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">Login</button>
                        <span onclick="forgot_password()" class="text-secondary text-decoration-none" style="cursor: pointer;">Forgot password?</span>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register-form">
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
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-dark shadow-none">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation dialog modal -->
<div class="modal" tabindex="-1" role="dialog" id="confirmationModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="badge text-bg-light text-wrap lh-base d-block w-100" style="text-align: left; margin-bottom: 0.5rem;">Note: This registration through the website is only for landlords. If you are not a landlord, please contact the university to create your account.</span>

                <p>Are you a landlord?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>
    function forgot_password() {
        alert('Attention', "Contact Admin to reset your password");
    }
</script>