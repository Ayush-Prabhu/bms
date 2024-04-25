<?php
session_start();
include "connection_details.php";
if($_GET['empid']){
$eid = $_GET['empid'];
$sql = "DELETE FROM employee where emp_id = '$eid'";
$result =  mysqli_query($data, $sql);
if($result){
  $_SESSION['message'] = 'Delete employee successful';
  header("location:view_employee.php");
}
}
?>