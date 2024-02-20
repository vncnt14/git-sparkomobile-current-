<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    


    $query = "SELECT * FROM carowners WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($password === $row['password']) {
            // Set user details in the session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['service_id'] = $row['service_id'];
            $_SESSION['vehicle_id'] = $row['vehicle_id'];
            $_SESSION['condition_id'] =$row['condition_id'];
            $_SESSION['slot_id'] =$row['slot_id'];
            $_SESSION['slotNumber'] =$row['slotNumber'];
            $_SESSION['username'] = $row['username'];

            // Redirect to the main page or any other authenticated page
            header("Location: csdashboard.php");
            exit;
        } else {
            echo "<script>alert('Invalid password. Please try again.');</script>";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'cslogin.html';
                    }, 100); // Redirect after 1 second
                  </script>";
            exit;
        }
    } else {
        echo "<script>alert('User not found. Please try again.');</script>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'cslogin.html';
                }, 1000); // Redirect after 1 second
              </script>";
        exit;
    }
}

mysqli_close($connection);
?>
