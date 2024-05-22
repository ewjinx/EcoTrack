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
    $generated = $_POST['generated'];
    $factor = $_POST['factor'];
    $points = (50 + (0.6 * ($waste_generated - 100) / (500 - 100) + 0.4 * ($factor / 100)) * 50) + 50;

    // Database insert SQL code
    $sql = "INSERT INTO `waste` (`factoryId`, `date`, `waste_generated`, `factor`, `points`) VALUES ('$factory_id', '$date', '$generated', '$factor', '$points')";

    if (mysqli_query($con, $sql)) {
        echo "Waste record inserted successfully.<br>";

        // Update total points in factories table
        $sql_update_factory = "UPDATE factories SET points = points + '$points' WHERE factoryId = '$factory_id'";
        if (mysqli_query($con, $sql_update_factory)) {
            echo "Factory points updated successfully.<br>";
            $_SESSION['message'] = "Waste Records Inserted and Factory Points Updated";
        } else {
            echo "Error updating factory points: " . mysqli_error($con) . "<br>";
            $_SESSION['message'] = "Error updating factory points: " . mysqli_error($con);
        }
    } else {
        echo "Error inserting Waste record: " . mysqli_error($con) . "<br>";
        $_SESSION['message'] = "Error inserting Waste record: " . mysqli_error($con);
    }

    // Close connection
    mysqli_close($con);

    // Redirect back to the form page
    header("Location: enterwaste.php");
    exit();
} else {
    echo "No data submitted";
}
?>
