<?php
include('includes/connect.php');
$UserMasterID=$_POST['UserMasterID'];

if (isset($UserMasterID)) {
  $sql = "Delete from usermaster where UserMasterID=$UserMasterID";
  if ($conn->query($sql) === TRUE) {
   echo 1;
  } else {
    echo 0;
  }
}
?>