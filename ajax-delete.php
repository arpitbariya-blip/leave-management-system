<?php

$YearID = $_POST["YearID"];

$conn = mysqli_connect("localhost","root","","leavemgmt") or die("Connection Failed");

$sql = "UPDATE yearmaster set Flag=1 WHERE YearID=$YearID";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
