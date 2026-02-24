<?php
include('includes/connect.php');


if (isset($_POST['DeptID'])) {
  $DeptID = $_POST['DeptID'];
  $i = 1;

  $output1 = "";

  if (isset($_POST['Year'])) {
    $YEAR = $_POST['Year'];
    $stmt = "SELECT FacultyName,EXTRACT(YEAR FROM Date) AS Date,  SUM(CASE WHEN TypeOfLeaveID =1 THEN 0.5 ELSE 0 END)+ 
            SUM(CASE WHEN TypeOfLeaveID =3 THEN 1 ELSE 0 END) AS CL, 
            SUM(CASE WHEN TypeOfLeaveID =2 THEN 1 ELSE 0 END) AS RH,
            SUM(CASE WHEN TypeOfLeaveID =4 THEN 1 ELSE 0 END) AS ML, 
            SUM(CASE WHEN TypeOfLeaveID =5 THEN 1 ELSE 0 END) AS HPL,
            SUM(CASE WHEN TypeOfLeaveID =6 THEN 1 ELSE 0 END) AS LWP,
            SUM(CASE WHEN TypeOfLeaveID =7 THEN 1 ELSE 0 END) AS EL,
            SUM(CASE WHEN TypeOfLeaveID =8 THEN 1 ELSE 0 END) AS OD,
            SUM(CASE WHEN TypeOfLeaveID =9 THEN 1 ELSE 0 END) AS VACATION, 
            SUM(CASE WHEN TypeOfLeaveID =10 THEN 1 ELSE 0 END) AS SPL, 
            (SUM(CASE WHEN TypeOfLeaveID IN (1) THEN 0.5 ELSE 0 END) + SUM(CASE WHEN TypeOfLeaveID IN (3,2,4,5,6,7,8,9,10) THEN 1 ELSE 0 END)) AS Total
                                            FROM  facultyleaveallocation INNER JOIN facultyinfo ON facultyleaveallocation.FacultyInfoID=facultyinfo.FacultyInfoID  WHERE facultyleaveallocation.DeptID=$DeptID GROUP BY facultyleaveallocation.FacultyInfoID";


    $result1 = mysqli_query($conn, $stmt);
    if (mysqli_num_rows($result1) > 0) {
      while ($row = mysqli_fetch_assoc($result1)) {

        if ($YEAR === $row['Date']) {
          $output1 .= "<tr>
                                            <td>" . $i++ . "</td>
                                            
                                            <td>" . $row['FacultyName'] . "</td>

                                                  
                                                <td>" . abs($row['CL']) . "</td>
                                                <td>" . $row['RH'] . "</td>
                                                <td>" . $row['ML'] . "</td>
                                                <td>" . $row['HPL'] . "</td>
                                                <td>" . $row['LWP'] . "</td>
                                                <td>" . $row['EL'] . "</td>
                                                <td>" . $row['OD'] . "</td>
                                                <td>" . $row['VACATION'] . "</td>
                                                <td>" . $row['SPL'] . "</td>
                                                <td>" . $row['Total'] . "</td>

                                                   </tr>";

        }

      }
      echo "$output1";
    }
  }
}
?>