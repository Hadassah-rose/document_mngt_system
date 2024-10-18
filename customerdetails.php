<?php
// Database connection
include("connect.php");

$searchTerm = '';

// Check if a search term is submitted
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
}

// Fetch customer records based on the search term (if provided)
$sql = "SELECT id, regno, salesagreement, logbook, receipt FROM customers";
if (!empty($searchTerm)) {
    $sql .= " WHERE regno LIKE ?";
}

$stmt = $con->prepare($sql);

if (!empty($searchTerm)) {
    $searchTerm = "%{$searchTerm}%";
    $stmt->bind_param("s", $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

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
                <h1>Fourways<span>Automobile.</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="register.php">Register Car</a></li>
                    <li><a href="customerdetails.php">View details</a></li>
                </ul>
            </nav>
            <a class="btn-book-a-table" href="#">Welcome</a>
        </div>
    </header><!-- End Header -->

    <br><br><br><br><br>

    <!-- Search Form -->
    <div class="container">
        <form method="POST" action="" class="form-inline mb-3">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search by Reg No"
                value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Display Customer Records -->
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reg No</th>
                            <th>Sales Agreement</th>
                            <th>Logbook</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['regno']}</td>
                        <td><a href='{$row['salesagreement']}'>View Sales Agreement</a></td>
                        <td><a href='{$row['logbook']}'>View Logbook</a></td>
                        <td><a href='{$row['receipt']}'>View Receipt</a></td>
                    </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>No customer details found.</p>";
        }

        // Close the statement and the database connection
        $stmt->close();
        $con->close();
        ?>
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