<?php
include('includes/connect.php');
if (!isset($_POST['FacultyID'])) {
  echo "Please Select Faculty Name";
}
if (isset($_POST['LeaveTypeID'])) {


  if ($_POST['LeaveTypeID'] == '2' || $_POST['LeaveTypeID'] == '1' || $_POST['LeaveTypeID'] == '3') {
    if (isset($_POST['FacultyID']) && isset($_POST['LeaveTypeID'])) {
      $TypeOfLeaveID = $_POST['LeaveTypeID'];
      $FacultyInfoID = $_POST['FacultyID'];

      $query2 = "SELECT COUNT(TypeOfLeaveID) as total FROM facultyleaveallocation WHERE TypeOfLeaveID=$TypeOfLeaveID AND FacultyInfoID=$FacultyInfoID GROUP BY TypeOfLeaveID";
      //$query2=" SELECT FacultyInfoID,COUNT(*) as TypeOfLeaveID FROM facultyleaveallocation where FacultyInfoID=2 GROUP BY FacultyInfoID,TypeOfLeaveID WITH ROLLUP";
      $result2 = mysqli_query($conn, $query2);
      $User_data = mysqli_fetch_array($result2);
      if (!isset($User_data['total'])) {
        echo "Remaining Leave is 12";
      }
      $query3 = "SELECT LeaveCount FROM facultyleavemaster WHERE TypeOfLeaveID=$TypeOfLeaveID AND FacultyInfoID=$FacultyInfoID";
      $result3 = mysqli_query($conn, $query3);
      $User_data2 = mysqli_fetch_array($result3);
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