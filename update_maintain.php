<?php
  include "connection.php";
  include "connection_details.php";
  $id = $_GET['iid'];
  $sql = "SELECT * FROM maintenance WHERE insurance_id = '$id'";
  $result = mysqli_query($data,$sql);
  $info = $result->fetch_assoc();

  if(isset($_POST['update_maintenance'])){
    $iid = $_POST['insuranceid'];
    $bid = $_POST['busid'];
    $stat = $_POST['status'];
    $lm = $_POST['lastmaintain'];
    $nm = $_POST['nextmaintain'];
    $query = "UPDATE maintenance set bus_id = '$bid' , status = '$stat', last_maintain = '$lm', next_maintain ='$nm' WHERE insurance_id = '$id'";
    $result2 = mysqli_query($data, $query);
    if($result2){
      header("location:view_maintenance.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Update Maintenance Records</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">   
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
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
              <h3>Update Maintainence Records</h3>
              <div>
                <form action="#" method="POST">
                  <div>
                    <label>Insurance ID</label>
                    <input type="number" name="insuranceid" value="<?php
                    echo "{$info['insurance_id']}";
                    ?>" disabled required>
                  </div>
                  <div>
                    <label>Bus ID</label>
                    <input type="number" name="busid" value="<?php
                    echo "{$info['bus_id']}";
                    ?>" required>
                  </div>                  
                  <div>
                    <label for="status">Status</label>
                    <select id="status" name="status">
                      <option value="active" <?php if($info['status'] == "active") echo "selected"; ?>>Active</option>
                      <option value="inactive" <?php if($info['status'] == "inactive") echo "selected"; ?>>Inactive</option>
                    </select>
                  </div>

                  <div>
                    <label>Last Maintainence Date</label>
                    <input type="date" name="lastmaintain" value="<?php
                    echo "{$info['last_maintain']}";
                    ?>" required>
                  </div>
                  <div>
                    <label>Next Maintainence Date</label>
                    <input type="date" name="nextmaintain" value="<?php
                    echo "{$info['next_maintain']}";
                    ?>" required>
                  </div>
                  <div>
                    <input type="submit" name="update_maintenance" value="Update" class="submit-btn">
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