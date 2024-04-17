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
  $id = $_GET['busid'];
  $sql = "SELECT * FROM bus WHERE bus_id = '$id'";
  $result = mysqli_query($data,$sql);
  $info = $result->fetch_assoc();

  if(isset($_POST['update_bus'])){
    echo "isset";
    $busid = $_POST['bid'];
    $busname = $_POST['bname'];
    $model = $_POST['model'];
    $cap = $_POST['cap'];
    $owner = $_POST['own'];
    $di = $_POST['did'];
    $query = "UPDATE bus set bus_name = '$busname', model = '$model', capacity='$cap', ownership ='$owner', depot_id = '$di' WHERE bus_id = '$id'";
    
    $result2 = mysqli_query($data, $query);
    if($result2){
      header("location:view_bus.php");
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Bus Update</title>
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
                <li><a href="update_bus.php">View bus</a></li>
              </ul>
            </aside>
          <div class="col-lg-6 col side-text" style="color: black;">
            <h3>Update Bus</h3>
            <div>
              <form action="#" method="POST">
                <div>
                  <label>Bus ID</label>
                  <input type="number" name="bid" value="<?php
                  echo "{$info['bus_id']}";
                  ?>" disabled>
                </div>
                <div>
                  <label>Bus Name</label>
                  <input type="text" name="bname" value="<?php
                  echo "{$info['bus_name']}";
                  ?>">
                </div>
                <div>
                  <label>Model</label>
                  <input type="text" name="model" value="<?php
                  echo "{$info['model']}";
                  ?>">
                </div>
                <div>
                  <label>Capacity</label>
                  <input type="number" name="cap" value="<?php echo "{$info['capacity']}";?>">
                </div>
                <div>
                  <label>Ownership</label>
                  <input type="radio" name="own" value="Public" <?php if ($info['ownership'] == "Public") echo "checked"; ?>>Public
                  <input type="radio" name="own" value="Private" <?php if ($info['ownership'] == "Private") echo "checked"; ?>>Private
                </div>
                <div>
                  <label>Depot ID</label>
                  <input type="number" name="did" value="<?php echo "{$info['depot_id']}";?>">
                </div>
                <div>
                  <input type="submit" name="update_bus" value="Update" class="submit-btn">
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