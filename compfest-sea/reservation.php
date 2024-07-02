<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include('db.php');

// Fetch all branches
$branches_result = $conn->query("SELECT * FROM branches");

// Fetch services for the selected branch
$selected_branch_id = isset($_POST['branch_id']) ? $_POST['branch_id'] : '';
$services_result = null;

if ($selected_branch_id) {
    $services_result = $conn->query("SELECT * FROM services WHERE branch_id = $selected_branch_id");
}

// Handle reservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['make_reservation'])) {
    $branch_id = $_POST['branch_id'];
    $service_id = $_POST['service_id'];
    $reservation_time = $_POST['reservation_time'];
    $user_id = $_SESSION['id'];

    $sql = "INSERT INTO reservations (user_id, branch_id, service_id, reservation_time) VALUES ('$user_id', '$branch_id', '$service_id', '$reservation_time')";

    if ($conn->query($sql) === TRUE) {
        $reservation_success = "Reservation made successfully.";
    } else {
        $reservation_error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation - SEA Salon</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="review.php">Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="reservation.php">Reservation</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <?php if ($_SESSION['role'] == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Make a Reservation</div>
                    <div class="card-body">
                        <?php if (isset($reservation_success)) { echo "<div class='alert alert-success'>$reservation_success</div>"; } ?>
                        <?php if (isset($reservation_error)) { echo "<div class='alert alert-danger'>$reservation_error</div>"; } ?>
                        
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="branch_id">Branch:</label>
                                <select class="form-control custom-select" id="branch_id" name="branch_id" required onchange="this.form.submit()">
                                    <option value="">Select a branch</option>
                                    <?php
                                    if ($branches_result->num_rows > 0) {
                                        while($row = $branches_result->fetch_assoc()) {
                                            $selected = $row['id'] == $selected_branch_id ? 'selected' : '';
                                            echo "<option value='" . $row['id'] . "' $selected>" . $row['branch_name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No branches available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service_id">Service:</label>
                                <select class="form-control custom-select" id="service_id" name="service_id" required>
                                    <option value="">Select a service</option>
                                    <?php
                                    if ($services_result && $services_result->num_rows > 0) {
                                        while($row = $services_result->fetch_assoc()) {
                                            $service_id = $row['id'];
                                            $service_name = $row['service_name'];
                                            $price = $row['price']; // Ambil harga dari kolom 'price'

                                            echo "<option value='$service_id'>$service_name - Price: $price</option>";
                                        }
                                    } else if ($selected_branch_id) {
                                        echo "<option value=''>No services available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reservation_time">Reservation Time:</label>
                                <input type="datetime-local" class="form-control" id="reservation_time" name="reservation_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="make_reservation">Reserve</button>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>








