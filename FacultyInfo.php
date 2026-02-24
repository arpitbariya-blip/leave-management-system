<!doctype html>
<?php

include('includes/header.php');
include('includes/navbar.php');
include('includes/connect.php');
?>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script>
    var loadFile = function (event) {
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };
    function isNumber(e) {
      e = e || window.event;
      var charCode = e.which ? e.which : e.keyCode;
      return /\d/.test(String.fromCharCode(charCode));
    };
  </script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="sb-admin-2.min.css" rel="stylesheet">
  <title>Leave Mgmt - GPDahod</title>


  <?php

  $FacultyInfoID = "";
  $FacultyName = "";
  $ContactNo = "";
  $JoiningDate = "";
  $RelievingDate = "";
  $Designation = "";
  $DeptName = "";
  $btn = "Submit";
  $message = "";
  if (isset($_POST["btnSubmit"])) {
    if ('Submit' == $_POST["btnSubmit"]) {
      $FacultyName = $_POST["FacultyName"];
      $ContactNo = $_POST["ContactNo"];
      $JoiningDate = $_POST["JoiningDate"];
      $RelievingDate = $_POST["RelievingDate"];
      $Designation = $_POST["Designation"];
      $DeptName = $_POST["DeptName"];

      $stmt = "Insert into facultyinfo(FacultyName,ContactNo,JoiningDate,RelievingDate,Designation,DeptID)values('" . $FacultyName . "','" . $ContactNo . "','" . $JoiningDate . "','" . $RelievingDate . "','" . $Designation . "','" . $DeptName . "') ";

      if ($conn->query($stmt) === true) {
        $message = "<div class='alert alert-success'>Record Inserted successfully!</div>";
        echo "$message";
      } else {
        echo "<div class='alert alert-danger'>Record not inserted</div>";
      }
    }
  }


  if (isset($_POST["btnSubmit"])) {
    if ('Update' == $_POST["btnSubmit"]) {
      $FacultyName = $_POST["FacultyName"];
      $ContactNo = $_POST["ContactNo"];
      $JoiningDate = $_POST["JoiningDate"];
      $RelievingDate = $_POST["RelievingDate"];
      $Designation = $_POST["Designation"];
      $DeptName = $_POST["DeptName"];
      $stmt = "Update facultyinfo set FacultyName='" . $FacultyName . "',ContactNo='" . $ContactNo . "',JoiningDate='" . $JoiningDate . "',RelievingDate='" . $RelievingDate . "',Designation='" . $Designation . "',DeptID='" . $DeptName . "' where FacultyInfoID=" . $_GET["FacultyInfoID"];

      if ($conn->query($stmt) === true) {
        echo "<div class='alert alert-success'>Faculty record Updated Successfully</div>";
      } else {
        echo "<div class='alert alert-danger'>Faculty record Not Updated </div>";
      }
    }
  }
  if (empty($_GET["FacultyInfoID"])) {

  } else {
    $btn = "Update";
    $stmt = "Select * from facultyinfo where FacultyInfoID=" . $_GET["FacultyInfoID"];
    $result = $conn->query($stmt);
    while ($row = $result->fetch_assoc()) {
      $FacultyInfoID = $row['FacultyInfoID'];
      $FacultyName = $row['FacultyName'];
      $ContactNo = $row['ContactNo'];
      $JoiningDate = $row['JoiningDate'];
      $RelievingDate = $row['RelievingDate'];
      $Designation = $row['Designation'];
      $DeptID = $row['DeptID'];

    }
  }
  ?>
</head>

<body>

  <form method="post" action="" enctype="multipart/form-data">
    <div class="container" style="color:black;">



      <h4 class="display-6"><svg xmlns="http://www.w3.org/2000/svg" width="25 " height="25" fill="currentColor"
          class="bi bi-person-lines-fill" viewBox="0 0 14 14">
          <path
            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />

        </svg> Faculty Information</h4>
      <hr style="border-top: 1px solid black" ; />


      <br />
      <div class="row">

        <div class="col-sm-6">
          <div class="form-group">
            <label for="FacultyName">FacultyName</label>
            <input type="text" class="form-control" name="FacultyName" value="<?php echo $FacultyName; ?>"
              maxlength="50" id="FacultyName" required="" placeholder="Faculty Name">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="ContactNo">ContactNo</label>
            <input type="text" class="form-control" name="ContactNo" value="<?php echo $ContactNo; ?>" maxlength="10"
              id="ContactNo" required="" placeholder="Contact No">
          </div>
        </div>

      </div>

      <br>
      <div class="row">

        <div class="col-sm-6">
          <div class="form-group">
            <label for="JoiningDate">JoiningDate</label>
            <input type="date" class="form-control" value="<?php echo $JoiningDate; ?>" name="JoiningDate" maxlength="8"
              id="JoiningDate" placeholder="Joining Date ">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="RelievingDate">RelievingDate</label>
            <input type="date" class="form-control" value="<?php echo $RelievingDate; ?>" name="RelievingDate"
              maxlength="8" id="RelievingDate" placeholder="Relieving Date ">
          </div>
        </div>

      </div>


      <br>
      <div class="row">

        <div class="col-sm-6">
          <div class="form-group">
            <label for="Designation">Designation</label>
            <input type="text" class="form-control" value="<?php echo $Designation; ?>" required="" name="Designation"
              maxlength="50" id="Designation" placeholder="Designation ">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="DeptName" class="form-label">Department Name <sup style="color:red; font-size: 15px"
                ;>*</sup>:</label>

            <?php
            $query = "Select * from departmentmaster where Flag=0 ";
            $result = mysqli_query($conn, $query);

            ?>
            <select name="DeptName" required="" class="form-control" value="<?php echo $DeptID; ?>" id="DeptName">
              <option value="">-----Department Name -----</option>

              <?php
              while ($data = mysqli_fetch_array($result)) {
                if ($data[0] == $DeptID) {
                  echo "<option value='$data[0]' selected> $data[1] </option>";
                } else {
                  echo "<option value='$data[0]'> $data[1] </option>";
                }
              }


              ?>
            </select>
          </div>
        </div>

      </div>
      <script>

        function Reset(event) {

          event.preventDefault();
          const FacultyName = document.getElementById("FacultyName");
          FacultyName.value = "";
          FacultyName.focus();
          const ContactNo = document.getElementById("ContactNo");
          ContactNo.value = "";
          ContactNo.focus();
          const JoiningDate = document.getElementById("JoiningDate");
          JoiningDate.value = "";
          JoiningDate.focus();
          const RelievingDate = document.getElementById("RelievingDate");
          RelievingDate.value = "";
          RelievingDate.focus();
          const Designation = document.getElementById("Designation");
          Designation.value = "";
          Designation.focus();
          const DeptName = document.getElementById("DeptName");
          DeptName.value = "";
          DeptName.focus();

        }

      </script>

      <br>

      <br>
      <div class="col-sm-12">
        <input class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit"
          value="<?php echo $btn; ?>"></input>
        <button type="button" class="btn btn-danger" onclick="Reset(event)">Reset</button>
      </div>
    </div>

    </div>
  </form>


  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>

  <script src="js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <?php
  include('includes/footer.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
    crossorigin="anonymous"></script>
</body>

</html>