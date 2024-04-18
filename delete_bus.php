<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);
if($_GET['bd']){
$bid = $_GET['bd'];
$sql = "DELETE FROM bus where bus_id = '$bid'";
$result =  mysqli_query($data, $sql);
if($result){
  $_SESSION['message'] = 'Delete bus successful';
  header("location:view_bus.php");
}
}
?>