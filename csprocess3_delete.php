<?php

session_start();

// Include database connection file
include('config.php');// You'll need to replace this with your actual database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established
    $userId = $_POST['user_id'];

    // Implement your logic to delete the service from the database
    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($connection, "DELETE FROM select_service WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    
    if (mysqli_stmt_execute($stmt)) {
        // Deletion successful
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } else {
        // Deletion failed
        header('Content-Type: application/json');
        echo json_encode(['success' => false]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    exit();
}
?>
