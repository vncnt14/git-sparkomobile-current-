<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : 'Edit your FirstName';
	$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : 'Edit your LastName';
	$contact = isset($_POST["contact"]) ? $_POST["contact"] : 'Edit your Contact';
	$completeadd = isset($_POST["completeadd"]) ? $_POST["completeadd"] : 'Edit your Address';
	$email = isset($_POST["email"]) ? $_POST["email"] : 'Edit your Email';
	$username = isset($_POST["username"]) ? $_POST["username"] : '';
	$password = isset($_POST["password"]) ? $_POST["password"] : '';
	$role = isset($_POST["role"]) ? $_POST["role"] : '';
	$profile = isset($_POST["profile"]) ? $_POST["profile"] : 'Edit your Profile';



	
	$query = "INSERT INTO carowners (firstname, lastname, contact, completeadd, email, username, password, role, profile) 
	VALUES ('$firstname', '$lastname', '$contact', '$completeadd', '$email', '$username', '$password', '$role', '$profile')";

	
	if (mysqli_query($connection, $query)) {
		echo '<script>alert("Registration successful!"); window.location.href = "index.php";</script>';
		exit;
	} else{
		echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
}	
mysqli_error ($connection);
?>