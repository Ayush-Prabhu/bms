<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);

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