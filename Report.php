<!doctype html>
<?php

include('includes/header.php');


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
    $SrNo = "";
    $FacultyInfoID = "";
    $FacultyName = "";
    $LeaveType = "";
    $TypeOfLeaveID = "";
    $DeptID = "";
    $YearID = "";
    $btn = "Submit";
    $message = "";


    if (isset($_POST["btnSubmit"])) {
        if ('Submit' == $_POST["btnSubmit"]) {
            $FacultyName = $_POST["FacultyName"];
            $Designation = $_POST["Designation"];

            $stmt = "Insert into facultyleavemaster(FacultyInfoID,TypeOfLeaveID,LeaveCount,YearID)values('" . $FacultyName . "','" . $LeaveType . "','" . $LeaveCount . "','" . $Year . "') ";

            if ($conn->query($stmt) === true) {
                $message = "<div class='alert alert-success'>Record Inserted successfully!</div>";
                echo "<div class='alert alert-success'>$message</div>";
            } else {
                echo "<div class='alert alert-success'>Record not inserted</div>";
            }
        }
    }
    ?>
</head>

<body>
        <div class="container" style="color:black;">



            <h4 class="display-6"><svg xmlns="http://www.w3.org/2000/svg" width="25 " height="25" fill="currentColor"
                    class="bi bi-person-lines-fill" viewBox="0 0 14 14">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />

                </svg> Report</h4>
            <a onclick="Printpage()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm
         " style="float: right; margin-top:20px"><i class="fas fa-download fa-sm text-white-50"></i> Generate
                Report</a>
                 <script type="text/javascript">
                    function Printpage()
                    {
                        window.print();
                    }
                </script>
            <hr style="border-top: 1px solid black" ; />

            <br><br>           <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="DeptName" class="form-label"> Department Name <sup
                                style="color:red; font-size: 15px" ;>*</sup>:</label>

                        <?php
                        $query = "Select * from departmentmaster where Flag=0";
                        $result = mysqli_query($conn, $query);

                        ?>
                        <select id="DeptID" name="DeptName" class="form-control">
                            <option value="">----Department Name----</option>
                            <?php
                            while ($data = mysqli_fetch_array($result)) {
                                if ($data[0] == $_POST['DeptID']) {
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
                        <label for="datevise" class="form-label">Select Which Wise You Need Record<sup
                                style="color:red; font-size: 15px" ;>*</sup>:</label>
                        <select name="datevise" class="form-control" id="datevise" onchange="reload()">
                            <option value="">-----Select-----</option>

                            <option value="Year wise">Year wise</option>
                            <option value="Month wise">Month wise</option>
                            <option value="Date wise">Date wise </option>

                        </select>
                        <script type="text/javascript" src="js/jquery.js"></script>
                        <script>
                            function reload() {
                                var v = document.getElementById('datevise').value;
                                if (v == 'Year wise') {
                                    $.ajax({
                                        complete: function () {
                                            $('#AB').show();
                                            $('#ABCD').hide();
                                            $('#ABC').hide();
                                            $('#ABCDE').hide();
                                        }
                                    });
                                }
                                else if (v == 'Month wise') {
                                    $.ajax({

                                        complete: function () {
                                            $('#AB').hide();
                                            $('#ABCD').hide();
                                            $('#ABCDE').hide();
                                            $('#ABC').show();

                                        }
                                    });
                                }
                                else if (v == 'Date wise') {
                                    $.ajax({

                                        complete: function () {
                                            $('#AB').hide();
                                            $('#ABC').hide();
                                            $('#ABCD').show();
                                            $('#ABCDE').show();

                                        }
                                    });
                                }
                                else {
                                    $.ajax({

                                        complete: function () {
                                            $('#AB').hide();
                                            $('#ABC').hide();
                                            $('#ABCD').hide();
                                            $('#ABCDE').hide();

                                        }
                                    });
                                }
                            }
                        </script>

                    </div>

                </div>
                <div class="col-sm-6" id="AB" style="display: none;">
                    <div class="form-group">
                        <label for="Year" class="form-label">Year<sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>

                        <?php
                        $query = "Select * from yearmaster Where Flag=0";
                        $result = mysqli_query($conn, $query);

                        ?>
                        <select id="Year" name="Year" class="form-control" onchange="yearwise()">
                            <option value="">-----Year-----</option>
                            <?php
                            while ($data = mysqli_fetch_array($result)) {
                                if ($data[1] == $_POST['YEAR']) {
                                    echo "<option value='$data[1]' selected> $data[1] </option>";
                                } else {
                                    echo "<option value='$data[1]'> $data[1] </option>";
                                }
                            }


                            ?>

                        </select>
                        <script>

                            function yearwise() {

                                var v1 = document.getElementById('Year').value;
                                var v = document.getElementById('Month').value;
                                var v2 = document.getElementById('DeptID').value;
                                var v3 = document.getElementById('datevise').value;
                                if (v2 != "") {
                                    $.ajax({
                                        url: 'yearwise.php',
                                        type: 'POST',
                                        data: { Year: v1, Month: v, DeptID: v2, datevise: v3 },
                                        success: function (data) {
                                            $('#a2').html(data);
                                        }
                                    });
                                }
                            }

                        </script>


                    </div>
                </div>
                <div class="col-sm-6" id="ABC" style="display: none;">
                    <div class="form-group">
                        <label for="Month" class="form-label">Month<sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>
                        <input type="Month" class="form-control" id="Month" onchange="monthwise()">

                        <script>

                            function monthwise() {

                                var v = document.getElementById('Month').value;
                                var v2 = document.getElementById('DeptID').value;
                                var v3 = document.getElementById('datevise').value;
                                if (v2 != "") {
                                    $.ajax({
                                        url: 'monthwise.php',
                                        type: 'POST',
                                        data: { Month: v, DeptID: v2, datevise: v3 },
                                        success: function (data) {
                                            $('#a2').html(data);
                                        }
                                    });
                                }
                            }

                        </script>

                    </div>
                </div>
                <div class="col-sm-6" id="ABCD" style="display: none;">
                    <div class="form-group">
                        <label for="StartDate" class="form-label">Start Date<sup style="color:red; font-size: 15px"
                                ;>*</sup>:</label>
                        <input type="date" class="form-control" name="StartDate" maxlength="10" id="StartDate"
                            placeholder="StartDate">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" id="ABCDE" style="display: none;">
                        <label for="EndDate">End Date<sup style="color:red; font-size: 15px" ;>*</sup>:</label>
                        <input type="date" class="form-control" name="EndDate" maxlength="10" id="EndDate"
                            placeholder="EndDate" onchange="date()">



                        </select>
                        <script>

                            function date() {

                                var v1 = document.getElementById('StartDate').value;
                                var v = document.getElementById('EndDate').value;
                                var v2 = document.getElementById('DeptID').value;
                                if (v2 != "") {
                                    $.ajax({
                                        url: 'datewise.php',
                                        type: 'POST',
                                        data: { StartDate: v1, EndDate: v, DeptID: v2 },
                                        success: function (data) {
                                            $('#a2').html(data);
                                        }
                                    });
                                }
                            }

                        </script>

                    </div>
                </div>

            </div>

            <br>
            <br>


            <br>

            <br>

            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <?php

                                if ($result->num_rows > 0) {

                                    ?>

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="getDataTable" name="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>SR NO </th>
                                                    <th>Faculty Name</th>

                                                    <?php
                                                    //$stmt2 = "SELECT typeofleave.LeaveType,facultyleavemaster.LeaveCount FROM typeofleave,facultyleavemaster";
                                                    $stmt2 = "SELECT LeaveType FROM typeofleave WHERE Flag=0 ORDER BY TypeOfLeaveID ";
                                                    $result2 = mysqli_query($conn, $stmt2);
                                                    $data = array();

                                                    while ($row = $result2->fetch_assoc()) {
                                                        //echo "<th>".$row['LeaveType']. "</th>";
                                                        $data[] = $row;
                                                    }

                                                    foreach ($data as $row) {
                                                        if ($row['LeaveType'] != "HCL") {
                                                            echo "<th>" . $row['LeaveType'] . "</th>";

                                                        }

                                                        $a[] = $row;
                                                    }

                                                    //print_r($a);                                     
                                                    ?>
                                                    <th>Total</th>

                                                </tr>
                                            </thead>
                                            <tbody id="a2">

                                            </tbody>

                                        </table>
                                    </div>

                                    <?php
                                } else {
                                    echo "<center><h2 style='color:red' >No Faculty Record found</h2></center>";
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>

            </div>

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