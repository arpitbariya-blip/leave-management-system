<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

$YearID = $_POST["YearID"];
$Year = $_POST["Year"];

$stmt = $conn->prepare("UPDATE yearmaster SET Year = ? WHERE YearID = ?");
$stmt->bind_param("si", $Year, $YearID);

if($stmt->execute()){
  echo 1;
}else{
  echo 0;
}
$stmt->close();
?>
