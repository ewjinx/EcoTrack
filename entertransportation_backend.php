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

// Check if form was submitted
if (isset($_POST['date'])) {
    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'ecotrack');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the post records
    $date = $_POST['date'];
    $distance = $_POST['distance'];
    $points = 50 - (0.01 * $distance);

    // Database insert SQL code for transportation
    $sql_transport = "INSERT INTO `transportation` (`factoryId`, `date`, `distance`, `points`) VALUES ('$factory_id', '$date', '$distance', '$points')";

    // Insert into database and update factories table
    if (mysqli_query($con, $sql_transport)) {
        echo "Transportation record inserted successfully.<br>";

        // Update total points in factories table
        $sql_update_factory = "UPDATE factories SET points = points + '$points' WHERE factoryId = '$factory_id'";
        if (mysqli_query($con, $sql_update_factory)) {
            echo "Factory points updated successfully.<br>";
            $_SESSION['message'] = "Transportation Records Inserted and Factory Points Updated";
        } else {
            echo "Error updating factory points: " . mysqli_error($con) . "<br>";
            $_SESSION['message'] = "Error updating factory points: " . mysqli_error($con);
        }
    } else {
        echo "Error inserting transportation record: " . mysqli_error($con) . "<br>";
        $_SESSION['message'] = "Error inserting transportation record: " . mysqli_error($con);
    }

    // Close connection
    mysqli_close($con);

    // Redirect back to the form page
    header("Location: entertransportation.php");
    exit();
} else {
    echo "No data submitted";
}
?>
