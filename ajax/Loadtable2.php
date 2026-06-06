<?php
include('../includes/auth_check.php');
include('../includes/connect.php');


if (isset($_POST['DeptID'])) {
  $DeptID = $_POST['DeptID'];
  $i = 1;
  $output = "";
  $output1 = "";

  if (isset($_POST['Month'])) {
    $num = str_replace(array("#", "'", "-"), '', $_POST['Month']);

    $stmt = $conn->prepare("SELECT FacultyName,EXTRACT(YEAR_MONTH FROM Date) AS Date, SUM(CASE WHEN TypeOfLeaveID =1 THEN 1 ELSE 0 END) +  
                                            SUM(CASE WHEN TypeOfLeaveID =3 THEN 1 ELSE 0 END) / 2 AS CL,
                                            SUM(CASE WHEN TypeOfLeaveID =2 THEN 1 ELSE 0 END) AS RH,
                                            SUM(CASE WHEN TypeOfLeaveID =4 THEN 1 ELSE 0 END) AS ML, 
                                            SUM(CASE WHEN TypeOfLeaveID =5 THEN 1 ELSE 0 END) AS HPL,
                                            SUM(CASE WHEN TypeOfLeaveID =6 THEN 1 ELSE 0 END) AS LWP,
                                            SUM(CASE WHEN TypeOfLeaveID =7 THEN 1 ELSE 0 END) AS EL,
                                            SUM(CASE WHEN TypeOfLeaveID =8 THEN 1 ELSE 0 END) AS OD,
                                            SUM(CASE WHEN TypeOfLeaveID =9 THEN 1 ELSE 0 END) AS VACATION,
                                            SUM(CASE WHEN TypeOfLeaveID =10 THEN 1 ELSE 0 END) AS SPL,
                                            COUNT(TypeOfLeaveID) AS Total
                                            FROM  facultyleaveallocation INNER JOIN facultyinfo ON facultyleaveallocation.FacultyInfoID=facultyinfo.FacultyInfoID  WHERE facultyleaveallocation.DeptID=? GROUP BY facultyleaveallocation.FacultyInfoID");

    $stmt->bind_param("i", $DeptID);
    $stmt->execute();
    $result1 = $stmt->get_result();

    while ($row = $result1->fetch_assoc()) {

      if ($num === $row['Date']) {
        $output .= "<tr>
                                            <td>" . $i++ . "</td>
                                            
                                            <td>" . htmlspecialchars($row['FacultyName'], ENT_QUOTES, 'UTF-8') . "</td>

                                                  
                                                <td>" . htmlspecialchars(abs($row['CL']), ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['RH'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['ML'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['HPL'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['LWP'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['EL'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['OD'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['VACATION'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['SPL'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['Total'], ENT_QUOTES, 'UTF-8') . "</td>

                                                   </tr>";

      }
    }
    $stmt->close();
    echo $output;
  }

  if (isset($_POST['Year'])) {
    $YEAR = $_POST['Year'];
    $stmt = $conn->prepare("SELECT FacultyName,EXTRACT(YEAR FROM Date) AS Date, SUM(CASE WHEN TypeOfLeaveID =1 THEN 1 ELSE 0 END) +  
                                            SUM(CASE WHEN TypeOfLeaveID =3 THEN 1 ELSE 0 END) / 2 AS CL,
                                            SUM(CASE WHEN TypeOfLeaveID =2 THEN 1 ELSE 0 END) AS RH,
                                            SUM(CASE WHEN TypeOfLeaveID =4 THEN 1 ELSE 0 END) AS ML, 
                                            SUM(CASE WHEN TypeOfLeaveID =5 THEN 1 ELSE 0 END) AS HPL,
                                            SUM(CASE WHEN TypeOfLeaveID =6 THEN 1 ELSE 0 END) AS LWP,
                                            SUM(CASE WHEN TypeOfLeaveID =7 THEN 1 ELSE 0 END) AS EL,
                                            SUM(CASE WHEN TypeOfLeaveID =8 THEN 1 ELSE 0 END) AS OD,
                                            SUM(CASE WHEN TypeOfLeaveID =9 THEN 1 ELSE 0 END) AS VACATION,
                                            SUM(CASE WHEN TypeOfLeaveID =10 THEN 1 ELSE 0 END) AS SPL,
                                            COUNT(TypeOfLeaveID) AS Total
                                            FROM  facultyleaveallocation INNER JOIN facultyinfo ON facultyleaveallocation.FacultyInfoID=facultyinfo.FacultyInfoID  WHERE facultyleaveallocation.DeptID=? GROUP BY facultyleaveallocation.FacultyInfoID");

    $stmt->bind_param("i", $DeptID);
    $stmt->execute();
    $result1 = $stmt->get_result();
    if ($result1->num_rows > 0) {
      while ($row = $result1->fetch_assoc()) {

        if ($YEAR === $row['Date']) {
          $output1 .= "<tr>
                                            <td>" . $i++ . "</td>
                                            
                                            <td>" . htmlspecialchars($row['FacultyName'], ENT_QUOTES, 'UTF-8') . "</td>

                                                  
                                                <td>" . htmlspecialchars($row['CL'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['RH'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['ML'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['HPL'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['LWP'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['EL'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['OD'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['VACATION'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['SPL'], ENT_QUOTES, 'UTF-8') . "</td>
                                                <td>" . htmlspecialchars($row['Total'], ENT_QUOTES, 'UTF-8') . "</td>

                                                   </tr>";

        }

      }
    }
    $stmt->close();
  }
}
?>