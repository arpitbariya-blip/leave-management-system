<?php
include('../includes/auth_check.php');
include('../includes/connect.php');
if (isset($_GET['FacultyLeaveAllocationID'])) {
  $stmt = $conn->prepare("DELETE FROM facultyleaveallocation WHERE FacultyLeaveAllocationID=?");
  $stmt->bind_param("i", $_GET["FacultyLeaveAllocationID"]);
  if ($stmt->execute()) {
    $stmt->close();
    header("location: FacultyLeaveAllocation1.php?message=Record Deleted SuccessFully");
    exit;
  } else {
    echo " Message doesn't Deleted ";
  }
}
?>