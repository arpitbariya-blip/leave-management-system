<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

if (isset($_GET['FacultyInfoID'])) {
  $stmt = $conn->prepare("DELETE FROM facultyinfo WHERE FacultyInfoID=?");
  $stmt->bind_param("i", $_GET["FacultyInfoID"]);
  
  if ($stmt->execute()) {
    $stmt->close();
    header("location: FacultyInfo1.php?message=Record Deleted SuccessFully");
    exit;
  } else {
    echo " Message doesn't Deleted ";
  }
}
?>