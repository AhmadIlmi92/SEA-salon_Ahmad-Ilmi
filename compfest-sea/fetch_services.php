<?php
include('db.php');

if(isset($_POST["branch_id"])) {
    $branch_id = $_POST["branch_id"];
    $query = "SELECT * FROM services WHERE branch_id = $branch_id";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        echo '<option value="">Select a service</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['id'].'">'.$row['service_name'].'</option>';
        }
    } else {
        echo '<option value="">No services available</option>';
    }
}
?>



