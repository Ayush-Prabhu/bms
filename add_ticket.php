<?php
include "connection.php";
include "connection_details.php";
if(isset($_POST['add_ticket'])){
                   
  $rid =floor($_POST['src_id']/100);
  $rid1 =floor($_POST['dst_id']/100);
  $srcid = $_POST['src_id'];
  $dstid = $_POST['dst_id'];

  if($rid != $rid1)
    echo "<script type = 'text/javascript'>
    alert('Source and Destination not on same route')
    </script>";
    else{
        $check = "SELECT source_id,destination_id FROM ticket WHERE source_id = '$srcid' and destination_id='$dstid'";
        $check_user = mysqli_query($data, $check);
        $row_count = mysqli_num_rows($check_user);
        $ch="Select route_id from route where route_id='$rid'";
        $check_route = mysqli_query($data, $ch);
        $row_count1=mysqli_num_rows($check_route);
        if($row_count == 1){
            echo "<script type = 'text/javascript'>
            alert('Ticket already exists')
            </script>";
        }
        elseif($row_count1!=1){
            echo "<script type = 'text/javascript'>
            alert('Route does not exist')
            </script>";
        }
        else{
            
            
                $sql = "DROP FUNCTION IF EXISTS gettickid;";
                mysqli_query($data, $sql);

                $sql = "CREATE FUNCTION gettickid(src INT, dst INT)
                    RETURNS INT
                BEGIN
                    DECLARE last_two_digits INT;
                    SET last_two_digits = dst % 100;
                
                    IF last_two_digits < 10 THEN
                        RETURN CONCAT(src, '0', last_two_digits);
                    ELSE
                        RETURN CONCAT(src, last_two_digits);
                    END IF;
                END;";
                mysqli_query($data, $sql);

                $sql = "SELECT gettickid(".$srcid.", ".$dstid.")";
                $result = mysqli_query($data, $sql);

                if ($result) {
                    $row = mysqli_fetch_array($result);
                    $ticketid= $row[0]; // assuming the function returns a single value
                } else {
                    echo "Query failed: " . mysqli_error($data);
                }
                

                $sql = "DROP FUNCTION IF EXISTS getfare;";
                mysqli_query($data, $sql);

                $sql = "CREATE FUNCTION getfare(tid INT)
                    RETURNS INT
                BEGIN
                    DECLARE rid INT;
                    DECLARE dist INT;
                    DECLARE diff INT;
                    DECLARE num INT;
                    SET diff = tid%100-((tid/100)%100);
                
                    SET rid = tid / 10000;
                
                    SELECT distance INTO dist FROM route WHERE route_id = rid;
                    SELECT no_of_stops INTO num FROM route WHERE route_id = rid;
                    RETURN dist * 5*diff/num;
                END;";
                $result=mysqli_query($data, $sql);
                $sql = "SELECT getfare(".$ticketid.")";
                $result = mysqli_query($data, $sql);

                if ($result) {
                    $row = mysqli_fetch_array($result);
                    $fare= abs($row[0]); // assuming the function returns a single value
                } else {
                    echo "Query failed: " . mysqli_error($data);
                }

            $sql = "INSERT INTO ticket(source_id, destination_id, ticket_id, fare) values('$srcid', '$dstid', '$ticketid', '$fare')";
            $result = mysqli_query($data, $sql);
            if($result){
            echo "<script type = 'text/javascript'>
            alert('Ticket added successfully: Fare = $fare Ticket ID = $ticketid');

            </script>";
            }
            else{
            echo "<script type = 'text/javascript'>
            alert('Ticket add failed')
            </script>";
            }
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
	          <li class="nav-item active"><a href="ticket.php" class="nav-link">Tickets</a></li>
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
                <li><a href="add_ticket.php">Add Ticket</a></li>
                <li><a href="view_ticket.php">View Ticket</a></li>
              </ul>
            </aside>
          <div class="col-lg-6 col side-text">
            <h3>Add Ticket</h3>
            <div>
              <form action="#" method="POST">
              <div>
                  <label>Source ID</label>
                  <input type="number" name="src_id" required>
                </div>
                <div>
                  <label>Destination ID</label>
                  <input type="number" name="dst_id" required>
                </div>               
                <div>
                  <input type="submit" name="add_ticket" value="Add Ticket" class="submit-btn">
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
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>
  </body>
</html>