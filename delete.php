<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);
if ($_GET['depotid']) {
  $did = $_GET['depotid'];
  $check_sql = "SELECT * FROM bus WHERE depot_id = '$did'";
  $check_result = mysqli_query($data, $check_sql);
  if (mysqli_num_rows($check_result) > 0) {
    $_SESSION['message'] = 'Cannot delete depot. It is referenced by buses.';
    header("location:view_depot.php");
    exit();
  }else {
    $sql = "DELETE FROM depot where depot_id = '$did'";
    $result =  mysqli_query($data, $sql);
    if ($result) {
      $_SESSION['message'] = 'Delete depot successful';
      header("location:view_depot.php");
    }
  }
}
?>