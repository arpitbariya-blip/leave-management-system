
 
<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

$DeptID = $_POST["DeptID"];

$stmt = $conn->prepare("UPDATE departmentmaster SET Flag=1 WHERE DeptID=?");
$stmt->bind_param("i", $DeptID);

if ($stmt->execute()) {
  echo 1;
} else {
  echo 0;
}
$stmt->close();

?>
