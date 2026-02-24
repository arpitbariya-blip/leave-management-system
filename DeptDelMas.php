<?php
include('includes/connect.php');


if (isset($_GET['DeptID'])) {
  $sql = " UPDATE departmentmaster set Flag=1 WHERE DeptID=" . $_GET['DeptID'];

  if ($conn->query($sql) === TRUE) {
    header("location: DepartmentMas.php?message=Record Deleted SuccessFully");
  } else {
    echo " Message doesn't Deleted ";
  }
}
?>