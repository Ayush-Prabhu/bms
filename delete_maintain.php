<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);

if($_GET['iid']){
$id = $_GET['iid'];
$sql = "DELETE FROM maintenance where insurance_id = '$id'";
$result =  mysqli_query($data, $sql);
if($result){
  $_SESSION['message'] = 'Delete maintenance record successful';
  header("location:view_maintenance.php");
}
}
?>