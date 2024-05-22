<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $factory_name = $_POST['name'];
    $address = $_POST['address'];
    $factory_id = $_SESSION['factory_id']; // Get factory ID from session
    $user_id = $_SESSION['user_id']; // Get user ID from session (factory owner)


    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'ecotrack');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert factory data into factories table
    $sql = "INSERT INTO factories (name, address, factoryid, owner) VALUES ('$factory_name', '$address', '$factory_id', '$user_id')";
    if (mysqli_query($con, $sql)) {
        $_SESSION['factory_id'] = $factoryId;
        header("Location: home.php"); // Redirect to the main page or dashboard
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Factory Information</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="login-form">
        <h1>Factory Information</h1>
        <form action="factoriessignup.php" method="post">
            <p><b>Factory Name</b></p>
            <input type="text" name="name" placeholder="Factory Name" required>
            <p><b>Address</b></p>
            <input type="text" name="address" placeholder="123 Street" required>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
