<?php
include('../includes/auth_check.php');
include('../includes/connect.php');

$stmt = $conn->prepare("SELECT * FROM yearmaster WHERE flag=0");
$stmt->execute();
$result = $stmt->get_result();
$output = "";


              while($row = $result->fetch_assoc()){
                $safeYear = htmlspecialchars($row['Year'], ENT_QUOTES, 'UTF-8');
                $safeId = htmlspecialchars($row['YearID'], ENT_QUOTES, 'UTF-8');
                $output .= 
                "<tr>
                      <td>{$safeYear}</td>
                      <td><button data-eid='{$safeId}' class='btn btn-info' id='btn1'>Edit</button></td>
                      <td><button data-id='{$safeId}' class='btn btn-danger' id='btn2'>Delete</button>
                      <input type='hidden' value='{$safeId}' name='YearID' id='YearID'/></td>
                      </tr>";
              }
    
    $stmt->close();

    echo $output;

?>
