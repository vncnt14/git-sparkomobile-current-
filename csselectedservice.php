<?php
session_start();

// Include database connection file
include('config.php');// You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location cslogin.html");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established
    $userID = $_SESSION['user_id'];
    $vehicle_id = $_POST['vehicle_id'];
    $selected_services = isset($_POST['selected_services']) ? $_POST['selected_services'] : [];

    // Loop through selected services and insert into your 'select_service' table
    foreach ($selected_services as $service_id) {
        // Fetch service details from the original table (replace 'your_original_table' with the actual table name)
        $service_query = mysqli_query($connection, "SELECT * FROM services WHERE service_id = '$service_id'");
        $service_row = mysqli_fetch_assoc($service_query);

        // Extract service details
        $service_name = $service_row['service_name'];
        $price = $service_row['price'];
        $duration = $service_row['duration'];
        $price_per_service = $service_row['priceperservice'];
        $duration_per_service = $service_row['durationperservice'];

        // Perform the insert operation
        $insert_query = "INSERT INTO select_service (user_id, vehicle_id, service_id, service_name, price, duration, priceoperservice, durationperservice, action) VALUES ('$userID', '$vehicle_id', '$service_id', '$service_name', '$price', '$duration', '$price_per_service', '$duration_per_service', 'selected')";

        // Execute the query
        mysqli_query($connection, $insert_query);
    }

    // Fetch vehicle information from the database based on the vehicle ID
    $userID = $_SESSION['user_id'];

    $query = "SELECT * FROM vehicles WHERE user_id = '$userID' AND vehicle_id = '$vehicle_id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        // Handle query error
        echo "Error: " . mysqli_error($connection);
        // Redirect to an error page or handle the error accordingly
        exit();
    }

    $vehicleData = mysqli_fetch_assoc($result);

    // Check if $vehicleData is not empty before redirecting
    if (!$vehicleData) {
        // Handle no data found scenario
        echo "Vehicle data not found";
        // Redirect to an error page or handle the scenario accordingly
        exit();
    }

    $redirect_url = "csprocess3_view.php?vehicle_id=" . $vehicleData['vehicle_id'] . '&user_id=' . $vehicleData['user_id'];
    header("Location: $redirect_url");
    exit();

}
?>
