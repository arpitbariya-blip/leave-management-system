<?php
include('../includes/auth_check.php');
include('../includes/connect.php');
if (!isset($_POST['FacultyID'])) {
  echo "Please Select Faculty Name";
}
if (isset($_POST['LeaveTypeID'])) {


  if ($_POST['LeaveTypeID'] == '2' || $_POST['LeaveTypeID'] == '1' || $_POST['LeaveTypeID'] == '3') {
    if (isset($_POST['FacultyID']) && isset($_POST['LeaveTypeID'])) {
      $TypeOfLeaveID = $_POST['LeaveTypeID'];
      $FacultyInfoID = $_POST['FacultyID'];

      $stmt2 = $conn->prepare("SELECT COUNT(TypeOfLeaveID) as total FROM facultyleaveallocation WHERE TypeOfLeaveID=? AND FacultyInfoID=? GROUP BY TypeOfLeaveID");
      $stmt2->bind_param("ii", $TypeOfLeaveID, $FacultyInfoID);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      $User_data = $result2->fetch_array();
      $stmt2->close();
      if (!isset($User_data['total'])) {
        echo "Remaining Leave is 12";
      }
      $stmt3 = $conn->prepare("SELECT LeaveCount FROM facultyleavemaster WHERE TypeOfLeaveID=? AND FacultyInfoID=?");
      $stmt3->bind_param("ii", $TypeOfLeaveID, $FacultyInfoID);
      $stmt3->execute();
      $result3 = $stmt3->get_result();
      $User_data2 = $result3->fetch_array();
      $stmt3->close();
      if (isset($User_data['total']) && isset($User_data2['LeaveCount'])) {
        $a = $User_data['total'];
        $b = $User_data2['LeaveCount'];
        $result = $b - $a;
        echo "Remaining Leave is " . $result;
      }
    }
  }
}
?>