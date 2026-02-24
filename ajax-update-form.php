<?php

$YearID = $_POST["YearID"];
$Year = $_POST["Year"];

$conn = mysqli_connect("localhost","root","","leavemgmt") or die("Connection Failed");

$sql = "UPDATE yearmaster SET Year = '{$Year}' WHERE YearID = {$YearID}";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
