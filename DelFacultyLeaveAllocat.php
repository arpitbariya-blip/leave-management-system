<?php
include('includes/connect.php');
if (isset($_GET['FacultyLeaveAllocationID'])) {
  $sql = "Delete from facultyleaveallocation where FacultyLeaveAllocationID=" . $_GET["FacultyLeaveAllocationID"];
  if ($conn->query($sql) === TRUE) {
    header("location: FacultyLeaveAllocation1.php?message=Record Deleted SuccessFully");
  } else {
    echo " Message doesn't Deleted ";
  }
}
?>