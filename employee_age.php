<?php
error_reporting(0);
include "connection.php";
include "connection_details.php";
$sql = "SELECT * FROM employee_age";
$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Sort Employee By Salary</title>
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
	          <li class="nav-item active"><a href="employee.php" class="nav-link">Employee</a></li>
	          <li class="nav-item"><a href="route.php" class="nav-link">Routes & Schedules</a></li>
	          <li class="nav-item"><a href="ticket.php" class="nav-link">Tickets</a></li>
	          <li class="nav-item"><a href="maintenance.php" class="nav-link">Maintenance</a></li>
	        </ul>
	      </div>
        <div>
          <a href="login.php" class="bms-login-btn">Logout</a> 
         </div>
	    </div>
	  </nav>
    <!-- END nav -->
    <div class="hero-wrap" style="background-image: url('images/bg_3.jpg'); height: 2750px !important;" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          	<aside>
              <ul class="bus-aside-emp" style="margin-top:194px !important;">
                <li><a href="add_employee.php">Add Employee</a></li>
                <li><a href="view_employee.php">View Employee</a></li>
                <li><a href="sortby_firstname.php">Sort by Name</a></li>
                <li><a href="sortby_salary.php">Sort by Salary</a></li>
                <li><a href="employee_age.php">Employee age</a></li>
              </ul>
            </aside>
            <div class="side-text-viewempdata" style ="margin-left:25%">
           <h3>Employee Data</h3>
           <?php
           if($_SESSION['message']){
            echo $_SESSION['message'];
           }
           unset($_SESSION['message']);
           ?>
           <table border="1.5px">
            <tr>
              <th class="table_th">Employee ID</th>
              <th class="table_th">First Name</th>
              <th class="table_th">Last Name</th>
              <th class="table_th">Age</th>
            </tr>

            <?php
            while($info = $result -> fetch_assoc()){            
            ?>
              <tr>
                <td class="table_td"><?php echo "{$info['emp_id']}"; ?></td>
                <td class="table_td"><?php echo "{$info['first_name']}"; ?></td>
                <td class="table_td"><?php echo "{$info['last_name']}"; ?></td>
                <td class="table_td"><?php echo "{$info['age']}"; ?></td>
            </tr>
            <?php
            }
            ?>
           </table>
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
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>
  </body>
</html>