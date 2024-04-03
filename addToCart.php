<?php
session_start();
if(!isset($_SESSION['UserID'])) {
  header('Location: ' . 'index.php', true);
  exit();
}
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $petID = $_POST['petID'];
    $service = $_POST['service'];
    $type = $_POST['type'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $amount = $_POST['amount'];
    $address = $_POST['address'];
    $isInCart = $_POST['isInCart'];
    $hospital = $_POST['hospital'];

    $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pets_care";
                
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the SQL insert query
    $sql = "INSERT INTO `bookings`(`UserID`, `PetID`, `Service`, `Type`, `AppointmentDate`, `AppointmentTime`, `Amount`, `PickupAddress`, `IsInCart`,`Hospital`)
            VALUES ('".$_SESSION['UserID']."','$petID', '$service', '$type', '$appointmentDate', '$appointmentTime', '$amount', '$address', '$isInCart','$hospital')";

    if ($conn->query($sql) === TRUE) {
        echo "Added";
    } else {
        echo "Error";
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>
