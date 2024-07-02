<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'Customer') {
    header('Location: login.php');
    exit();
}

$servername = "localhost";
$username = "root";  // Use your database username
$password = "";  // Use your database password
$dbname = "thom_salon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $service_type = $_POST['service_type'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];

    $sql = "INSERT INTO reservations (name, phone, service_type, reservation_date, reservation_time)
            VALUES ('$name', '$phone', '$service_type', '$reservation_date', '$reservation_time')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Reservation made successfully');
                window.location.href = 'homepage.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


