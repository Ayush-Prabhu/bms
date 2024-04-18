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
$rid=null;

if(!empty($_POST['route_i'])){
  $rid=$_POST['route_i'];
}
$str="DROP PROCEDURE IF EXISTS scheduleview";
$res=mysqli_query($data,$str);
$sql = "
    CREATE PROCEDURE scheduleview()
    BEGIN
      DECLARE done INT DEFAULT FALSE;
      DECLARE s_id,r_id,b_id,c_id,d_id INT;
      DECLARE strt,stp TIME;
      DECLARE cur CURSOR FOR SELECT * FROM schedule;
      DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

      OPEN cur;

      read_loop: LOOP
        FETCH cur INTO s_id,r_id,strt,stp,b_id,c_id,d_id;
        IF done THEN
          LEAVE read_loop;
        END IF;
        -- Do something with the row fetched
        SELECT s_id,r_id,strt,stp,b_id,c_id,d_id;

      END LOOP;

      CLOSE cur;
    END;
";

mysqli_query($data,$sql);
$sql = "CALL scheduleview()";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Schedules</title>
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
	      <a class="navbar-brand" href="index.php">Local<span>Bus</span></a>
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
              <li><a href="route.php">Add Route</a></li>
              <li><a href="view_route.php">View Routes</a></li>
              <li><a href="schedule.php">Add Schedule</a></li>
              <li><a href="view_schedule.php">Find Schedules</a></li>
              <li><a href="delete_schedule.php">Delete Schedule</a></li><!--pending-->
            </ul>
          </aside>
          <div class="col-lg-6 col side-text">
            <h3>Schedule</h3>
            <div>
              <div class="col-lg-6 col side-text-addcontent">
                <form action="view_schedule.php" method="POST">
                  <label>Route id:</label><br>
                  <input type="text" name="route_i" placeholder="Enter route id"required>
                </form>
                  <?php
                  if(isset($rid)&&$result = mysqli_query($data,"SELEcT * from schedule where route_id=".$rid )){
                    ?>
                    <table border="1.5px" bgcolor="cyan">
                  <tr>
                    <th class="table_th">Schedule ID</th>
                    <th class="table_th">Route ID</th>
                    <th class="table_th">Bus ID</th>
                    <th class="table_th">Start Time</th>
                    <th class="table_th">Stop Time</th>
                    <th class="table_th">Conductor</th>
                    <th class="table_th">Driver</th>
                  </tr>
                    <?php
                  while( $info=$result -> fetch_assoc()){   
                    ?>
                    <tr>
                      <td class="table_td"><?php echo "{$info['schedule_id']}"; ?></td>
                      <td class="table_td"><?php echo "{$info['route_id']}"; ?></td>
                      <td class="table_td"><?php echo "{$info['bus_id']}"; ?></td>
                      <td class="table_td"><?php echo "{$info['start_time']}"; ?></td>
                      <td class="table_td"><?php echo "{$info['stop_time']}"; ?></td>
                      <td class="table_td"><?php echo "{$info['c_id']}"; ?></td>
                      <td class="table_td"><?php echo "{$info['d_id']}"; ?></td>
                      </tr>
                      <?php            
                    }
                  }
                      ?>
                  
                </table>
                </div>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>