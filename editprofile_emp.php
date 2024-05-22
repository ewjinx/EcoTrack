<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'ecotrack');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve user's existing profile data
$sql = "SELECT * FROM users WHERE Id = $user_id";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $username = $row['username'];
    // You might want to retrieve other user profile data here
} else {
    // Handle error if user data is not found
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $new_name = $_POST['name'];
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    // Update user profile in the database
    $update_sql = "UPDATE users SET name = '$new_name', username = '$new_username', pw = '$new_password' WHERE Id = $user_id";

    if (mysqli_query($con, $update_sql)) {
        $_SESSION['name'] = $new_name;
        $_SESSION['message'] = "Profile updated successfully";
        header("Location: editprofile_emp.php");
        exit();
    } else {
        // Handle error if update fails
    }


}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
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

        input[type="password"],
        input[type="text"],
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
<?php include 'navbar.php'; ?>
<?php
if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-dismissible alert-success" style="margin-top: 5px;">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>' . $_SESSION['message'] . '</strong>
              </div>';
        unset($_SESSION['message']);
    }
?>

<div class="container" style="margin-top: 100px;">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2 class="mt-4">Edit User Profile</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required placeholder="Full Name">

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required placeholder="3-10 characters">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
