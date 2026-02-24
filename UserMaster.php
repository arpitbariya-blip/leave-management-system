<!doctype html>
<?php

include('includes/header.php');
include('includes/navbar.php');
include('includes/connect.php');
?>
<html lang="en" id="User">

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
  <link rel="stylesheet" href="css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <title>Leave Mgmt - GPDahod</title>


  <?php

  $UserMasterID = "";
  $UserName = "";
  $Password = "";
  $CPassword = "";
  $UserType = "";
  $DeptID = "";
  $DeptName = "";
  $btn = "Submit";
  $message = "";
  if (isset($_POST["btnSubmit"])) {
    if ('Submit' == $_POST["btnSubmit"]) {

      $UserName = $_POST["UserName"];
      $Password = $_POST["Password"];
      $UserType = $_POST["UserType"];
      $CPassword = $_POST["CPassword"];

      $stmt2 = "SELECT * FROM usermaster WHERE Password=" .$Password;
      $result2 = $conn->query($stmt2);
      $User_data = mysqli_num_rows($result2);

      if (empty($User_data)) {
        echo " ";
      }
      if ($User_data > 0) {
        echo "<div class='alert alert-danger'>Password is already Existed</div>";
      } else {
        if ($Password == $CPassword) {
          if ($_POST['UserType'] === 'Admin') {
            $stmt = "Insert into usermaster(UserName,Password,UserType,DeptID)values('" . $UserName . "','" . $Password . "','" . $UserType . "', 444) ";
          } elseif ($_POST['UserType'] === 'ESTA') {
            $stmt = "Insert into usermaster(UserName,Password,UserType,DeptID)values('" . $UserName . "','" . $Password . "','" . $UserType . "', 555) ";
          } else {
            $DeptName = $_POST["DeptName"];
            $stmt = "Insert into usermaster(UserName,Password,UserType,DeptID)values('" . $UserName . "','" . $Password . "','" . $UserType . "','" . $DeptName . "') ";
          }

          if ($conn->query($stmt) === true) {
            $message = "<div class='alert alert-success'>Record Inserted successfully!</div>";
            echo "$message";
          } else {
            echo "<div class='alert alert-Danger'>Record not inserted</div>";
          }
        } else {
          echo " <div class='alert alert-Danger'>Password Doesn't Match</div>";
        }
      }
    }
  }

  if (isset($_POST["btnSubmit"])) {
    if ('Update' == $_POST["btnSubmit"]) {
      $UserName = $_POST["UserName"];
      $Password = $_POST["Password"];
      $UserType = $_POST["UserType"];
      $DeptName = $_POST["DeptName"];

      if ($_POST['UserType'] === 'Admin') {
        $stmt = "Update usermaster set UserName='" . $UserName . "',Password='" . $Password . "',UserType='" . $UserType . "',DeptID='444' where UserMasterID=" . $_GET["UserMasterID"];
      } elseif ($_POST['UserType'] === 'ESTA') {
        $stmt = "Update usermaster set UserName='" . $UserName . "',Password='" . $Password . "',UserType='" . $UserType . "',DeptID='555' where UserMasterID=" . $_GET["UserMasterID"];
      } else {
        $DeptName = $_POST["DeptName"];
        $stmt = "Update usermaster set UserName='" . $UserName . "',Password='" . $Password . "',UserType='" . $UserType . "',DeptID='" . $DeptName . "' where UserMasterID=" . $_GET["UserMasterID"];
      }

      if ($conn->query($stmt) === true) {
        $message = "<div class='alert alert-success'>Record Updated successfully!</div>";
        echo "$message";
      } else {
        echo "<div class='alert alert-Danger'>Record not Updated</div>";
      }
    }
  }
  if (empty($_GET["UserMasterID"])) {
  } else {
    $btn = "Update";
    $stmt = "Select * from usermaster where UserMasterID=" . $_GET["UserMasterID"];
    $result = $conn->query($stmt);
    $row = $result->fetch_assoc();
    $UserMasterID = $row['UserMasterID'];
    $UserName = $row['UserName'];
    $Password = $row['Password'];
    $UserType = $row['UserType'];

    $DeptID = $row['DeptID'];
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

        </svg> User Master</h4>
      <hr style="border-top: 1px solid black" ; />


      <br />
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="UserType" class="form-label">User Type<sup style="color:red; font-size: 15px" ;>*</sup>:</label>

            <select name="UserType" onchange="reload()" class="form-control" id="UserType"
              value="<?php echo $_POST['Select']; ?>">
              <option>----User Type----</option>
              <option>Admin</option>
              <option>ESTA</option>
              <option>Department User</option>

            </select>
          </div>
          <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
             -->



          <script src="js/jquery.js"></script>
          <script>
            function reload() {
              var v1 = document.getElementById('UserType').value;

              $.ajax({
                url: 'UserMaster.php',
                type: 'POST',
                data: {
                  Select: v1
                },
                success: function (data) {
                  if(v1 == 'Department User')
                  {
                  $('#div1').show();
                }
                else{
                  $('#div1').hide();
                }
                }
              });
            }

          </script>

        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="UserName">UserName</label>
            <input type="text" class="form-control" value="<?php echo $UserName; ?>" name="UserName" maxlength="50"
              id="UserName" placeholder="User Name">
          </div>
        </div>


      </div>

      <br>

          <div class="row" style="display:none;" id="div1">

            <div class="col-sm-12">
              <div class="form-group">
                <label for="DeptName" class="form-label">Department Name<sup style="color:red; font-size: 15px"
                    ;>*</sup>:</label>

                <?php
                $query = "Select * from departmentmaster where Flag=0";
                $result = mysqli_query($conn, $query);

                ?>
                <select name="DeptName" required="" id="a" class="form-control" value="<?php echo $DeptID; ?>">
                  <option value="">-----Department Name-----</option>

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
      <br>

      <div class="row">

        <div class="col-sm-6">
          <div class="form-group">
            <label for="Password">Password</label>
            <input type="Password" class="form-control" value="<?php echo $Password; ?>" name="Password" maxlength="10"
              id="password" placeholder="Password">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="CPassword">Confirm Password</label>
            <input type="Password" class="form-control" value="<?php echo $CPassword; ?>" name="CPassword"
              maxlength="10" id="confirm_password" placeholder="Confirm Password">
          </div>
        </div>
      </div>
      <script>
        function Reset(event) {

          event.preventDefault();
          const UserType = document.getElementById("UserType");
          UserType.value = "";
          UserType.focus();
          const UserName = document.getElementById("UserName");
          UserName.value = "";
          UserName.focus();
          const a = document.getElementById("a");
          a.value = "";
          a.focus();
          const password = document.getElementById("Password");
          password.value = "";
          password.focus();
          const confirm_password = document.getElementById("confirm_password");
          confirm_password.value = "";
          confirm_password.focus();

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
  <!-- <script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
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