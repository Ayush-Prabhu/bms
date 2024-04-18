<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);

if($_GET['bd']){
$bid = $_GET['bd'];
$sql = "DELETE FROM ticket where ticket_id = '$ticketid'";
$result =  mysqli_query($data, $sql);
if($result){
  $_SESSION['message'] = 'Delete ticket successful';
  header("location:view_ticket.php");
}
}
?>