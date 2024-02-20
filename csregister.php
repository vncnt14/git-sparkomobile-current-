<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$contact = $_POST["contact"];
	$completeadd = $_POST["completeadd"];
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = $_POST["password"];

	
	$query = "INSERT INTO carowners (firstname, lastname, contact, completeadd, email, username, password) 
	VALUES ('$firstname', '$lastname', '$contact', '$completeadd', '$email', '$username', '$password')";

	
	if (mysqli_query($connection, $query)) {
		echo '<script>alert("Registration successful!"); window.location.href = "cslogin.html";</script>';
		exit;
	} else{
		echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
}	
mysqli_error ($connection);
?>