<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$factory_id = $_SESSION['factory_id'];


error_reporting(E_ALL);
ini_set('display_errors', 1);

// database connection code
if (isset($_POST['date'])) {
    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'ecotrack');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the post records
    $date = $_POST['date'];
    $consumption = $_POST['consumed'];
    $factor = $_POST['factor'];
    $points = (50 + (0.6 * ($consumption - 100) / (500 - 100) + 0.4 * ($factor / 100)) * 50) + 50;

    // Database insert SQL code
    $sql = "INSERT INTO `energy` (`factoryId`, `date`, `consumption`, `factor`, `points`) VALUES ('$factory_id', '$date', '$consumption', '$factor', '$points')";

    // Insert in database
    if (mysqli_query($con, $sql)) {
        echo "Energy record inserted successfully.<br>";

        // Update total points in factories table
        $sql_update_factory = "UPDATE factories SET points = points + '$points' WHERE factoryId = '$factory_id'";
        if (mysqli_query($con, $sql_update_factory)) {
            echo "Factory points updated successfully.<br>";
            $_SESSION['message'] = "Energy Records Inserted and Factory Points Updated";
        } else {
            echo "Error updating factory points: " . mysqli_error($con) . "<br>";
            $_SESSION['message'] = "Error updating factory points: " . mysqli_error($con);
        }
    } else {
        echo "Error inserting energy record: " . mysqli_error($con) . "<br>";
        $_SESSION['message'] = "Error inserting energy record: " . mysqli_error($con);
    }

    // Close connection
    mysqli_close($con);

    // Redirect back to the form page
    header("Location: enterenergy.php");
    exit();
} else {
    echo "No data submitted";
}
?>
