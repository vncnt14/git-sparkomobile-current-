<?php
	include('config.php');
	include('session.php');
	
	$id= $_SESSION['session_id'];
	$image = $_POST['image']

	if (!isset($_FILES['$image']['tmp_name'])) {
	echo "No photo be uploaded";
	}
	else
	{
		$file=$_FILES['$image']['tmp_name'];
		$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$image_name= addslashes($_FILES['$image']['name']);
		$image_size= getimagesize($_FILES['$image']['tmp_name']);

		if ($image_size==FALSE) {
			echo "That's not an image!";
			}
			else
			{
				move_uploaded_file($_FILES["$image"]["tmp_name"],"upload/" . $_FILES["$image"]["name"]);
				
				$location="upload/" . $_FILES["$image"]["name"];

				
				if(!$update=mysqli_query("UPDATE carowners SET photo = '$location' WHERE id='$id'")) {
				
					echo mysqli_error();
			}
			else
			{
				header("location: csdashboard.php");
				exit();
				}
			}
	}
?>