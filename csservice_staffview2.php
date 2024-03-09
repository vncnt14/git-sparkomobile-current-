<?php
session_start();

// Include database connection file
include('config.php');// You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location cslogin_admin.html");
    exit;
}

// Fetch user information based on ID

$serviceID = $_SESSION['service_id'];

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT r.*, u.firstname, u.lastname, s.services, s.service_name, s.price, s.duration, s.durationperservice 
FROM registered r
LEFT JOIN carowners u ON r.user_id = u.user_id
LEFT JOIN select_service s ON r.selected_id = s.selected_id";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$registeredData = mysqli_fetch_assoc($result);


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
                <li><a href="csservice_admin.php"><i class="glyphicon glyphicon-plus"></i> Add Services</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-link"></i> Links</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Reports</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-book"></i> Books</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Tools</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-time"></i> Real-time</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-plus"></i> Advanced..</a></li>
                <li><a href="cslogin.html"><i class="glyphicon glyphicon-lock"></i> LogOut</a></li>
            </ul>
            <hr>
        </div><!-- /span-3 -->
        <!-- main content -->
        <main class="col-md-4">
            <div class="container" style="max-width: 250%;">
                <?php
                // Explode the services
                $services = isset($registeredData['services']) ? explode(',', $registeredData['services']) : array();

                // Loop through each service and generate the UI
                foreach ($services as $service) {
                    // Modify the code where the durationperservice is retrieved to ensure it's numeric
                    $durationperservice = isset($registeredData['durationperservice']) ? intval($registeredData['durationperservice']) : 0;
                
                    // Then, use $durationperservice in the HTML template:
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading">' . $service . '</div>';
                    echo '<div class="panel-body" style="margin-bottom: 10px;">';
                    echo '<div style="margin-bottom: 10px;" id="timer_' . strtolower(str_replace(' ', '_', $service)) . '">Duration: ' . formatTime($durationperservice * 60) . '</div>';
                    echo '<button type="button" class="btn btn-success start-btn">Start</button>';
                    echo '<button type="button" class="btn btn-warning done-btn" style="margin-left: 10px;">Done</button>';
                    echo '</div>';
                    echo '</div>';
                }
                

                // Function to format time as "00:00"
                function formatTime($time) {
                    $minutes = floor($time / 60);
                    $seconds = $time % 60;
                    return sprintf("%02d:%02d", $minutes, $seconds);
                }
                ?>
            </div>
        </main>
        </div><!-- /row -->
        </div><!-- /container -->

        <script>
            // Function to parse time from "MM:SS" format

            function parseTime(timeString) {
                const parts = timeString.split(":");
                if (parts.length === 2) {
                    const minutes = parseInt(parts[0]);
                    const seconds = parseInt(parts[1]);
                    if (!isNaN(minutes) && !isNaN(seconds)) {
                        return minutes * 60 + seconds;
                    }
                }
                return 0; // Return 0 if parsing fails
            }


            // Function to format time as "MM:SS"
            function formatTime(time) {
                const minutes = Math.floor(time / 60);
                const seconds = time % 60;
                return `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }

            // Function to start the countdown timer
            function startTimer(btn) {
                const serviceId = btn.parentNode.parentNode.id;
                const timerDiv = document.getElementById(serviceId);
                let time = parseTime(timerDiv.textContent); // Parse the initial time from the timer div content

                const timerInterval = setInterval(() => {
                    // Update the timer div content with the formatted time
                    timerDiv.textContent = formatTime(time);
                    time--;

                    if (time < 0) {
                        clearInterval(timerInterval);
                        timerDiv.textContent = 'Time Up!';
                    }
                }, 1000);
            }

            // Add event listeners for the buttons
            document.querySelectorAll('.start-btn').forEach(item => {
                item.addEventListener('click', event => {
                    item.textContent = 'Ongoing';
                    item.disabled = true;
                    // Start the countdown timer
                    startTimer(item);
                });
            });

            document.querySelectorAll('.done-btn').forEach(item => {
                item.addEventListener('click', event => {
                    item.textContent = 'Done';
                    item.disabled = true;
                });
            });

            document.querySelectorAll('.pending-btn').forEach(item => {
                item.addEventListener('click', event => {
                    item.textContent = 'Pending';
                    item.disabled = true;
                });
            });
        </script>



        

                




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <!-- jQuery -->
        <script src="path/to/jquery/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="path/to/bootstrap/js/bootstrap.min.js"></script>
    </body>


</html>