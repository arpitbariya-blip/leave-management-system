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
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Leave Mgmt - GPDahod</title>


    <?php

    $FacultyLeaveAllocationID = "";
    $FacultyInfoID = "";
    $FacultyName = "";
    $TypeOfLeaveID = "";
    $LeaveType = "";
    $Date = "";
    $YearID = "";
    $Year = "";
    $DeptName = "";
    $btn = "Submit";
    $message = "";
    if (isset($_POST["btnSubmit"])) {
        if ('Submit' == $_POST["btnSubmit"]) {

            $FacultyName = $_POST["FacultyName"];
            $LeaveType = $_POST["LeaveType"];
            $Date = $_POST["Date"];

            $DeptName = $_POST["DeptName"];

            $stmt = "Insert into facultyleaveallocation(FacultyInfoID,TypeOfLeaveID,Date,DeptID)values('" . $FacultyName . "','" . $LeaveType . "','" . $Date . "','" . $DeptName . "') ";

            if ($conn->query($stmt) === true) {
                $message = "<div class='alert alert-success'>Record inserted successfully!</div>";
                echo "$message";
            } else {
                echo "<div class='alert alert-success'>Record not inserted</div>";
            }
        }
    }


    if (isset($_POST["btnSubmit"])) {
        if ('Update' == $_POST["btnSubmit"]) {
            $FacultyName = $_POST["FacultyName"];
            $LeaveType = $_POST["LeaveType"];
            $Date = $_POST["Date"];
            $Year = $_POST["Year"];
            $DeptName = $_POST["DeptName"];
            $stmt = "Update facultyleaveallocation set FacultyInfoID='" . $FacultyName . "',TypeOfLeaveID='" . $LeaveType . "',Date='" . $Date . "',DeptID='" . $DeptName . "' where FacultyLeaveAllocationID=" . $_GET["FacultyLeaveAllocationID"];

            if ($conn->query($stmt) === true) {
                $message = "<div class='alert alert-success'>Faculty record Updated Successfully</div>";
                echo $message;
            }
        }
    }
    if (empty($_GET["FacultyLeaveAllocationID"])) {

    } else {
        $btn = "Update";
        $stmt = "Select * from facultyleaveallocation where FacultyLeaveAllocationID=" . $_GET["FacultyLeaveAllocationID"];
        $result = $conn->query($stmt);
        while ($row = $result->fetch_assoc()) {
            $FacultyLeaveAllocationID = $row['FacultyLeaveAllocationID'];
            $FacultyInfoID = $row['FacultyInfoID'];
            $TypeOfLeaveID = $row['TypeOfLeaveID'];
            $Date = $row['Date'];


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

                </svg> Faculty Leave Allocation</h4>
            <hr style="border-top: 1px solid black" ; />


            <br />
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="DeptName" class="form-label">Department Name <sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>

                        <?php
                        if ($_SESSION['UserType'] == 'ESTA') {
                            ?>
                            <select id="S1" name="DeptName" required="" class="form-control"
                                value=" <?php echo $DeptID; ?>">
                                <option value="">----Department Name----</option>

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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="LeaveType" class="form-label">Type Of Leave<sup style="color:red; font-size: 15px"
                                    ;>*</sup>:</label>

                            <?php
                            $query = "Select * from typeofleave where Flag=0";
                            $result = mysqli_query($conn, $query);

                            ?>
                            <select name="LeaveType" required="" class="form-control" value="<?php echo $TypeOfLeaveID; ?>"
                                id="LeaveType" onchange="relo()">
                                <option value="">-----Type Of Leave-----</option>
                                <?php
                                while ($data = mysqli_fetch_array($result)) {
                                    if ($data[0] == $_POST['LeaveTypeID']) {
                                        echo "<option value='$data[0]' selected> $data[1] </option>";
                                    } else {
                                        echo "<option value='$data[0]'> $data[1] </option>";
                                    }
                                }
                                ?>
                            </select>
                            <script>

                                function relo() {

                                    var v1 = document.getElementById('LeaveType').value;
                                    var v = document.getElementById('S2').value;
                                    if (v != "") {
                                        $.ajax({
                                            url: 'ajax.php',
                                            type: 'POST',
                                            data: { LeaveTypeID: v1, FacultyID: v },
                                            beforeSend: function () {
                                                $('#loader').show();
                                            },
                                            success: function (data) {
                                                $('#a1').html(data);
                                            },
                                            complete: function () {
                                                $('#loader').hide();
                                            }
                                        });
                                    }

                                }

                            </script>
                            <div id="a1">
                                <div id="loader" class="spinner-border text-success" style="display: none;">
                                    <span class="sr-only">loading....</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="Date">Date</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="Date"
                                maxlength="10" id="dob" placeholder="Date   ">
                        </div>
                    </div>

                </div>
                <?php
                        } else {
                        }
                        if ($_SESSION['UserType'] == 'Department User') {

                            $query = "Select * from departmentmaster where DeptID=" . $_SESSION['DeptID'];
                            $result = mysqli_query($conn, $query);

                            ?>
                <select id="S1" name="DeptName" required="" class="form-control" value=" <?php echo $DeptID; ?>">
                    <option value="">----Department Name----</option>

                    <?php
                    while ($data = mysqli_fetch_array($result)) {
                        if ($data[0] == $_SESSION['DeptID'] || $data[0] == $DeptID) {
                            echo "<option value='$data[0]' selected> $data[1] </option>";
                        } else {
                            echo "<option value='$data[0]'> $data[1] </option>";
                        }
                    }

                    ?>
                </select>
            </div>
            </div>


            <div class="col-sm-6">
                <div class="form-group">
                    <label for="FacultyName" class="form-label">Faculty Name<sup style="color:red; font-size: 15px"
                            ;>*</sup>:</label>

                    <?php

                    $query = "Select * from facultyinfo where DeptID=" . $_SESSION['DeptID'];
                    $result = mysqli_query($conn, $query);

                    ?>
                    <select name="FacultyName" required="" id="SS" class="form-control"
                        value="<?php echo $_POST['FacultyID']; ?>">
                        <option value="">-----Faculty Name-----</option>

                        <?php
                        while ($data = mysqli_fetch_array($result)) {
                            if ($data[0] == $_POST['FacultyID']) {
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
                        <label for="LeaveType" class="form-label">Type Of Leave<sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>

                        <?php
                        $query = "Select * from typeofleave where Flag=0";
                        $result = mysqli_query($conn, $query);

                        ?>
                        <select name="LeaveType" required="" class="form-control" value="<?php echo $TypeOfLeaveID; ?>"
                            id="LeaveType" onchange="relo()">
                            <option value="">-----Type Of Leave-----</option>
                            <?php
                            while ($data = mysqli_fetch_array($result)) {
                                if ($data[0] == $_POST['LeaveTypeID']) {
                                    echo "<option value='$data[0]' selected> $data[1] </option>";
                                } else {
                                    echo "<option value='$data[0]'> $data[1] </option>";
                                }
                            }
                            ?>
                        </select>
                        <script>

                            function relo() {

                                var v1 = document.getElementById('LeaveType').value;
                                var v = document.getElementById('SS').value;
                                if (v != "") {
                                    $.ajax({
                                        url: 'ajax.php',
                                        type: 'POST',
                                        data: { LeaveTypeID: v1, FacultyID: v },
                                        beforeSend: function () {
                                            $('#loader').show();
                                        },
                                        success: function (data) {
                                            $('#a1').html(data);
                                        },
                                        complete: function () {
                                            $('#loader').hide();
                                        }
                                    });
                                }

                            }

                        </script>
                        <div id="a1">
                            <div id="loader" class="spinner-border text-success" style="display: none;">
                                <span class="sr-only">loading....</span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="Date">Date</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="Date"
                            maxlength="10" id="dob" placeholder="Date   ">
                    </div>
                </div>

            </div>
        <?php
                        }
                        ?>

        <br>

        <br>

        <div class="col-sm-12">
            <input class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit"
                value="<?php echo $btn; ?>"></input>
            <button type="button" class="btn btn-danger" value="Reset" onclick="Reset(event)">Reset</button>
            <script>
                function Reset(event) {

                    event.preventDefault();
                    const abcd = document.getElementById("S1");
                    abcd.value = "";
                    abcd.focus();
                    const abc = document.getElementById("S2");
                    abc.value = "";
                    abc.focus();
                    const a = document.getElementById("LeaveType");
                    a.value = "";
                    a.focus();
                    const dob = document.getElementById("dob");
                    dob.value = "";
                    dob.focus();
                    const SS = document.getElementById("SS");
                    SS.value = "";
                    SS.focus();

                }
            </script>
        </div>
        </div>

        </div>
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->
</body>

</html>