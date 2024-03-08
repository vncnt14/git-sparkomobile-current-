<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : '';
	$selected_id = isset($_POST["selected_id"]) ? $_POST["selected_id"] : '';
	$vehicle_id = isset($_POST["vehicle_id"]) ? $_POST["vehicle_id"] : '';

	$query = "INSERT INTO registered (user_id, selected_id, vehicle_id) 
	VALUES ('$user_id', '$selected_id', '$vehicle_id')";

    $query1 = "SELECT * FROM registered WHERE user_id= '$user_id' AND vehicle_id= '$vehicle_id' AND selected_id= '$selected_id'";
    $result = mysqli_query($connection, $query1); // Corrected the function name to mysqli()
    $registeredData = mysqli_fetch_assoc($result);

	
	if (mysqli_query($connection, $query)) {
		echo '<script>alert("Registration successful!"); 
        window.location.href = "csprocess5.php?vehicle_id=' . (isset($registeredData['vehicle_id']) ? $registeredData['vehicle_id'] : '') . (isset($registeredData['user_id']) ? '&user_id=' . $registeredData['user_id'] : '') . (isset($registeredData['selected_id']) ? '&selected_id=' . $registeredData['selected_id'] : '') . '";
      </script>';
		exit;
	} else{
		echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
}	
mysqli_error($connection); // This line doesn't seem to be necessary. If you want to output the error, it should be inside the else block.
?>
