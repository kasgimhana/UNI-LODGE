<footer class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <a class="navbar-brand me-5 fw-bold fs-3 h1-font" href="index.php">UNI-LODGE</a>
            <p>NSBM Green University is the first ever green university in South Asia and sets an example for the whole South Asia by paving the way for environmental sustainability. The university is open for both national and international student community and it has turned a new chapter in Sri Lankan higher education.</p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="Accomodations.php" class="d-inline-block mb-2 text-dark text-decoration-none">Accomodations</a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About Us</a>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow Us</h5>

            <?php
            if ($contacts_result['twitter'] != '') {
                echo <<<data
            <a target="_blank" href="$contacts_result[twitter]" class="d-inline-block mb-2 text-dark text-decoration-none"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-twitter me-1"></i>Twitter</span></a><br>
            data;
            }

            if ($contacts_result['facebook'] != '') {
                echo <<<data
              <a target="_blank" href="$contacts_result[facebook]" class="d-inline-block mb-2 text-dark text-decoration-none"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-facebook me-1"></i>Facebook</span></a><br>
              data;
            }

            if ($contacts_result['instagram'] != '') {
                echo <<<data
              <a target="_blank" href="$contacts_result[instagram]" class="d-inline-block mb-2 text-dark text-decoration-none"><span class="badge bg-light text-dark fs-6 p-2"> <i class="bi bi-instagram me-1"></i>Instagram</span></a>
              data;
            }
            ?>
        </div>
    </div>
</footer>


<h6 class="text-center bg-dark text-white p-3 m-0">Design and Developed by NSBM Students group(BW)</h6>
