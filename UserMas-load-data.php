 <?php
$conn = mysqli_connect("localhost","root","","leavemgmt") or die("Connection Failed");
 $stmt = "SELECT UserMasterID,UserName,Password,UserType,DeptName FROM (usermaster INNER JOIN departmentmaster ON usermaster.DeptID=departmentmaster.DeptID)";
 $result = mysqli_query($conn, $stmt) or die("SQL Query Failed.");
     $output ="";
     while ($row = $result->fetch_assoc()) {
        $output .= "<tr><td>{$row['UserName']}</td>
                 <td>{$row['Password']}</td>
                 <td>{$row['UserType']}</td>
                 <td>{$row['DeptName']}</td>
                 <td><button data-eid='{$row["UserMasterID"]}' class='btn btn-info' id='btn1'>Edit</button></td>
                 <td><button data-id='{$row["UserMasterID"]}' class='btn btn-danger' id='btn2'>Delete</button>
                 <input type='hidden' value='{$row["UserMasterID"]}' name='UserMasterID' id='UserMasterID' /> </td>
                </tr>";
            }
     mysqli_close($conn);
       echo $output;



?>

