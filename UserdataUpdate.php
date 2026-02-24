<?php
$conn = mysqli_connect("localhost","root","","leavemgmt") or die("Connection Failed");

          $UserName=$_POST["UserName"];
          $Password=$_POST["Password"];
          $UserType=$_POST["UserType"];
          $DeptName=$_POST["DeptName"];
          $sql="Update usermaster set UserName='".$UserName."',Password='".$Password."',UserType='".$UserType."',DeptID='".$DeptName."' where UserMasterID=".$_POST["UserMasterID"];
          
if(mysqli_query($conn, $sql)){
  echo 1;
}else{
  echo 0;
}

?>