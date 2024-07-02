<?php
include('db.php');

$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password before saving it to the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, phone_number, password, role) VALUES ('$full_name', '$email', '$phone_number', '$hashed_password', '$role')";
    if (mysqli_query($conn, $sql)) {
        $registration_success = true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SEA Salon</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
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
            font-size: 1.25rem; /* Ukuran teks pada navbar diperbesar */
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
    </style>
    <script>
        <?php if ($registration_success) : ?>
        alert('Account successfully created.');
        window.location.href = 'login.php';
        <?php endif; ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="images and icons/icon4.png" alt="SEA Salon Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class="nav-item">
                    <a class="nav-link" href="reservation.php">Reservation</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="full_name">Full Name:</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number:</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="Customer">Customer</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="login.php">Already have an account? Login here</a>
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
