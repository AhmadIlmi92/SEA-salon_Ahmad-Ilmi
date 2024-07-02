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

$sql = "SELECT customerName, starRating, comment FROM reviews ORDER BY created_at DESC";
$result = $conn->query($sql);

$reviews = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$conn->close();
echo json_encode($reviews);
?>
