 <?php
include('../includes/auth_check.php');
include('../includes/connect.php');
 $stmt = "SELECT UserMasterID,UserName,Password,UserType,DeptName FROM (usermaster INNER JOIN departmentmaster ON usermaster.DeptID=departmentmaster.DeptID)";
 $result = mysqli_query($conn, $stmt);
 if (!$result) {
     echo "<tr><td colspan='6'>An error occurred. Please try again.</td></tr>";
     exit;
 }
     $output ="";
     while ($row = $result->fetch_assoc()) {
        $output .= "<tr><td>" . htmlspecialchars($row['UserName'], ENT_QUOTES, 'UTF-8') . "</td>
                 <td>" . htmlspecialchars($row['Password'], ENT_QUOTES, 'UTF-8') . "</td>
                 <td>" . htmlspecialchars($row['UserType'], ENT_QUOTES, 'UTF-8') . "</td>
                 <td>" . htmlspecialchars($row['DeptName'], ENT_QUOTES, 'UTF-8') . "</td>
                 <td><button data-eid='" . htmlspecialchars($row["UserMasterID"], ENT_QUOTES, 'UTF-8') . "' class='btn btn-info' id='btn1'>Edit</button></td>
                 <td><button data-id='" . htmlspecialchars($row["UserMasterID"], ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger' id='btn2'>Delete</button>
                 <input type='hidden' value='" . htmlspecialchars($row["UserMasterID"], ENT_QUOTES, 'UTF-8') . "' name='UserMasterID' id='UserMasterID' /> </td>
                </tr>";
            }
       echo $output;



?>

