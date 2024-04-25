<?php
session_start();
include "connection_details.php";
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