<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

if (isset($_GET['FacultyLeaveMasterID'])) {
  $stmt = $conn->prepare("DELETE FROM facultyleavemaster WHERE FacultyLeaveMasterID=?");
  $stmt->bind_param("i", $_GET["FacultyLeaveMasterID"]);
  if ($stmt->execute()) {
    $stmt->close();
    header("location: FacultyLeaveMas.php?message=Record Deleted SuccessFully");
    exit;
  } else {
    echo " Message doesn't Deleted ";
  }
}
?>