<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

$UserMasterID = $_POST["UserMasterID"];

$stmt = $conn->prepare("SELECT UserMasterID,UserName,Password,UserType,DeptName FROM usermaster INNER JOIN departmentmaster ON usermaster.DeptID=departmentmaster.DeptID WHERE UserMasterID=?");
$stmt->bind_param("i", $UserMasterID);
$stmt->execute();
$result = $stmt->get_result();
$output = "";
if($result && mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
      <td width='90px'>UserType:</td>
      <td><input type='text' readonly id='edit-utype' value='" . htmlspecialchars($row["UserType"], ENT_QUOTES, 'UTF-8') . "'>
          <input type='text' id='edit-id' hidden value='" . htmlspecialchars($row["UserMasterID"], ENT_QUOTES, 'UTF-8') . "'>
      </td>
    </tr>
    <tr>
      <td width='90px'>UserName:</td>
      <td><input type='text' id='edit-name' value='" . htmlspecialchars($row["UserName"], ENT_QUOTES, 'UTF-8') . "'>
      </td>
    </tr>
    <tr>
      <td width='90px'>Department name:</td>
      <td><input type='text' id='edit-Dname' readonly value='" . htmlspecialchars($row["DeptName"], ENT_QUOTES, 'UTF-8') . "'>
      </td>
    </tr>
    <tr>
      <td width='90px'>Password:</td>
      <td><input type='text' id='edit-pass' value='" . htmlspecialchars($row["Password"], ENT_QUOTES, 'UTF-8') . "'>
      </td></tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='save'></td>
    </tr>";

  }

    $stmt->close();

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}
?>