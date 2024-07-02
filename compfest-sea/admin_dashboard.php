<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Admin') {
    header('Location: login.php');
    exit();
}

include('db.php');

// Handle branch creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_branch'])) {
    $branch_name = $_POST['branch_name'];
    $branch_location = $_POST['branch_location'];
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];

    $sql = "INSERT INTO branches (branch_name, branch_location, opening_time, closing_time) VALUES ('$branch_name', '$branch_location', '$opening_time', '$closing_time')";

    if ($conn->query($sql) === TRUE) {
        $branch_success = "New branch added successfully.";
    } else {
        $branch_error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle service creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_service'])) {
    $service_name = $_POST['service_name'];
    $duration = $_POST['duration'];
    $branch_id = $_POST['branch_id'];
    $price = $_POST['price']; // New line to get price from form

    $sql = "INSERT INTO services (service_name, duration, branch_id, price) 
            VALUES ('$service_name', '$duration', '$branch_id', '$price')";

    if ($conn->query($sql) === TRUE) {
        $service_success = "New service added successfully.";
    } else {
        $service_error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all branches
$branches_result = $conn->query("SELECT * FROM branches");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SEA Salon</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Garamond', serif;
            background-image: url('images and icons/background salon.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            animation: backgroundAnimation 20s infinite alternate;
        }

        @keyframes backgroundAnimation {
            0% {
                background-position: top;
            }

            100% {
                background-position: bottom;
            }
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.8);
            font-family: 'Garamond', serif;
            font-size: 1.25rem;
        }

        .card {
            margin-top: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            font-family: 'Garamond', serif;
        }

        .card-header {
            background-color: rgba(221, 188, 146, 0.8);
            text-align: center;
            font-size: 1.5rem;
        }

        .card-body {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .card-footer {
            background-color: rgba(221, 188, 146, 0.8);
            text-align: center;
        }

        .btn-primary {
            background-color: #d9b08c;
            border-color: #d9b08c;
        }

        .btn-primary:hover {
            background-color: #b88a6a;
            border-color: #b88a6a;
        }

        footer {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1rem 0;
            text-align: center;
            font-family: 'Garamond', serif;
            margin-top: auto;
        }

        .form-control {
            color: black; /* Set text color to black */
        }

        .dropdown-item {
            color: black !important; /* Ensure dropdown items have black text */
        }

        .form-group label {
            color: black; /* Ensure labels have black text */
        }

        .custom-select, .form-control {
            background-color: white !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="images and icons/icon4.png" alt="SEA Salon Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                </li>
            </ul>
            <span class="navbar-text">
                Welcome, Admin <?php echo $_SESSION['full_name']; ?>
            </span>
            <a href="logout.php" class="btn btn-secondary ml-3">Logout</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>
                    <div class="card-body">
                        <?php if (isset($branch_success)) { echo "<div class='alert alert-success'>$branch_success</div>"; } ?>
                        <?php if (isset($branch_error)) { echo "<div class='alert alert-danger'>$branch_error</div>"; } ?>
                        <?php if (isset($service_success)) { echo "<div class='alert alert-success'>$service_success</div>"; } ?>
                        <?php if (isset($service_error)) { echo "<div class='alert alert-danger'>$service_error</div>"; } ?>
                        
                        <h3>Create New Branch</h3>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="branch_name">Branch Name:</label>
                                <input type="text" class="form-control" id="branch_name" name="branch_name" required>
                            </div>
                            <div class="form-group">
                                <label for="branch_location">Branch Location:</label>
                                <input type="text" class="form-control" id="branch_location" name="branch_location" required>
                            </div>
                            <div class="form-group">
                                <label for="opening_time">Opening Time:</label>
                                <input type="time" class="form-control" id="opening_time" name="opening_time" required>
                            </div>
                            <div class="form-group">
                                <label for="closing_time">Closing Time:</label>
                                <input type="time" class="form-control" id="closing_time" name="closing_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create_branch">Add Branch</button>
                        </form>
                        
                        <hr>
                        
                        <h3>Create New Service</h3>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="service_name">Service Name:</label>
                                <input type="text" class="form-control" id="service_name" name="service_name" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration (minutes):</label>
                                <input type="number" class="form-control" id="duration" name="duration" required>
                            </div>
                            <div class="form-group">
                                <label for="branch_id">Branch:</label>
                                <select class="form-control" id="branch_id" name="branch_id" required>
                                    <?php
                                    if ($branches_result->num_rows > 0) {
                                        while($row = $branches_result->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['branch_name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No branches available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create_service">Add Service</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p>&copy; 2023 SEA Salon. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2023 SEA Salon. All rights reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

