<?php
include('../includes/auth_check.php');    
include('../includes/connect.php');
$YearID = $_POST["YearID"];


$stmt = $conn->prepare("SELECT * FROM yearMaster WHERE YearID = ?");
$stmt->bind_param("i", $YearID);
$stmt->execute();
$result = $stmt->get_result();
$output = "";
if($result->num_rows > 0 ){

  while($row = $result->fetch_assoc()){
    $safeYear = htmlspecialchars($row["Year"], ENT_QUOTES, 'UTF-8');
    $safeId = htmlspecialchars($row["YearID"], ENT_QUOTES, 'UTF-8');
    $output .= "<tr>
      <td width='90px'>Year</td>
      <td><input type='text' id='edit-fname' value='{$safeYear}'>
          <input type='text' id='edit-id' hidden value='{$safeId}'>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='save'></td>
    </tr>";

  }

    $stmt->close();

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
