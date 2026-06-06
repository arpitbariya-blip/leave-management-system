<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

$YearID = $_POST["YearID"];

$stmt = $conn->prepare("UPDATE yearmaster SET Flag=1 WHERE YearID=?");
$stmt->bind_param("i", $YearID);

if($stmt->execute()){
  echo 1;
}else{
  echo 0;
}
$stmt->close();

?>
