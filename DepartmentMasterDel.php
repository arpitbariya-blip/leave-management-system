
 
<?php
include('includes/connect.php');

$DeptID = $_POST["DeptID"];

$sql = "UPDATE departmentmaster set Flag=1 WHERE DeptID=$DeptID";

if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
