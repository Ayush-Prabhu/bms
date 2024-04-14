<?php
error_reporting(0);
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "bms";
$data = mysqli_connect($host, $user, $password, $db);

if($data === false){
  die("Connection Error");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = $_POST['username'];
  $pass = $_POST['password'];
  $sql = "select * from user where username = '".$name."' and password = '".$pass."'";
  $result = mysqli_query($data, $sql);
  $row = mysqli_fetch_array($result);
  if($row["usertype"] == "admin"){   
    $_SESSION['username'] = $name;
    $_SESSION['usertype'] = "admin";
    header("location:index.php");
  }
  else{
    $message = "Invalid username or password";
    $_SESSION['loginMessage'] = $message;
    header("location:login.php");
  }
}


?>