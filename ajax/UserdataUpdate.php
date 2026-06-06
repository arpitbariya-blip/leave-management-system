<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

          $UserName=$_POST["UserName"];
          $Password=$_POST["Password"];
          $UserType=$_POST["UserType"];
          $DeptName=$_POST["DeptName"];
          $UserMasterID=$_POST["UserMasterID"];
          $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

          $stmt = $conn->prepare("UPDATE usermaster SET UserName=?, Password=?, UserType=?, DeptID=? WHERE UserMasterID=?");
          $stmt->bind_param("ssssi", $UserName, $hashedPassword, $UserType, $DeptName, $UserMasterID);

if($stmt->execute()){
  echo 1;
}else{
  echo 0;
}
$stmt->close();

?>