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

    $FacultyLeaveMasterID = "";
    $FacultyInfoID = "";
    $FacultyName = "";
    $LeaveType = "";
    $TypeOfLeaveID = "";
    $LeaveCount = "";
    $Year = "";
    $DeptID = "";
    $YearID = "";
    $btn = "Submit";
    $message = "";
    if (isset($_POST["btnSubmit"])) {
        if ('Submit' == $_POST["btnSubmit"]) {

            $DeptName = $_POST["DeptName"];
            $FacultyName = $_POST["FacultyName"];
            $LeaveType = $_POST["LeaveType"];
            $LeaveCount = $_POST["LeaveCount"];
            $Year = $_POST["Year"];

            $stmt = "Insert into facultyleavemaster(FacultyInfoID,TypeOfLeaveID,LeaveCount,YearID,DeptID)values('" . $FacultyName . "','" . $LeaveType . "','" . $LeaveCount . "','" . $Year . "','" . $DeptName . "') ";


            if ($conn->query($stmt) === true) {
                echo "<div class='alert alert-success'>Record Inserted successfully!</div>";

            } else {
                echo "<div class='alert alert-alert'>Record not inserted</div>";
            }
        }
    }

    if (isset($_POST["btnSubmit"])) {
        if ('Update' == $_POST["btnSubmit"]) {
            $FacultyName = $_POST["FacultyName"];
            $LeaveType = $_POST["LeaveType"];
            $LeaveCount = $_POST["LeaveCount"];
            $Year = $_POST["Year"];
            $DeptName = $_POST["DeptName"];
            $FacultyLeaveMasterID = $_GET["FacultyLeaveMasterID"];
            $stmt = "Update facultyleavemaster set FacultyInfoID='" . $FacultyName . "',TypeOfLeaveID='" . $LeaveType . "',LeaveCount='" . $LeaveCount . "',YearID='" . $Year . "',DeptID='" . $DeptName . "' where FacultyLeaveMasterID=" . $_GET["FacultyLeaveMasterID"];

            if ($conn->query($stmt) === true) {
                $message = "<div class='alert alert-success'>Faculty record Updated Successfully</div>";
                echo "<div class='alert alert-success'>$message</div>";
            }
        }
    }
    if (empty($_GET["FacultyLeaveMasterID"])) {

    } else {
        $btn = "Update";
        $stmt = "Select * from facultyleavemaster where FacultyLeaveMasterID=" . $_GET["FacultyLeaveMasterID"];
        $result = $conn->query($stmt);
        while ($row = $result->fetch_assoc()) {

            $FacultyLeaveMasterID = $row['FacultyLeaveMasterID'];
            $FacultyInfoID = $row['FacultyInfoID'];
            $TypeOfLeaveID = $row['TypeOfLeaveID'];
            $LeaveCount = $row['LeaveCount'];


            $YearID = $row['YearID'];
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

                </svg> Faculty Leave Master</h4>
            <hr style="border-top: 1px solid black" ; />


            <br />
            <div class="row" id="S">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="DeptName" class="form-label">Department Name <sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>

                        <select id="S1" name="DeptName" required="" class="form-control"
                            value=" <?php echo $DeptID; ?>">
                            <option>----Department Name----</option>

                        </select>
                        <script type="text/javascript" src="js/jquery.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                function loadData(type, DeptID) {
                                    $.ajax({
                                        url: "load-cs.php",
                                        type: "POST",
                                        data: { type: type, id: DeptID },
                                        success: function (data) {
                                            if (type == "FacultyData") {
                                                $("#S2").html(data);
                                            } else {
                                                $("#S1").append(data);
                                            }

                                        }
                                    });
                                }

                                loadData();

                                $("#S1").on("change", function () {
                                    var country = $("#S1").val();

                                    if (country != "") {
                                        loadData("FacultyData", country);
                                    } else {
                                        $("#S2").html("");
                                    }


                                })
                            });

                            /*$.ajax({
                                url: 'Loadtable.php',
                                type: 'POST',
                                data: {Sel: v1,FID: v},
                                beforeSend: function(){
                                    $('#loader').show();
                                },
                                success: function(data) {
                                    $('#a1').html(data);
                                },
                                complete: function(){
                                    $('#loader').hide();
                                }
                             });*/
                        </script>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="FacultyName">Faculty Name</label>


                        <select name="FacultyName" required="" class="form-control" id="S2"
                            value="<?php echo "$FacultyInfoID"; ?>">
                            <option value="" selected>-----Faculty Name-----</option>

                        </select>
                    </div>
                </div>
            </div>

            <br>
            <br>


            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="LeaveCount" class="form-label">LeaveCount<sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>
                        <select name="LeaveCount" class="form-control" id="LeaveCount">
                            <option>1</option>
                            <option>2</option>
                            <option>3 </option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9 </option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">

                        <label for="LeaveType" class="form-label">Type Of Leave<sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>

                        <?php
                        $query1 = "Select * from typeofleave Where Flag=0";
                        $result1 = mysqli_query($conn, $query1);
                        ?>
                        <select name="LeaveType" required="" onchange="reloads()" class="form-control"
                            value="<?php echo $TypeOfLeaveID; ?> " id="LeaveType">
                            <option>-----Type Of Leave-----</option>
                            <?php
                            while ($data = mysqli_fetch_array($result1)) {
                                if ($data[0] == $_GET['TypeOfLeaveID'] || $data[0] == $TypeOfLeaveID) {
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

            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="Year" class="form-label">Year<sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>

                        <?php
                        $query = "Select * from yearmaster Where Flag=0";
                        $result = mysqli_query($conn, $query);

                        ?>
                        <select name="Year" required="" class="form-control" value="<?php echo "$YearID"; ?>" id="Year">
                            <option value="">-----Year-----</option>
                            <?php
                            while ($data = mysqli_fetch_array($result)) {
                                if ($data[0] == $YearID) {
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
            <div class="col-sm-12">
                <input class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo $btn; ?>"
                    type='hidden' value='".$row["FacultyInfoID"]."' name='FacultyInfoID' id='FacultyInfoID'></input>
                <button type="button" class="btn btn-danger" onclick=" Reset(event)">Reset</button>
            </div>
            <script>
                function Reset(event) {

                    event.preventDefault();
                    const UserType = document.getElementById("S1");
                    UserType.value = "";
                    UserType.focus();
                    const UserName = document.getElementById("S2");
                    UserName.value = "";
                    UserName.focus();
                    const a = document.getElementById("LeaveCount");
                    a.value = "";
                    a.focus();
                    const password = document.getElementById("LeaveType");
                    password.value = "";
                    password.focus();
                    const confirm_password = document.getElementById("Year");
                    confirm_password.value = "";
                    confirm_password.focus();

                }
            </script>


    </form>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

    <script src="js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <?php
    include('includes/footer.php');
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
</body>

</html>