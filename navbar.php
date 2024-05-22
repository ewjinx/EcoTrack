<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            padding-top: 100px;
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

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid" style="padding-left: 40px">
        <a class="navbar-brand" href="home.php">EcoTrack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home<span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editprofile_emp.php">Edit Profile</a>
                </li>
                <?php
                
                // Check if session variable owner is set and its value is 1
                if (isset($_SESSION['owner']) && $_SESSION['owner'] == 1) {
                    
                    echo '<li class="nav-item"><a class="nav-link" href="editfactorydetails.php">Edit Factory Data</a></li>';
                } else {
                    // If session variable owner is not set or its value is not 1, disable the link
                    echo '<li class="nav-item"><a class="nav-link disabled" href="#">Edit Factory Data</a></li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="leaderboard.php">Leaderboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Enter Data</a>
                    <div class="dropdown-menu">
                        <?php
                        // Check if session variable owner is set and its value is 0
                        if (isset($_SESSION['owner']) && $_SESSION['owner'] == 0) {
                            echo '<a class="dropdown-item" href="entertransportation.php">Transportation</a>';
                        } else {
                            // If session variable owner is not set or its value is not 0, show all options
                            echo '<a class="dropdown-item" href="enterenergy.php">Energy Consumption</a>';
                            echo '<a class="dropdown-item" href="enterwaste.php">Waste Generation</a>';
                            echo '<a class="dropdown-item" href="entertransportation.php">Transportation</a>';
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">View Data</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="energydata.php">Energy Consumption</a>
                        <a class="dropdown-item" href="wastedata.php">Waste Generation</a>
                        <a class="dropdown-item" href="transportationdata.php">Transportation</a>
                    </div>
                </li>
            </ul>
            <!-- Logout Button -->
            <button type="button" class="btn btn-outline-light me-3" onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>
</nav>

</body>
</html>
