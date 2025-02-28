<?php
session_start();
include("connect.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted 
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        // Read from the database
        $query = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            // Verify the hashed password
            if (password_verify($password, $user_data['password'])) {
                // Password is correct, set session and redirect to dashboard
                $_SESSION['email'] = $user_data['email'];
                header("Location: register.php");
                die;
            }
        }
        echo "Invalid password or email";
    } else {
        echo "Invalid information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login Page</title>
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




                </ul>
            </nav><!-- .navbar -->

            <a class="btn-book-a-table" href="index.php">Welcome</a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->

    <br><br> <br><br><br>


    <div class="container" style="margin-top: 4%; margin-bottom: 2%;">
        <div class="col-md-5 col-md-offset-4">
            <label style="margin-left: 5px;color: red;"><span> </span></label>
            <div class="panel panel-primary">
                <div class="panel-heading"> Login </div>
                <div class="panel-body">

                    <form action="" method="POST">

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="email"><span class="text-danger" style="margin-right: 5px;">*</span> Email:
                                </label>
                                <div class="input-group">
                                    <input class="form-control" id="email" type="text" name="email" placeholder="email"
                                        required="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-phone"
                                                aria-hidden="true"></span></label>
                                    </span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span>
                                    Password: </label>
                                <div class="input-group">
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Password" required="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="togglePassword">
                                            <span id="toggleIcon" class="glyphicon glyphicon-eye-open"
                                                aria-hidden="true"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-4">
                                <button class="btn btn-primary" id="button" name="submit" type="submit"
                                    value=" Login ">Submit</button>
                            </div>

                        </div>


                        <label style="margin-left: 5px;"><a href="adminsignup.php">Create a new account.</a></label>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            background-image: url("assets/img/isuzu.jpeg");
            background-size: cover;
        }
    </style>
    <script>
        // Function to toggle password visibility
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('glyphicon-eye-open');
                toggleIcon.classList.add('glyphicon-eye-close');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('glyphicon-eye-close');
                toggleIcon.classList.add('glyphicon-eye-open');
            }
        }

        // Add event listener to the toggle button
        document.getElementById('togglePassword').addEventListener('click', togglePassword);
    </script>


</body>

</html>