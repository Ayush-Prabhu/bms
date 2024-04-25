<?php
include "connection.php";
include "connection_details.php";
if(isset($_POST['add_maintenance'])){
    $iid = $_POST['insuranceid'];
    $bid = $_POST['busid'];
    $stat = $_POST['status'];
    $lm = $_POST['lastmaintain'];
    $nm = $_POST['nextmaintain'];
    $check_bus = "SELECT * FROM bus WHERE bus_id = '$bid'";
    $bus_result = mysqli_query($data, $check_bus);
    $bus_exists = mysqli_num_rows($bus_result);
    if($bus_exists > 0) { 
        $check_insurance = "SELECT insurance_id FROM maintenance WHERE insurance_id = '$iid'";
        $check_insurance_result = mysqli_query($data, $check_insurance);
        $insurance_exists = mysqli_num_rows($check_insurance_result);

        if($insurance_exists == 0) {
            $sql = "INSERT INTO maintenance(insurance_id, bus_id, status, last_maintain, next_maintain) values('$iid', '$bid','$stat','$lm','$nm')";
            $result = mysqli_query($data, $sql);
            if($result){
                $monthsLeft = monthsUntilNextMaintenance($lm, $nm);
                echo "<script type='text/javascript'>alert('Maintenance record added successfully. $monthsLeft months left before next maintenance: ')</script>";
            } else {
                echo "<script type='text/javascript'>alert('Maintenance record add failed')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Insurance ID already exists')</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Bus ID does not exist')</script>";
    }
}

function monthsUntilNextMaintenance($lastMaintenanceDate, $nextMaintenanceDate) {
    $lastMaintenance = new DateTime($lastMaintenanceDate);
    $nextMaintenance = new DateTime($nextMaintenanceDate);
    $interval = $lastMaintenance->diff($nextMaintenance);
    $months = ($interval->format('%y') * 12) + $interval->format('%m');
    return $months;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Add Maintenance Records</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bmscss.css">
    <link rel="stylesheet" href="css/bms-bus.css">
  </head>
  <body>
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Local<span>Bus</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
				<div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="bus.php" class="nav-link">Bus</a></li>
	          <li class="nav-item"><a href="employee.php" class="nav-link">Employee</a></li>
	          <li class="nav-item"><a href="route.php" class="nav-link">Routes & Schedules</a></li>
	          <li class="nav-item"><a href="ticket.php" class="nav-link">Tickets</a></li>
	          <li class="nav-item active"><a href="maintenance.php" class="nav-link">Maintenance</a></li>
	        </ul>
	      </div>
        <div>
          <a href="login.php" class="bms-login-btn">Logout</a> 
         </div>
	    </div>
	  </nav>
    <!-- END nav -->
    <div class="hero-wrap" style="background-image: url('images/bg_6.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          	<aside>
              <ul class="bus-aside">
              <li><a href="add_maintenance.php">Add Maintenance Records</a></li>
              <li><a href="view_maintenance.php">View Maintenance Records</a></li>
              </ul>
            </aside>
            <div class="col side-text-viewemp">
            <h3>Add Maintenance Records</h3>
            <div>
              <form action="#" method="POST">
              <div>
                  <label>Insurance ID</label>
                  <input type="number" name="insuranceid" required>
                </div>
                <div>
                  <label>Bus ID</label>
                  <input type="number" name="busid" required>
                </div>
                <div>
                  <label for="status">Status</label>
                  <select id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </div>
                <div>
                  <label>Last Maintenance Date</label>
                  <input type="date" name="lastmaintain" required>
                </div>
                <div>
                <div>
                  <label>Next Maintenance Date</label>
                  <input type="date" name="nextmaintain" required>
                </div>
                <div>
                  <input type="submit" name="add_maintenance" value="Add Record" class="submit-btn">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>	


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  <script src="js/jquery.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>  
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>  
  </body>
</html>