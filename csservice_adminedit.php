<?php
session_start();

// Include database connection file
include('config.php');// You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: cslogin_admin.html");
    exit;
}

// Fetch user information based on ID

$serviceID = $_SESSION['service_id'];
$id = $_GET['id'];

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT * FROM services WHERE service_id = '$id'";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$serviceData = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    
    <title>SPARK MOBILE</title>
    <link rel="icon" href="NEW SM LOGO.png" type="image/x-icon">
    <link rel="shortcut icon" href="NEW SM LOGO.png" type="image/x-icon">
</head>
<body>

<style>
  


.welcome{
    font-size: 15px;
    text-align: center;
    margin-top: 20px;
    margin-right: 15px;
}
.me-2{
  color: #fff;
  font-weight: normal;
  font-size: 13px;

}
.me-2:hover{
  background: orangered;
}
span{
  color: #fff;
  font-weight: bold;
  font-size: 20px;
}
img{
  width: 30px;
  border-radius: 50px;
  display: block;
  margin: auto;

}
li :hover{
  background: #072797;
}
.v-1{
  background-color: #072797;
  color: #fff;
}
.v-2{
  background-color: orangered;
}
.main {
  margin-left: 200px;
}
.form-group{
  color: black;
}
.dropdown-item:hover{
  background-color: orangered;
  color: #fff;
}
.my-4:hover{
  background-color: #fff;
}
.navbar{
  background-color: #072797;
}
.btn:hover{
  background-color: #072797;
}
.nav-links ul li:hover a {
  color: white;
}
.section{
  margin-left: 200px;
}
.text-box {
  padding: 6px 6px 6px 230px;
  background: orangered;
  border-radius: 10px;
  width: 50%;
  height: auto;
  position: absolute;
  top: 20%;
  left: 30%;
}
.text-box .btn {
  background-color: #072797;
  text-decoration: none;
  width: 58%;

}
.container-vinfo{
  margin-left: 20px
}
.v-3{
  font-weight: bold;
  font-size: xx-large;
}
 

        
     

      
       
      
        /*main content*/
     
      

      

        .line-separator {
        border-top: 1px solid #ccc;
        margin-bottom: 20px;
        margin-top: -10px; /* Adjusted margin-top to move it more on top */
        }

        .details-form {
        display: flex;
        flex-wrap: wrap;
        }

        .form-section {
        width: 48%;
        margin-bottom: 5px;
        margin-top: -10px; /* Adjusted margin-top to move it more on top */
        }

        .form-section input {
            width: calc(100% - 20px); /* Adjusted width for better spacing */
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        



        

        
    

</style>

    <!-- Header -->
    <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container bootstrap snippets bootdey">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-toggle"></span>
        </button>
        <a class="navbar-brand" href="#">SPARK MOBILE</a>
        </div>
        
    </div><!-- /container -->
    </div>
<!-- /Header -->

<!-- Main -->
<div class="container bootstrap snippets bootdey">
  
  <!-- upper section -->
  <div class="row">
    <div class="col-md-3">
      <!-- left -->
      <a href="csdashboard_admin.php"><strong><i class="glyphicon glyphicon-dashboard"></i> Home</strong></a>
      <hr>
      
      <ul class="nav nav-pills nav-stacked">
        <li><a href="csservice_adminview.php"><i class="glyphicon glyphicon-plus"></i> Add Services</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-link"></i> Links</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Reports</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-book"></i> Books</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Tools</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-time"></i> Real-time</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Advanced..</a></li>
        <li><a href="cslogin_admin.html"><i class="glyphicon glyphicon-lock"></i> LogOut</a></li>
      </ul>
      
      <hr>
      
  	</div><!-- /span-3 -->
    <div class="col-md-9">   	
      <!-- column 2 -->	
       <h2><strong><i></i> EDIT SERVICES</strong></h2>     
       <hr>
      
    <div class="row"></div>

    <form class="details-form" action="csservice_adminedit1.php" method="POST">
        <div class="form-section" id="servicesContainer">
            <label for="service_name">Service Name</label>
            <input type="hidden" id="service_id" name="id" value="<?php echo $serviceData['service_id'];?>">
            <input type="text" id="service_name" name="service_name" value="<?php echo $serviceData['service_name'];?>" required>
            <br>
            <label for="price">Total Price</label>
            <input type="text" id="price" name="price" value="<?php echo $serviceData['price'];?>" required>

            <label for="priceperservice">Price Per Service</label>
            <input type="text" id="priceperservice" name="priceperservice" value="<?php echo $serviceData['priceperservice'];?>" required>

            <label for="duration">Overall Duration</label>
            <input type="text" id="duration" name="duration" value="<?php echo $serviceData['duration'];?>" required>

            <label for="durationperservice">Duration Per Service</label>
            <input type="text" id="durationperservice" name="durationperservice" value="<?php echo $serviceData['durationperservice'];?>" required>

            <!-- Input for services -->
            <label for="services">Service Package</label>
            <input type="text" id="services" name="services[]" value="<?php echo $serviceData['services'];?>" required>
            <br>

            <!-- Button to add more services inputs -->
            <button type="button" onclick="addServicesInput()" class="btn btn-primary me-2">Add Services</button>

            <!-- Save Changes button -->
            <div class="d-flex">
                <br>
                <input type="submit" value="Save Changes" class="me-2 btn-primary">
            </div>
        </div>
    </form>

    <script>
        function addServicesInput() {
            var container = document.getElementById("servicesContainer");
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "edit_services[]";
            newInput.placeholder = "Enter Service";
            container.appendChild(newInput);
            container.appendChild(document.createElement("br"));
        }
    </script>
</div>


   




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="path/to/jquery/jquery.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="path/to/bootstrap/js/bootstrap.min.js"></script>
    </body>


</html>