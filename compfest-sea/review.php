<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Customer') {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thom_salon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customerName'];
    $starRating = $_POST['starRating'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO reviews (customerName, starRating, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $customerName, $starRating, $comment);

    if ($stmt->execute()) {
        echo "Review submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}

$sql = "SELECT customerName, starRating, comment FROM reviews ORDER BY created_at DESC";
$result = $conn->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reviews - Thom Salon</title>
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
            animation: backgroundAnimation 10s infinite alternate;
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
            font-size: 1.25rem;
        }

        .jumbotron {
            background-color: rgba(221, 188, 146, 0.8);
            padding: 2rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .jumbotron h1,
        .jumbotron p {
            text-align: center;
        }

        .review-card {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            margin: 20px auto; /* Adjusted margin for spacing */
        }

        .review-card h2 {
            margin-bottom: 20px;
        }

        .review-list {
            list-style-type: none;
            padding-left: 0;
            text-align: left;
        }

        .review-item {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .review-item strong {
            font-size: 1.2rem;
        }

        .review-item .stars {
            color: #ffc107;
        }

        .footer {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 1rem 0;
            text-align: center;
            margin-top: auto;
        }
        .btn-primary {
            background-color: #d9b08c;
            border-color: #d9b08c;
        }

        .btn-primary:hover {
            background-color: #b88a6a;
            border-color: #b88a6a;
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
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item active">
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
            <h1 class="display-4">Customer Reviews</h1>
            <p class="lead">Check out what our customers have to say about Thom Salon.</p>
        </div>

        <!-- Review Form -->
        <div class="review-card">
            <h2>Leave a Review</h2>
            <form id="reviewForm">
                <div class="form-group">
                    <label for="customerName">Your Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName" required>
                </div>
                <div class="form-group">
                    <label for="starRating">Star Rating (1-5)</label>
                    <input type="number" class="form-control" id="starRating" name="starRating" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>

        <!-- Review List -->
        <div class="review-card">
            <h2>Latest Reviews</h2>
            <ul class="review-list" id="reviewList">
                <?php foreach ($reviews as $review): ?>
                    <li class="review-item">
                        <strong><?php echo htmlspecialchars($review['customerName']); ?></strong> rated 
                        <span class="stars"><?php echo str_repeat('★', $review['starRating']); ?></span><br>
                        <?php echo htmlspecialchars($review['comment']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
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
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reviewForm = document.getElementById('reviewForm');
            const reviewList = document.getElementById('reviewList');

            // Form submission handler
            reviewForm.addEventListener('submit', function (event) {
                event.preventDefault();

                // Get form values
                const formData = new FormData(reviewForm);
                const customerName = formData.get('customerName');
                const starRating = parseInt(formData.get('starRating'));
                const comment = formData.get('comment');

                // Validate star rating
                if (starRating < 1 || starRating > 5) {
                    alert('Star rating must be between 1 and 5.');
                    return;
                }

                // Send review data to the server
                fetch('review.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    // Add review to the list
                    const li = document.createElement('li');
                    li.classList.add('review-item');
                    li.innerHTML = `
                        <strong>${customerName}</strong> rated <span class="stars">${'★'.repeat(starRating)}</span><br>
                        ${comment}
                    `;
                    reviewList.appendChild(li);

                    // Reset form fields
                    reviewForm.reset();
                });
            });
        });
    </script>
</body>
</html>






