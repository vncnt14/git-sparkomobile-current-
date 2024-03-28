<?php
// Include your database connection file
include('config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve form data
    $selected_id = $_GET['selected_id'];
    $vehicle_id = $_GET['vehicle_id'];
    $user_id = $_GET['user_id'];
    $services = $_GET['services'];
    $price = $_GET['price'];
    $total_price = $_GET['total_price'];
    $timer = $_GET['timer'];

    // Perform SQL query to insert data into the database
    $query = "INSERT INTO servicedone (selected_id, vehicle_id, user_id, services, price, total_price, timer) 
              VALUES ('$selected_id', '$vehicle_id', '$user_id', '$services', '$price', '$total_price', '$timer')";

    if (mysqli_query($connection, $query)) {
        // Data inserted successfully
        echo '<script>alert("Data inserted successfully.");</script>';
        // Redirect to a new page
        echo '<script>window.location.href = "csservice_staffview.php";</script>';
    } else {
        // Error occurred
        echo '<script>alert("Error: ' . $query . ' - ' . mysqli_error($connection) . '");</script>';
        // Redirect to a different page or stay on the same page
        
    }

    // Close database connection
    mysqli_close($connection);
}
?>
