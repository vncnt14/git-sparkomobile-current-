<?php
// Database connection
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables to store form data
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
    $amount = isset($_POST['modalAmount']) ? $_POST['modalAmount'] : '';
    $totalPrice = isset($_POST['totalPrice']) ? $_POST['totalPrice'] : '';

    // Convert amount and total price to float
    $amount = floatval($amount);
    $totalPrice = floatval($totalPrice);

    // Calculate change
    $change = $amount - $totalPrice;

    // Prepare and execute the SQL statement
    $insert_query = "INSERT INTO payment_details (user_id, amount, change_amount, payment_method, date) VALUES (?, ?, ?, ?, ?)";
    $update_query = "UPDATE servicedone SET is_deleted = '1' WHERE user_id = ?";
    
    $stmt_insert = mysqli_prepare($connection, $insert_query);
    $stmt_update = mysqli_prepare($connection, $update_query);

    if ($stmt_insert && $stmt_update) {
        // Bind parameters for insertion
        mysqli_stmt_bind_param($stmt_insert, 'issss', $user_id, $amount, $change, $payment_method, $date);

        // Bind parameter for update
        mysqli_stmt_bind_param($stmt_update, 'i', $user_id);

        // Execute insertion
        if (mysqli_stmt_execute($stmt_insert)) {
            // Execute update
            mysqli_stmt_execute($stmt_update);
            
            echo '<script>alert("Invoice has been sent successfully.");</script>';
            echo '<script>window.location.href = "cspayment_managerview.php"</script>';
        } else {
            echo "Error: Unable to execute insertion.<br>" . mysqli_error($connection);
        }

        // Close statements
        mysqli_stmt_close($stmt_insert);
        mysqli_stmt_close($stmt_update);
    } else {
        echo "Error: Unable to prepare statements.<br>" . mysqli_error($connection);
    }

    // Close connection
    mysqli_close($connection);
} else {
    echo "Form submission failed";
}
?>
