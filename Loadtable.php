<?php
include('includes/connect.php');
$f = $_POST['FID'];
$date = $_POST['Sel'];
$sql = "SELECT TL.LeaveType,Date, COUNT(*) Total FROM facultyleaveallocation as FA,typeofleave as TL WHERE FA.TypeOfLeaveID=TL.TypeOfLeaveID AND FacultyInfoID=$f GROUP  BY LeaveType,Date WITH ROLLUP ";
$result = mysqli_query($conn, $sql);
$output = "";
$i = 1;
if (mysqli_num_rows($result) > 0) {
    $output .= '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                  <tr>
                       <th>Sr_NO</th>
                       <th>Leave Date</th>
                       <th>Leave Type</th>
                       <th>Total</th>

                   </tr>
               </thead>
               <tbody>';


    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Date'] == "") {

            $output .= "<tr>
      <td></td>
      <td colspan=2 text-align='center'> Total </td>
      <td>" . $row['Total'] . "</td>
       </tr></thead><tbody>";
        } else {

            $output .= "<tr>
		<td>" . $i++ . "</td>
		<td>" . $row['Date'] . "</td>
		<td>" . $row['LeaveType'] . "</td>
		<td>" . $row['Total'] . "</td>";
        }
        $output .= "</tr>";
    }

    $output .= "</tbody> </table>";
    echo $output;
} else {
    echo "<center><h2 style='color:red' >No Faculty Record found</h2></center>";
}
?>


<?php

include('include/connect.php');

if (isset($_POST['insert'])) {
  $Material_name = $_POST['Material_Name'];
  $Material_quantity = $_POST['Quantity'];
  $Material_cost = $_POST['Cost'];

  $sql = "INSERT INTO material (Material_name,Material_quantity,Material_cost) VALUES ('$Material_name', '$Material_quantity', '$Material_cost')";
  $result = $conn->query($sql);

  if (!$result) {
    die("Query failed: " . $conn->error);
  } 
}

if (isset($_POST['update'])) {
$materialId = $_POST['material_id'];
$materialName = $_POST['Material_Name'];
$quantity = $_POST['Quantity'];
$cost = $_POST['Cost'];

// update record in database
$sql = "UPDATE material SET material_name = '$materialName', quantity = '$quantity', cost = '$cost' WHERE material_id = '$materialId'";
$result = $conn->query($sql);

if (!$result) {
  die("Query failed: " . $conn->error);
} else {
  echo "Material updated successfully!";
}
}


$sql = "SELECT * FROM material";
$result = $conn->query($sql);


if (!$result) {
    die("Query failed: " . $conn->error);
}?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Cost</title>
    <link rel="stylesheet" href="material_cost.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>

    .popup-box {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #333; /* Black background */
      border: 1px solid #444; /* Dark gray border */
      padding: 20px;
       width: 300px;
      height: 480px;
      display: none;
      border-radius: 10px; /* Add some rounded corners */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add some depth */
    }
    #close-btn{
  background: red;
  color: white;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  border-radius: 50%;
  position: absolute;
  top: -15px;
  right: -15px;
  cursor: pointer;
}

  </style>
</head>
<body>
    <header>
        <h1>Material Cost</h1>
    </header>
    <main>
        <section>
          
            <h2>Material List</h2>
            <table id="material-table">
                <thead>
                    <tr>
                    <th>Sr_NO:-</th>
                        <th>Material</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                     $i =1;
                        while($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $i++ . "</td>";
                          echo "<td>" . $row["Material_name"] . "</td>";
                          echo "<td>" . $row["Material_quantity"] . "</td>";
                          echo "<td>" . $row["Material_cost"] . "</td>";
                          echo "<td><a class='btn btn-info' id='open-popups' name='update' material-id='".$row["Material_id"]. "'>Edit</a></td>";
                          echo "</tr>";
                         }
                         ?>
                </tbody>
            </table>
           
            
  <button id="open-popup" >Add Material</button>
  <div class="popup-box" id="popup-box" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label for="Material_Name" class="text-white">Material_Name</label>
        <input type="text" id="Material_Name" name="Material_Name" class="form-control">
      </div>
      <div class="form-group">
        <label for="quantity" class="text-white">Quantity</label>
        <input type="number" id="Quantity" name="Quantity" class="form-control">
      </div>
      <div class="form-group">
        <label for="cost" class="text-white">Cost</label>
        <input type="number" id="Cost" name="Cost" class="form-control">
      </div>
      
      <input type="submit" value="insert" name="insert" class="btn btn-primary" class="form-control">
      <input type="reset" onclick="window.close()" class="btn btn-danger" class="form-control">
      <div id="close-btn" onclick="document.getElementById('popup-box').style.display = 'none'">X<div>
    </form>
  </div>
          <script>
          document.getElementById("open-popup").addEventListener("click", function() {
          document.getElementById("popup-box").style.display = "block";
          });      

          </script>
          
        </section>
    </main>
    
</body>
</html>