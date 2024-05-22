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

// Fetch total distance traveled and total points for each day
$sql = "SELECT date, SUM(distance) AS total_distance, SUM(points) AS total_points FROM transportation WHERE factoryId = '$factory_id' GROUP BY date ORDER BY date DESC";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportation Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        form {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto; /* Center the form horizontally */
            margin-top: 20px; /* Add some space between navbar and form */
        }

        label {
            font-weight: bold;
        }

        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Form -->
    <div class="container" style="margin-top: 100px;">
        <h2 class="mt-4" style="padding-bottom: 1rem; text-align: center;">Transportation Data</h2>
        <div class="table-responsive"> <!-- Add a responsive wrapper for tables -->
            <table class="table table-striped table-bordered">
                <thead class="table-primary"> <!-- Dark table header -->
                    <tr>
                        <th>Date</th>
                        <th>Total Kilometers</th>
                        <th>Total Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['total_distance'] . "</td>";
                            echo "<td>" . $row['total_points'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Debugging output to check the query result
                       
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
