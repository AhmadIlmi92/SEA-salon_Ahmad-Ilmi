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
}
?>
