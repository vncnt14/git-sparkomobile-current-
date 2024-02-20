<?php
session_start();
require_once "config.php";

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: cslogin_admin.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user ID from the session
    $vehicle_id = $_SESSION['vehicle_id'];
    $userID =$_POST['user_id'];
    $label = $_POST["label"];
    $platenumber = $_POST["platenumber"];
    $chassisnumber = $_POST["chassisnumber"];
    $enginenumber = $_POST["enginenumber"];
    $brand = $_POST["brand"];
    $model = $_POST["model"];
    $color = $_POST["color"];

    // Insert car details into the vehicles table
    $query = "INSERT INTO vehicles (user_id, label, platenumber, chassisnumber, enginenumber, brand, model, color) 
              VALUES ('$userID', '$label', '$platenumber', '$chassisnumber', '$enginenumber', '$brand', '$model', '$color')";

    try {
        mysqli_query($connection, $query);
        echo '<script>alert("Car registration successful!");</script>';
         echo "<script>
                    setTimeout(function() {
                        window.location.href = 'cscars1.php';
                    }, 100); // Redirect after 1 second
                  </script>";
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

mysqli_close($connection);
?>
