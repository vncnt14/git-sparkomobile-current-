<?php
session_start();
include('config.php');



    // Retrieve and sanitize form data
    $id = $_POST['id'];
	$service_name = $_POST['service_name'];
    $services = is_array($_POST["services"]) ? implode(', ', $_POST["services"]) : $_POST["services"];
    $price = $_POST['price'];
	$priceperservice = $_POST['priceperservice'];
	$duration = $_POST['duration'];
	$durationperservice = $_POST['durationperservice'];
	$color = $_POST['color'];
	$size = $_POST['size'];

    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE services SET service_name='$service_name', services='$services', price='$price', duration='$duration', priceperservice='$priceperservice', durationperservice='$durationperservice' WHERE service_id = '$id'";
	if(mysqli_query($connection, $sql)){
	echo '<script language="javascript">';
	echo 'alert("Service successfully updated!");';
	echo 'window.location="csservice_adminview.php";';
	echo'</script>';	
} else {
	echo'<script language="javascript">';
	echo'alert("Error Updating!");';
	echo'window.location="csservice_adminview.php";';
	echo '</script>';
}
?>