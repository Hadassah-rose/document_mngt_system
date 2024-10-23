<?php
// Database connection
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $regno = $_POST['regno'];

    // Directory to store uploaded files
    $targetDirectory = "uploads/";

    // Handle Sales Agreement file upload
    if (!empty($_FILES["salesAgreement"]["name"])) {
        $salesAgreementPath = $targetDirectory . basename($_FILES["salesAgreement"]["name"]);
        move_uploaded_file($_FILES["salesAgreement"]["tmp_name"], $salesAgreementPath);
    } else {
        $salesAgreementPath = NULL;
    }

    // Handle Logbook file upload
    if (!empty($_FILES["logbook"]["name"])) {
        $logbookPath = $targetDirectory . basename($_FILES["logbook"]["name"]);
        move_uploaded_file($_FILES["logbook"]["tmp_name"], $logbookPath);
    } else {
        $logbookPath = NULL;
    }

    // Handle Receipt file upload
    if (!empty($_FILES["receipt"]["name"])) {
        $receiptPath = $targetDirectory . basename($_FILES["receipt"]["name"]);
        move_uploaded_file($_FILES["receipt"]["tmp_name"], $receiptPath);
    } else {
        $receiptPath = NULL;
    }

    // Insert the data into the database
    $sql = "INSERT INTO customers (regno, salesagreement, logbook, receipt) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $regno, $salesAgreementPath, $logbookPath, $receiptPath);

    if ($stmt->execute()) {
        echo "Car registration details saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER CAR</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/managerlogin.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>Fourways<span>Automobile.</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="register.php">Register Car</a></li>
                    <li><a href="customerdetails.php">View details</a></li>



                </ul>
            </nav><!-- .navbar -->

            <a class="btn-book-a-table" href="#">Welcome</a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->


    <br><br><br>

    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
        <div class="col-md-5 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading"> Register Car </div>
                <div class="panel-body">

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="regno"><span class="text-danger" style="margin-right: 5px;">*</span>
                                    Reg No: </label>
                                <div class="input-group">
                                    <input class="form-control" id="regno" type="text" name="regno"
                                        placeholder="Car Reg No" required="" autofocus="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-user"
                                                aria-hidden="true"></label>
                                    </span>

                                </div>

                            </div>
                        </div>


                        <!-- Add this inside your form -->

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="logbook">Logbook: </label>
                                <div class="input-group">
                                    <input type="file" name="logbook" id="logbook" accept="image/*,.pdf">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-upload"
                                                aria-hidden="true"></span></label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="salesAgreement">Sales Agreement: </label>
                                <div class="input-group">
                                    <input type="file" name="salesAgreement" id="salesAgreement" accept="image/*,.pdf">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-upload"
                                                aria-hidden="true"></span></label>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="receipt">ID NO/KRA PIN: </label>
                                <div class="input-group">
                                    <input type="file" name="receipt" id="receipt" accept="image/*,.pdf">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-upload"
                                                aria-hidden="true"></span></label>
                                    </span>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-xs-4">
                                <button class="btn btn-primary" id="button" type="submit" value="signup">Submit</button>
                            </div>

                        </div>



                    </form>

                </div>

            </div>

        </div>
    </div>


    <style>
        body {
            background-image: url("assets/img/isuzu.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>



</body>

</html>