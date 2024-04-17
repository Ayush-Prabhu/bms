
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
if(isset($_POST['add_route'])){
  $routeid = $_POST['route_id'];
  $start_point= $_POST['start_point'];
  $stop_point= $_POST['stop_point'];
  $distance=$_POST['distance'];
  $no_of_stops = $_POST['no_of_stops'];

  $check = "SELECT route_id FROM route WHERE route_id = '$routeid'";
  $check_user = mysqli_query($data, $check);
  $row_count = mysqli_num_rows($check_user);
  if($row_count == 1){
    echo "<script type = 'text/javascript'>
      alert('Route exists')
      </script>";
  }
  else{
    $sql = "INSERT INTO route(route_id, start_point, stop_point, distance, no_of_stops) values('$routeid', '$start_point','$stop_point' ,'$distance','$no_of_stops')";
    $result = mysqli_query($data, $sql);
    if($result){
      echo "<script type = 'text/javascript'>
      alert('Route added successfully')
      </script>";
    }
    else{
      echo "<script type = 'text/javascript'>
      alert('Insertion Failed')
      </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Routes</title>
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
	          <li class="nav-item active"><a href="route.php" class="nav-link">Routes & Schedules</a></li>
	          <li class="nav-item"><a href="ticket.php" class="nav-link">Tickets</a></li>
	          <li class="nav-item"><a href="maintenance.php" class="nav-link">Maintenance</a></li>
	        </ul>
	      </div>
	  </nav>
    <!-- END nav -->
    
    <div class="hero-wrap" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          <aside>
            <ul class="bus-aside">
              <li><a href="#insert_route_form">Add Route</a></li>
              <li><a href="view_route.php">View Route</a></li>
              <li><a href="schedule.php">Add Schedule</a></li>
              <li><a href="view_schedule.php">View Schedules</a></li>
              <li><a href="delete_schedule.php">Delete Schedule</a></li><!--pending-->
            </ul>
          </aside>
          <div class="col-lg-6 col side-text">
            <h3>Add Route</h3>
            <div>
              <form action="route.php" method="POST" id="insert_route_form">
                <div>
                  <label class="label-deg">Route ID</label>
                  <input type="text" name="route_id" placeholder="Enter route id">
                </div>
                <div>
                  <label class="label-deg">Start Point</label>
                  <input type="text" name="start_point" placeholder="Enter start point">
                </div>
                <div>
                  <label class="label-deg">Stop Point</label>
                  <input type="text" name="stop_point" placeholder="Enter stop point">
                </div>
                <div>
                  <label class="label-deg">Distance</label>
                  <input type="text" name="distance" placeholder="Enter distance">
                </div>
                <div>
                  <label class="label-deg">Number of stops</label>
                  <input type="text" name="no_of_stops" placeholder="Enter number of stops">
                </div>
                <div>
                  <input type="Submit" name="add_route" value="ADD ROUTE">
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