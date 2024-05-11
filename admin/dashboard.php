<?php
include 'essentials.php';
include 'ajax/stats.php';
adminLogin();

$studentCount = getStudentCount();
$landlordCount = getLandlordCount();
$wardenCount = getWardenCount();
$totalAccommodations = getTotalAccommodations();
$reservedAccommodations = getReservedAccommodations();
$availableAccommodations = getAvailableAccommodations();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel : Dashboard</title>
    <?php include 'links.php'; ?>
</head>

<body class="bg-light">

    <?php include 'header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Number of Students</h5>
                                <p class="card-text"><?php echo $studentCount ?></p>
                            </div>
                        </div>
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Number of Landlords</h5>
                                <p class="card-text"><?php echo $landlordCount  ?></p>
                            </div>
                        </div>
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Number of Wardens</h5>
                                <p class="card-text"><?php echo $wardenCount  ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Accommodations</h5>
                                <p class="card-text"><?php echo $totalAccommodations ?></p>
                            </div>
                        </div>
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Reserved Accommodations</h5>
                                <p class="card-text"><?php echo $reservedAccommodations ?></p>
                            </div>
                        </div>
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Available Accommodations</h5>
                                <p class="card-text"><?php echo $availableAccommodations ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include 'scripts.php'; ?>
</body>

</html>