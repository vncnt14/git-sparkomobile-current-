<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : '';
	$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : '';
	$contact = isset($_POST["contact"]) ? $_POST["contact"] : '';
	$completeadd = isset($_POST["completeadd"]) ? $_POST["completeadd"] : '';
	$email = isset($_POST["email"]) ? $_POST["email"] : '';
	$username = isset($_POST["username"]) ? $_POST["username"] : '';
	$password = isset($_POST["password"]) ? $_POST["password"] : '';
	$role = isset($_POST["role"]) ? $_POST["role"] : '';


	
	$query = "INSERT INTO carowners (firstname, lastname, contact, completeadd, email, username, password, role) 
	VALUES ('$firstname', '$lastname', '$contact', '$completeadd', '$email', '$username', '$password', '$role')";

	
	if (mysqli_query($connection, $query)) {
		echo '<script>alert("Registration successful!"); window.location.href = "cslogin.html";</script>';
		exit;
	} else{
		echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
}	
mysqli_error ($connection);
?>