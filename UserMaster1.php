<!doctype html>
<?php
$UserMasterID = $_POST["UserMasterID"];

$conn = mysqli_connect("localhost","root","","leavemgmt") or die("Connection Failed");
$sql ="SELECT UserMasterID,UserName,Password,UserType,DeptName FROM usermaster INNER JOIN departmentmaster ON usermaster.DeptID=departmentmaster.DeptID where UserMasterID=$UserMasterID";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
      <td width='90px'>UserType:</td>
      <td><input type='text' readonly id='edit-utype' value='{$row["UserType"]}'>
          <input type='text' id='edit-id' hidden value='{$row["UserMasterID"]}'>
      </td>
    </tr>
    <tr>
      <td width='90px'>UserName:</td>
      <td><input type='text' id='edit-name' value='{$row["UserName"]}'>
      </td>
    </tr>
    <tr>
      <td width='90px'>Department name:</td>
      <td><input type='text' id='edit-Dname' readonly value='{$row["DeptName"]}'>
      </td>
    </tr>
    <tr>
      <td width='90px'>Password:</td>
      <td><input type='text' id='edit-pass' value='{$row["Password"]}'>
      </td></tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='save'></td>
    </tr>";

  }

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}
?>