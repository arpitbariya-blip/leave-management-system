<?php
include('../includes/auth_check.php');
include('../includes/connect.php');
$str = "";
if ($_POST['type'] == "") {
	$sql = "SELECT * FROM departmentmaster WHERE Flag=0";

	$query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
	while ($row = mysqli_fetch_assoc($query)) {
        $safeId = htmlspecialchars($row['DeptID'], ENT_QUOTES, 'UTF-8');
        $safeName = htmlspecialchars($row['DeptName'], ENT_QUOTES, 'UTF-8');
		$str .= "<option value='{$safeId}'>{$safeName}</option>";
	}
} else if ($_POST['type'] == "FacultyData") {

	$stmt = $conn->prepare("SELECT * FROM facultyinfo WHERE DeptID = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
	$query = $stmt->get_result();
	$str = "<option value=''>-----Faculty Name-----</option>";
	while ($row = $query->fetch_assoc()) {
        $safeId = htmlspecialchars($row['FacultyInfoID'], ENT_QUOTES, 'UTF-8');
        $safeName = htmlspecialchars($row['FacultyName'], ENT_QUOTES, 'UTF-8');
		$str .= "<option value='{$safeId}'>{$safeName}</option>";
	}
    $stmt->close();
}

echo $str;
?>