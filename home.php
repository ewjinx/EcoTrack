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


// Fetch the factory name using the factory id
$sql = "SELECT name FROM factories WHERE factoryId = '$factory_id'";
$result = mysqli_query($con, $sql);

$factory_name = '';
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $factory_name = $row['name'];
} else {
    $factory_name = 'No Factory Assigned';
}

$sql_announcements = "SELECT date, title, content FROM announcements WHERE factory_id = '$factory_id' ORDER BY date DESC LIMIT 5";
$result_announcements = mysqli_query($con, $sql_announcements);



  mysqli_close($con);
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .welcome-section {
            text-align: center;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .factory-name {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 20px;
        }
        .user-name {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .date {
            font-size: 16px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="alert alert-dismissible alert-success" style="margin-top: 5px;">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Successfully Logged In!</strong>
</div>

<div class="container">
    <div class="welcome-section">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
        <h2 class="factory-name">Factory: <?php echo htmlspecialchars($factory_name); ?></h2>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-3">
                <h3>Recent Announcements</h3>
                <?php if ($_SESSION['owner'] == 1) : ?>
                <a href="newannouncement.php" class="btn btn-primary">New Announcement</a>
                <?php endif; ?>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_announcements && mysqli_num_rows($result_announcements) > 0) {
                        while ($row = mysqli_fetch_assoc($result_announcements)) {
                            echo "<tr>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['content'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No announcements available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript (Optional, if required) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>