<?php

$conn = mysqli_connect("localhost","root","","leavemgmt") or die("Connection Failed");

$sql = "SELECT * FROM yearmaster where flag=0";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";


              while($row = mysqli_fetch_assoc($result)){
                $output .= 
                "<tr>
                      <td>{$row['Year']}</td>
                      <td><button data-eid='{$row["YearID"]}' class='btn btn-info' id='btn1'>Edit</button></td>
                      <td><button data-id='{$row["YearID"]}' class='btn btn-danger' id='btn2'>Delete</button>
                      <input type='hidden' value='{$row['YearID']}' name='YearID' id='YearID'/></td>
                      </tr>";
              }
    

    mysqli_close($conn);

    echo $output;

?>
