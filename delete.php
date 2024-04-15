<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);

if($_GET['depotid']){
$did = $_GET['depotid'];
$sql = "DELETE FROM depot where depot_id = '$did'";
$result =  mysqli_query($data, $sql);
if($result){
  $_SESSION['message'] = 'Delete depot successful';
  header("location:view_depot.php");
}
}
?>