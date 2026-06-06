<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

if (isset($_GET['DeptID'])) {
  $stmt = $conn->prepare("UPDATE departmentmaster SET Flag=1 WHERE DeptID=?");
  $stmt->bind_param("i", $_GET['DeptID']);

  if ($stmt->execute()) {
    $stmt->close();
    header("location: DepartmentMas.php?message=Record Deleted SuccessFully");
    exit;
  } else {
    echo " Message doesn't Deleted ";
  }
}
?>