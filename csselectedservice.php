<?php
session_start();

// Include database connection file
include('config.php');// You'll need to replace this with your actual database connection code
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if selected services are submitted
    if(isset($_POST['selected_services'])) {
        // Database connection code (replace with your actual connection code)
        

        // Prepare and bind statement to insert selected services
        $stmt = $connection->prepare("INSERT INTO select_service (user_id, vehicle_id, service_id) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $vehicle_id, $service_id);

        // Get user_id and vehicle_id from the form
        $user_id = $_POST['user_id'];
        $vehicle_id = $_POST['vehicle_id'];

        // Loop through selected services and insert into the database
        foreach($_POST['selected_services'] as $service_id) {
            // Bind service_id parameter and execute statement
            $stmt->execute();
        }

        // Close statement and connection
        $stmt->close();
        $connection->close();

        echo "Selected services have been successfully inserted into the database.";
    } else {
        echo "Please select at least one service.";
    }
} else {
    echo "Form not submitted.";
}
?>
