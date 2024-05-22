<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Waste Generation Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">

<!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

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
<?php
    session_start();
    ?>

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
    <form action="enterwaste_backend.php" method="post">
        <h2 class="mt-4">Enter Waste Generation Data</h2>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="generated">Waste Generated (tons):</label>
        <input type="number" id="generated" name="generated" required>

        <label for="factor">Efficiency Factor (%):</label>
        <input type="number" id="factor" name="factor" required>

        
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
</div>
<!-- Bootstrap JavaScript (Optional, if required) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
