<?php
include('includes/connect.php');


if (isset($_GET['TypeOfLeaveID'])) {
  $sql = " UPDATE typeofleave set Flag=1 WHERE TypeOfLeaveID=" . $_GET['TypeOfLeaveID'];
  if ($conn->query($sql) === TRUE) {

    header("location: LeaveOfType1.php?message=Record Deleted SuccessFully");

  } else {
    echo " Message doesn't Deleted ";
  }
}
?>