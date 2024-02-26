<?php
// Assuming you have established a database connection

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the vehicle_id and user_id from the POST request
    $vehicle_id = $_POST['vehicle_id'];
    $user_id = $_POST['user_id'];
    
    // Perform the deletion operation in the database
    // Here, replace 'your_slot_table' with the actual table name where slot numbers are stored
    // Also, replace 'your_user_table' with the actual table name where user information is stored
    
    // Check if the countdown has expired (countdown === 0)
    // If countdown has not expired, do not delete the slot number
    if ($_POST['countdown'] != 0) {
        echo json_encode(array("status" => "error", "message" => "Countdown has not expired yet"));
        exit();
    }
    
    // Execute the deletion query to remove the slot number
    $query = "DELETE FROM slots WHERE vehicle_id = '$vehicle_id' AND user_id = '$user_id'";
    $result = mysqli_query($connection, $query);

    // Check if deletion was successful
    if ($result) {
        // Return a success message
        echo json_encode(array("status" => "success", "message" => "Slot number deleted successfully"));
    } else {
        // Return an error message if deletion failed
        echo json_encode(array("status" => "error", "message" => "Error deleting slot number: " . mysqli_error($connection)));
    }
} else {
    // Return an error message if the request method is not POST
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));

    // Redirect to csrequest_slot.php if not POST
    header("Location: csrequest_slot.php?vehicle_id=" . (isset($vehicleData['vehicle_id']) ? $vehicleData['vehicle_id'] : '') . "&user_id=" . (isset($vehicleData['user_id']) ? $vehicleData['user_id'] : ''));
    exit();
}
?>
