<?php

$conn = mysqli_connect("localhost", "root", "", "leavemgmt") or die("Connection failed");
$str = "";
if ($_POST['type'] == "") {
	$sql = "SELECT * FROM departmentmaster WHERE Flag=0";

	$query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
	while ($row = mysqli_fetch_assoc($query)) {
		$str .= "<option value='{$row['DeptID']}'>{$row['DeptName']}</option>";
	}
} else if ($_POST['type'] == "FacultyData") {

	$sql = "SELECT * FROM facultyinfo WHERE DeptID = {$_POST['id']}";

	$query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
	$str = "<option value=''>-----Faculty Name-----</option>";
	while ($row = mysqli_fetch_assoc($query)) {

		$str .= "<option value='{$row['FacultyInfoID']}'>{$row['FacultyName']}</option>";
	}
}

echo $str;
?>