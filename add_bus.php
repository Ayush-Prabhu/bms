<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);
if(isset($_POST['add_bus'])){
  $busid = $_POST['bus_id'];
  $busname = $_POST['bus_name'];
  $mod = $_POST['model'];
  $cap = $_POST['capacity'];
  $owner = $_POST['ownership'];
  $di = $_POST['depot_id'];

  $check = "SELECT bus_id FROM bus WHERE bus_id = '$busid'";
  $check_user = mysqli_query($data, $check);
  $row_count = mysqli_num_rows($check_user);
  if($row_count == 1){
    echo "<script type = 'text/javascript'>
      alert('Bus ID already exists')
      </script>";
  }
  else{
    $sql = "INSERT INTO bus(bus_id, bus_name, model, capacity, ownership, depot_id) values('$busid', '$busname', '$mod', '$cap', '$owner', '$di' )";
    $result = mysqli_query($data, $sql);
    if($result){
      echo "<script type = 'text/javascript'>
      alert('Bus added successfully')
      </script>";
    }
    else{
      echo "<script type = 'text/javascript'>
      alert('Bus add failed')
      </script>";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Add Bus</title>
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bms-bus.css">
    <link rel="stylesheet" href="css/bmscss.css">
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
	          <li class="nav-item active"><a href="bus.php" class="nav-link">Bus</a></li>
	          <li class="nav-item"><a href="employee.php" class="nav-link">Employee</a></li>
	          <li class="nav-item"><a href="route.php" class="nav-link">Routes & Schedules</a></li>
	          <li class="nav-item"><a href="ticket.php" class="nav-link">Tickets</a></li>
	          <li class="nav-item"><a href="maintenance.php" class="nav-link">Maintenance</a></li>
	        </ul>
	      </div>
        <div>
          <a href="log.php" class="bms-login-btn">Logout</a> 
        </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          	<aside>
              <ul class="bus-aside">
                <li><a href="add_depot.php">Add Depot</a></li>
                <li><a href="view_depot.php">View Depot</a></li>
                <li><a href="add_bus.php">Add bus</a></li>
                <li><a href="view_bus.php">View bus</a></li>
              </ul>
            </aside>
          <div class="col-lg-6 col side-text">
            <h3>Add Bus</h3>
            <div>
              <form action="#" method="POST">
              <div>
                  <label>Bus ID</label>
                  <input type="number" name="bus_id">
                </div>
                <div>
                  <label>Bus Name</label>
                  <input type="text" name="bus_name">
                </div>
                <div>
                  <label>Bus Model</label>
                  <input type="text" name="model">
                </div>
                <div>
                  <label>Capacity</label>
                  <input type="number" name="capacity">
                </div>
                <div class="radio-btn">
                  <label style="font-weight:700; font-size:16px;">Ownership</label>
                  <div class="rad">
                  <input type="radio" name="ownership" value="public">Public
                  <input type="radio" name="ownership" value="private">Private
                  </div>
                </div>
                <div>
                  <label>Depot ID</label>
                  <input type="number" name="depot_id">
                </div>
                <div>
                  <input type="submit" name="add_bus" value="Add Bus" class="submit-btn">
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
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>