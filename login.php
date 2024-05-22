<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $con = mysqli_connect('localhost', 'root', '', 'ecotrack');

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user data from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['pw']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['factory_id'] = $row['factoryId'];
            $_SESSION['owner'] = $row['owner'];
            header("Location: home.php"); // Redirect to home page
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "User not found";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Employee Login</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="login-form">
        <h1>Employee Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p><b>Username</b></p>
            <input type="text" name="username" placeholder="Username" required>
            <p><b>Password</b></p>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
