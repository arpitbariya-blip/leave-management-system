<?php
    
include('includes/connect.php');
$YearID = $_POST["YearID"];


$sql = "SELECT * FROM yearMaster WHERE YearID = {$YearID}";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
      <td width='90px'>Year</td>
      <td><input type='text' id='edit-fname' value='{$row["Year"]}'>
          <input type='text' id='edit-id' hidden value='{$row["YearID"]}'>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='save'></td>
    </tr>";

  }

    mysqli_close($conn);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
