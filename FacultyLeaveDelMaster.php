<?php
include('includes/connect.php');


if (isset($_GET['FacultyLeaveMasterID'])) {
  $sql = "Delete from facultyleavemaster where FacultyLeaveMasterID=" . $_GET["FacultyLeaveMasterID"];
  if ($conn->query($sql) === true) {
    header("location: FacultyLeaveMas.php?message=Record Deleted SuccessFully");

  } else {
    echo " Message doesn't Deleted ";
  }
}
?>