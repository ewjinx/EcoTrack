<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'ecotrack');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if username already exists
    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($con, $check_username_query);
    if (mysqli_num_rows($check_username_result) > 0) {
        // Username already exists, display error message
        echo "Username already taken";
    } else {
        // Proceed with user registration process
        $factoryCountQuery = "SELECT COUNT(*) AS total FROM factories";
        $factoryCountResult = mysqli_query($con, $factoryCountQuery);
        if ($factoryCountResult && mysqli_num_rows($factoryCountResult) > 0) {
            $row = mysqli_fetch_assoc($factoryCountResult);
            $factoryId = $row['total'] + 1; // Increment total count for next factoryid
        } else {
            $factoryId = 1; // Default to 1 if no factories exist yet
        }

        $_SESSION['factory_id'] = $factoryId;

        // Insert user data into users table with auto-incremented factoryid
        $sql = "INSERT INTO users (name, username, pw, factoryid, owner) VALUES ('$name', '$username', '$password', '$factoryId', '1')"; // Set owner to 1 for factory signup
        if (mysqli_query($con, $sql)) {
            $_SESSION['user_id'] = mysqli_insert_id($con);
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['owner'] = 1;
            $_SESSION['factory_id'] = $row['factoryId'];


            header("Location: factoriessignup.php"); // Redirect to factory signup page
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sign Up Form</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="login-form">
        <h1>Sign Up Form</h1>
        <form action="signupfo.php" method="post">
            <p><b>Name</b></p>
            <input type="text" name="name" placeholder="Your Name" required>
            <p><b>Username</b></p>
            <input type="text" name="username" placeholder="Username" required>
            <p><b>Password</b></p>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Next</button>
        </form>
    </div>
</body>
</html>
