<?php
session_start();

// Check if user is logged in and is a customer
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Customer') {
    header('Location: login.php');
    exit();
}

// Include database connection file
include('db.php');

// Fetch user reservations
$userId = $_SESSION['id'];
$sql = "SELECT * FROM reservations WHERE id='$userId'";
$result = mysqli_query($conn, $sql);

if ($result === false) {
    // Check for SQL error
    echo "SQL Error: " . $conn->error;
    exit();
}

$reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Function to determine greeting based on current time
function getGreeting() {
    $hour = date("H");
    if ($hour < 12) {
        return "Good Morning";
    } elseif ($hour < 18) {
        return "Good Afternoon";
    } else {
        return "Good Night";
    }
}

$greeting = getGreeting();
$fullName = $_SESSION['full_name'];

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thom Salon</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
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
            font-size: 1.25rem; /* Ukuran teks pada navbar diperbesar */
        }

        .jumbotron {
            background-color: rgba(221, 188, 146, 0.8);
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            font-family: 'Garamond', serif;
        }

        .jumbotron h1,
        .jumbotron p {
            text-align: center;
        }

        .card {
            border: none;
            transition: transform 0.3s ease-in-out;
            font-family: 'Garamond', serif;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.2rem;
            text-align: center;
        }

        .card-body {
            text-align: center;
        }

        .card-body:hover {
            cursor: pointer;
        }

        .card-body a {
            color: #333;
            text-decoration: none;
        }

        .card-body a:hover {
            text-decoration: underline;
        }

        .contact-card {
           background-color: rgba(255, 255, 255, 0.8);
           padding: 1.5rem;
           border-radius: 10px;
           box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
           text-align: center;
           max-width: 90%; /* Adjusted to 90% instead of 500px */
            margin: 0 auto;
        }


        .contact-card ul {
            list-style: none;
            padding: 0;
        }

        .contact-card li {
            margin-bottom: 0.5rem;
        }

        .btn-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #ddbc92;
            color: #333;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-link:hover {
            background-color: #c3a377;
            color: #333;
        }

        .contact-section {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        footer {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1rem 0;
            text-align: center;
            font-family: 'Garamond', serif;
            margin-top: auto;
        }

        .service-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-container {
            margin-top: 2rem;
            text-align: center;
        }

        .video-container h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="images and icons/icon4.png" alt="Thom Salon Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
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
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
            <span class="navbar-text ml-auto">
                <?php echo "$greeting, $fullName!"; ?>
            </span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to Thom Salon</h1>
            <p class="lead">Beauty and Elegance Redefined</p>
        </div>

        <!-- Carousel Section -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images and icons/carousel5.jpg" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="images and icons/carousel6.jpg" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="images and icons/carousel4.jpg" class="d-block w-100" alt="Slide 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Services Section -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm" onclick="window.location.href='reservation.php'">
                    <img src="images and icons/hairstyle.jpg" alt="Haircuts and Styling" class="service-img">
                    <div class="card-body">
                        <h4 class="card-title">Haircuts and Styling</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm" onclick="window.location.href='reservation.php'">
                    <img src="images and icons/manipedi.jpg" alt="Manicure and Pedicure" class="service-img">
                    <div class="card-body">
                        <h4 class="card-title">Manicure and Pedicure</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm" onclick="window.location.href='reservation.php'">
                    <img src="images and icons/treatment.jpeg" alt="Facial Treatments" class="service-img">
                    <div class="card-body">
                        <h4 class="card-title">Facial Treatments</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm" onclick="window.location.href='reservation.php'">
                    <img src="images and icons/makeup.jpg" alt="Make Up" class="service-img">
                    <div class="card-body">
                        <h4 class="card-title">Make Up</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm" onclick="window.location.href='reservation.php'">
                    <img src="images and icons/bodytreat.jpg" alt="Body Treatment" class="service-img">
                    <div class="card-body">
                        <h4 class="card-title">Body Treatment</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm" onclick="window.location.href='reservation.php'">
                    <img src="images and icons/hair spa.jpg" alt="Hair Spa & Hair Treatment" class="service-img">
                    <div class="card-body">
                        <h4 class="card-title">Hair Spa & Hair Treatment</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Section -->
        <div class="video-container">
            <h2>A little peek into our salon</h2>
            <div class="video-wrapper">
                <iframe width="560" height="315"
                    src="https://www.youtube.com/embed/RWr8XeBUxTU?si=MQEySUL-r9iMMHFg&amp;start=1" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="contact-section">
            <div class="contact-card">
                <h3>Contact Us</h3>
                <ul>
                    <li><strong>Phone:</strong>08123456789</li>
                    <li><strong>Email:</strong> info@thomsalon.com</li>
                    <li><strong>Instagram:</strong> @thomsalon</li>
                </ul>
                <a href="about.php" class="btn-link">Get in touch</a>
                <!-- Google Maps Section -->
                <div class="mt-3">
                    <a href="https://www.google.com/maps/place/Your+Salon+Location/@-6.200000,106.816666,17z/data=!3m1!4b1!4m5!3m4!1s0x0:0x0!8m2!3d-6.200000!4d106.816666" class="btn-link"
                        target="_blank">Find us on Google Maps</a>
                    <div class="mt-2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.764419639176!2d106.816666!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0:0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDgnNTAuMCJF!5e0!3m2!1sen!2sid!4v1598508466979!5m2!1sen!2sid"
                         width="100%" height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-4">
        <p>&copy; 2023 Thom Salon. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>





