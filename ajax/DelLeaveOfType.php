<?php
include('../includes/auth_check.php');
include('../includes/connect.php');


if (isset($_GET['TypeOfLeaveID'])) {
  $stmt = $conn->prepare("UPDATE typeofleave SET Flag=1 WHERE TypeOfLeaveID=?");
  $stmt->bind_param("i", $_GET['TypeOfLeaveID']);
  if ($stmt->execute()) {
    $stmt->close();
    header("location: LeaveOfType1.php?message=Record Deleted SuccessFully");
    exit;
  } else {
    echo " Message doesn't Deleted ";
  }
}
?>