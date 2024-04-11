<?php
include ('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form data is set and not empty
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        // Get the user ID from the form
        $userid = $_POST['user_id'];

        // Display an alert message with the user ID
        echo '<script>alert("Invoice has been sent successfully.");</script>';
        echo '<script>window.location.href = "cspayment_managerview1.php"</script>';
    
    } else {
        // Display an alert message if the user ID is not set or empty
        echo '<script>alert("Error: User ID is not set or empty.");</script>';
    }
} else {
    // Display an alert message if the form is not submitted
    echo '<script>alert("Error: Form is not submitted.");</script>';
}
?>
