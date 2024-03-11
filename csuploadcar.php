<?php
    include('config.php');
    include('session.php');
    
    $id = $_SESSION['vehicle_id']; // Assuming you have 'user_id' in your session
    $userID = $_SESSION['user_id']; // Assuming you have 'user_id' in your session

    if (isset($_FILES['profile']['tmp_name'])) {
        $file = $_FILES['profile']['tmp_name'];
        $profile = addslashes(file_get_contents($_FILES['profile']['tmp_name']));
        $profile_name = addslashes($_FILES['profile']['name']);
        $profile_size = getimagesize($_FILES['profile']['tmp_name']);

        if ($profile_size == FALSE) {
            echo "That's not an image!";
        } else {
            move_uploaded_file($_FILES['profile']['tmp_name'], "uploads/" . $_FILES['profile']['name']);
            $profile = "uploads/" . $_FILES['profile']['name'];

            $query = "SELECT *FROM vehicles WHERE user_id='$userID'";
            $result = mysqli_query($connection, $query);
            $vehicleData = mysqli_fetch_assoc($result);

            if (!$update = mysqli_query($connection, "UPDATE vehicles SET profile = '$profile' WHERE  user_id = '$userID'")) {
                echo mysqli_error($connection);
            } else {
                header("Location: cscars2.php?id=" . (isset($vehicleData['vehicle_id']) ? $vehicleData['vehicle_id'] : ''));
                exit();
            }
        }
    } else {
        echo "No photo uploaded";
    }
?>
