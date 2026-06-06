<?php
include('../includes/auth_check.php');
include('../includes/connect.php');
$UserMasterID=$_POST['UserMasterID'];

if (isset($UserMasterID)) {
  $stmt = $conn->prepare("DELETE FROM usermaster WHERE UserMasterID=?");
  $stmt->bind_param("i", $UserMasterID);
  if ($stmt->execute()) {
   echo 1;
  } else {
    echo 0;
  }
  $stmt->close();
}
?>