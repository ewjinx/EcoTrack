<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $factoryName = $_POST['factory']; // Get selected factory name from form

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
        // Get factory ID corresponding to the selected factory name
        $factoryIdQuery = "SELECT factoryId FROM factories WHERE name = '$factoryName'";
        $factoryIdResult = mysqli_query($con, $factoryIdQuery);
        if ($factoryIdResult && mysqli_num_rows($factoryIdResult) > 0) {
            $row = mysqli_fetch_assoc($factoryIdResult);
            $factoryId = $row['factoryId'];

            // Insert user data into users table with factoryid
            $sql = "INSERT INTO users (name, username, pw, factoryid, owner) VALUES ('$name', '$username', '$password', '$factoryId', '0')"; // Set owner to 0 for employees
            if (mysqli_query($con, $sql)) {
                $_SESSION['user_id'] = mysqli_insert_id($con);
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $name;
                $_SESSION['factory_id'] = $factoryId;
                $_SESSION['owner'] = 0;

                header("Location: home.php"); // Redirect to home page
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Error: Factory not found";
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
    <title>Employee Sign Up Form</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    <div class="login-form">
        <h1>Employee Sign Up Form</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p><b>Name</b></p>
            <input type="text" name="name" placeholder="Your Name" required>
            <p><b>Username</b></p>
            <input type="text" name="username" placeholder="Username" required>
            <p><b>Password</b></p>
            <input type="password" name="password" placeholder="Password" required>
            <!-- Populate dropdown with factories -->
            <p><b>Select Factory</b></p>
            <select name="factory" required>
                <?php
                // Database connection
                $con = mysqli_connect('localhost', 'root', '', 'ecotrack');
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                // Fetch factories from database
                $sql = "SELECT * FROM factories";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                }
                mysqli_close($con);
                ?>
            </select>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
