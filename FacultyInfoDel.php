<?php
include('includes/connect.php');


if (isset($_GET['FacultyInfoID'])) {
  $sql = "Delete from facultyinfo where FacultyInfoID=" . $_GET["FacultyInfoID"];
  if ($conn->query($sql) === true) {
    header("location: FacultyInfo1.php?message=Record Deleted SuccessFully");
  } else {
    echo " Message doesn't Deleted ";
  }

}
?>