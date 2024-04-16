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
  $id = $_GET['empid'];
  $sql = "SELECT * FROM employee WHERE emp_id = '$id'";
  $result = mysqli_query($data,$sql);
  $info = $result->fetch_assoc();

  if(isset($_POST['update_employee'])){
    $ed = $_POST['empid'];
    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $db = $_POST['dateofbirth'];
    $tp = $_POST['typeofwork'];
    $gsel = $_POST['genderselect'];
    $lnum = $_POST['licensenumber'];
    $pn = $_POST['phoneno'];
    $ms = $_POST['monthlysalary'];
    $query = "UPDATE employee set first_name = '$fn' , last_name = '$ln', dob = '$db', type='$tp', gender = '$gsel', license_number = '$lnum', phone_no = '$pn', salary = '$ms' WHERE emp_id = '$id'";
    $result2 = mysqli_query($data, $query);
    if($result2){
      header("location:view_employee.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Local Bus - Update Employee</title>
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
    <div class="hero-wrap" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center">
          	<aside>
              <ul class="bus-aside">
                <li><a href="add_employee.php">Add Employee</a></li>
                <li><a href="view_employee.php">View Employee</a></li>
              </ul>
            </aside>

            <div class="col side-text-viewemp">
              <h3>Update Employee</h3>
              <div>
                <form action="#" method="POST">
                  <div>
                    <label>Employee ID</label>
                    <input type="number" name="empid" value="<?php
                    echo "{$info['emp_id']}";
                    ?>" disabled required>
                  </div>
                  <div>
                    <label>First Name</label>
                    <input type="text" name="firstname" value="<?php
                    echo "{$info['first_name']}";
                    ?>" required>
                  </div>
                  <div>
                    <label>Last name</label>
                    <input type="text" name="lastname" value="<?php
                    echo "{$info['last_name']}";
                    ?>">
                  </div>
                  <div>
                    <label>Date of Birth</label>
                    <input type="date" name="dateofbith" value="<?php
                    echo "{$info['dob']}";
                    ?>" required>
                  </div>

                  <div>
                    <label for="type">Type</label>
                    <select id="type" name="typeofwork">
                      <option value="driver" <?php if($info['type'] == "driver") echo "selected"; ?>>Driver</option>
                      <option value="conductor" <?php if($info['type'] == "conductor") echo "selected"; ?>>Conductor</option>
                      <option value="both" <?php if($info['type'] == "both") echo "selected"; ?>>Both</option>
                    </select>
                  </div>


                  <div class="gender-view">
                    <label style="margin-left: 250px;">Gender</label>
                    <div>
                        <input type="radio" value="male" name="genderselect" <?php if($info['gender'] == "male") echo "checked"; ?> required>
                        <label for="male">Male</label>
                    </div>

                    <div>
                        <input type="radio" value="female" name="genderselect" <?php if($info['gender'] == "female") echo "checked"; ?> required>
                        <label for="female">Female</label>
                    </div>                    
                </div>


                  <div>
                    <label>License Number</label>
                    <input type="text" name="licensenumber" value="<?php
                    echo "{$info['license_number']}";
                    ?>">
                  </div>
                  <div>
                    <label>Phone Number</label>
                    <input type="number" name="phoneno" value="<?php
                    echo "{$info['phone_no']}";
                    ?>">
                  </div>
                  <div>
                    <label>Salary</label>
                    <input type="number" name="monthlysalary" value="<?php
                    echo "{$info['salary']}";
                    ?>"required>
                  </div>
                  <div>
                    <input type="submit" name="update_employee" value="Update" class="submit-btn">
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