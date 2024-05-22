<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$factory_id = $_SESSION['factory_id'];

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'ecotrack');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT SUM(points) AS total_points FROM waste WHERE factoryId = '$factory_id'";
$result = mysqli_query($con, $sql);

// Get total points
$total_points = 0;
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_points = $row['total_points'];
}

// Fetch waste generation data for the user's factory
$sql = "SELECT * FROM waste WHERE factoryId = '$factory_id' ORDER BY date DESC";
$result = mysqli_query($con, $sql);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Generation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Form -->
    <div class="container" style="margin-top: 100px;">
        <h2 class="mt-4" style="padding-bottom: 1rem; text-align: center;">Wasted Generation Data</h2>
        <div class="table-responsive"> <!-- Add a responsive wrapper for tables -->
            <table class="table table-striped table-bordered">
                <thead class="table-primary"> <!-- Dark table header -->
                    <tr>
                        <th>Date</th>
                        <th>Waste Generated (tons)</th>
                        <th>Efficiency Factor (%)</th>
                        <th>Carbon Footprint Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['waste_generated'] . "</td>";
                            echo "<td>" . $row['factor'] . "</td>";
                            echo "<td>" . $row['points'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No data available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div style="padding-top: 30px;"class="text-center">
            <h5>Total Points: <?php echo $total_points; ?></h5>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
