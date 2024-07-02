<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Customer') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Thom Salon</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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

        .about-section {
            padding: 4rem 0;
        }

        .about-heading {
            text-align: center;
            margin-bottom: 2rem;
        }

        .about-content {
            text-align: justify;
        }

        .contact-card {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            font-family: 'Garamond', serif;
            margin-top: 2rem;
        }

        .contact-card ul {
            list-style: none;
            padding: 0;
        }

        .contact-card li {
            margin-bottom: 0.5rem;
        }

        .social-media {
            margin-top: 2rem;
            text-align: center;
        }

        .social-media a {
            margin: 0 1rem;
            font-size: 1.5rem;
            color: #333;
        }

        .social-media a:hover {
            color: #ddbc92;
        }

        .footer {
            background-color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 1rem;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
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
            </ul>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4">About Us</h1>
            <p class="lead">Learn more about Thom Salon and our commitment to beauty and elegance.</p>
        </div>

        <!-- About Section -->
        <div class="about-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h2 class="about-heading">Our Story</h2>
                        <p class="about-content">
                            Thom Salon was founded with a vision to redefine beauty and elegance. Our salon offers
                            premium services in haircuts, styling, manicure, pedicure, and facial treatments. With a
                            team of dedicated professionals, we strive to provide exceptional experiences to our
                            clients.
                        </p>
                        <p>
                        Why Choose Us?
                        </p>
                        <p>
                        Professional and Experienced: Our team consists of skilled professionals with extensive experience in the beauty industry. 
                        We always stay updated with the latest trends and use the best techniques and products to ensure you get satisfying results.
                        </p>
                        <p>
                        Wide Range of Services: We offer a variety of beauty services including haircuts, styling, coloring, facial treatments. 
                        Whatever your beauty needs, we are here to help.
                        </p>
                        <p>
                        Quality Products: We use only high-quality beauty products that are safe and effective. 
                        We ensure that every product we use is tested and trusted, so you can feel at ease while receiving treatments at our salon.
                        </p>
                        <p>
                        Friendly and Personalized Service: Your satisfaction is our priority. 
                        We always listen to your needs and desires, provide the right advice, and ensure you feel comfortable during your visit to our salon.
                        </p>
                        <p>
                        Thank you for entrusting your beauty care to us. We look forward to continuing to serve you and help you achieve your best beauty. 
                        Visit us at Kemang Boulevard  or contact if you have any question.
                        </p>
                        <div class="contact-card">
                            <h3>Contact Us</h3>
                            <ul>
                                <li><strong>Phone:</strong> <a href="tel:08123456789">08123456789</a></li>
                                <li><strong>Email:</strong> <a href="mailto:info@thomsalon.com">info@thomsalon.com</a></li>
                            </ul>
                        </div>
                        <div class="social-media">
                            <h3>Follow Us</h3>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/ahmd.ilmi/"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Thom Salon. All Rights Reserved.</p>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>



