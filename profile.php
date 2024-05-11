<!DOCTYPE html>
<html lang="en">
<head>
    <title>Uni-Lodge- About Us</title>
    <!-- CSS only -->
<?php include 'includes/links.php'; ?>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>
<link rel="stylesheet" type="text/css" href="includes/style.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<style>
  .box{
    border-top-color: var(--teal) !important;
  }
</style>

</head>

<body class="bg-light">
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- User Profile -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://media.istockphoto.com/id/1223671392/vector/default-profile-picture-avatar-photo-placeholder-vector-illustration.jpg?s=612x612&w=0&k=20&c=s0aTdmT5aU6b8ot7VKm11DeID6NctRCpB755rA1BIP0=" class="rounded-circle" alt="Profile Picture" style="width: 150px; height: 150px;">
                        </div>
                        <div class="mt-3">
                            <p><strong>Name:</strong> <?php echo  $_SESSION['uName']; ?></p>
                            <p><strong>Email:</strong> <?php echo  $_SESSION['uEmail']; ?></p>
                            <p><strong>Address:</strong> <?php echo             $_SESSION['uAddress']; ?></p>
                            <p><strong>Telephone Number 1:</strong> <?php echo  $_SESSION['uTelNum_1']; ?></p>
                            <p><strong>Telephone Number 2:</strong> <?php echo  $_SESSION['uTelNum_1']; ?></p>
                            <p><strong>Role:</strong> <?php echo  $_SESSION['uRole'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <?php include 'includes/scripts.php'; ?>
</body>

</html>