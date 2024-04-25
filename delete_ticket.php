<?php
session_start();
include "connection_details.php";
if($_GET['ticketid']){
$ticketid = $_GET['ticketid'];
$sql = "DELETE FROM ticket where ticket_id = '$ticketid'";
$result =  mysqli_query($data, $sql);
if($result){
  $_SESSION['message'] = 'Delete ticket successful';
  header("location:view_ticket.php");
}
}
?>