<?php

/*session_start();
If(empty($_SESSION['AdminID']))
{
header("Location:frmlogin.php");
exit();
}*/
include('includes/header.php');
include('includes/navbar.php');
include('includes/connect.php');
If(empty($_SESSION['UserName']))
{
header("Location:Log.php");
exit();
}
?>

<?php


    $FacultyLeaveAllocationID = "";
    $FacultyName = "";
    $LeaveType = "";
    $Date = "";
    $Year = "";
    $DeptName = "";
    $message = "";

    $stmt = "SELECT FacultyLeaveAllocationID,FacultyName,LeaveType,Date,DeptName FROM (((facultyleaveallocation INNER JOIN facultyinfo ON facultyleaveallocation.FacultyInfoID=facultyinfo.FacultyInfoID)INNER JOIN typeofleave ON facultyleaveallocation.TypeOfLeaveID=typeofleave.TypeOfLeaveID)INNER JOIN departmentmaster ON facultyleaveallocation.DeptID=departmentmaster.DeptID)";
    $result = $conn->query($stmt);

    $stmt1 = "Select * from departmentmaster where DeptID=" . $_SESSION['DeptID'];
    $result1 = $conn->query($stmt1);

    if (isset($_POST['btndelete'])) {
        $stmt = "Select * from facultyleaveallocation where FacultyLeaveAllocationID=" . $_POST["FacultyLeaveAllocationID"];
        $result = $conn->query($stmt);

    }

    ?>
    <html id="AB">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Faculty Information </h1>

                    </div>
                    <?php
                    if (isset($_GET['message'])) {
                        ?>
                        <script>confirm("are you sure you want to delete?")</script>

                        <div class='alert alert-danger'>
                            <?php echo $_GET['message']; ?>
                        </div>

                        <?php
                    } else {
                        echo "";
                    }
                    ?>

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href='FacultyLeaveAllocation.php' class="btn btn-info">Add New FacultyLeaveAllocation</a>

                            <input type="date" name="Date" onchange="reload()" style="float: right" maxlength="10" id="DATE"
                                placeholder="Date" value="<?php if (isset($_POST['date1'])) {
                                    echo $_POST['date1'];
                                } ?>">
                            <label for="UserType" class="form-label" style="font-size: 20px; float:right;">Leave Date: <div
                                    id="loader" class="spinner-border text-success" style="display: none;">
                                    <span class="sr-only">loading....</span>
                                </div></label>
                        </div>
                        <script type="text/javascript" src="js/jquery.js"></script>
                        <script>
                            function reload() {

                                var v1 = document.getElementById('DATE').value;

                                $.ajax({
                                    url: 'FacultyLeaveAllocation1.php',
                                    type: 'POST',
                                    data: { date1: v1 },
                                    beforeSend: function () {
                                        $('#loader').show();
                                    },
                                    success: function (data) {
                                        $('#AB').html(data);
                                    },
                                    complete: function () {
                                        $('#loader').hide();
                                    }
                                });
                            }
                        </script>

                        <div class="card-body">
                            <?php

                            if ($result->num_rows > 0) {
                                ?>

                                <div class="table-responsive">

                                    <table class="table table-bordered" id="dataTable" s width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>DepartmentName</th>
                                                <th>Faculty Name</th>
                                                <th>Leave Type</th>
                                                <th>Date</th>



                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>DepartmentName</th>
                                                <th>Faculty Name</th>
                                                <th>Leave Type</th>
                                                <th>Date</th>






                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <?php
                                            if ($_SESSION['UserType'] == 'ESTA') {
                                            if (isset($_POST['date1'])) {
                                                while ($row = $result->fetch_assoc()) {
                                    
                                                    $Date = $_POST['date1'];
                                                    if ($row['Date'] === $Date) {


                                                        echo "<tr>";
                                                        echo "<td>" . $row['DeptName'] . "</td>";
                                                        echo "<td>" . $row['FacultyName'] . "</td>";
                                                        echo "<td>" . $row['LeaveType'] . "</td>";
                                                        echo "<td>" . $row['Date'] . "</td>";



                                                        echo "<td><a href='FacultyLeaveAllocat1.php?FacultyLeaveAllocationID=" . $row["FacultyLeaveAllocationID"] . "' class='btn btn-info'>Edit</a></td>";
                                                        echo "<td><a href='DelFacultyLeaveAllocat.php?FacultyLeaveAllocationID=" . $row["FacultyLeaveAllocationID"] . "' class='btn btn-danger' id='delete' onclick='delete()'>Delete</a>
                                             <input type='hidden' value='" . $row["FacultyLeaveAllocationID"] . "' name='FacultyLeaveAllocationID' id='FacultyLeaveAllocationID' /> 
                                            </td>";
                                                        echo "</tr>";
                                                    }
                                                }

                                            }
                                        }
                                        if ($_SESSION['UserType'] == 'Department User')
                                        {
                                    
                                            if (isset($_POST['date1'])) {
                                                $User_data = mysqli_fetch_assoc($result1);
                                                while ($row = $result->fetch_assoc()) {
                                    
                                                    $Date = $_POST['date1'];
                                                    if ($row['Date'] === $Date && $row['DeptName'] === $User_data['DeptName']) {


                                                        echo "<tr>";
                                                        echo "<td>" . $row['DeptName'] . "</td>";
                                                        echo "<td>" . $row['FacultyName'] . "</td>";
                                                        echo "<td>" . $row['LeaveType'] . "</td>";
                                                        echo "<td>" . $row['Date'] . "</td>";



                                                        echo "<td><a href='FacultyLeaveAllocat1.php?FacultyLeaveAllocationID=" . $row["FacultyLeaveAllocationID"] . "' class='btn btn-info'>Edit</a></td>";
                                                        echo "<td><a href='DelFacultyLeaveAllocat.php?FacultyLeaveAllocationID=" . $row["FacultyLeaveAllocationID"] . "' class='btn btn-danger' id='delete' onclick='delete()'>Delete</a>
                                             <input type='hidden' value='" . $row["FacultyLeaveAllocationID"] . "' name='FacultyLeaveAllocationID' id='FacultyLeaveAllocationID' /> 
                                            </td>";
                                                        echo "</tr>";
                                                    }
                                                }

                                            }
                                            
                                        }
                                            ?>
                                        
                                        </tbody>

                                    </table>
                                    <script>

                                        function delete ()
                                        {
                                            var v1 = document.getElementById('FacultyLeaveAllocationID').value;
                                            //document.write(v1);
                                            //v1 = $DeptID;
                                            self.location = 'DelFacultyLeaveAllocat.php?FacultyLeaveAllocationID=' + v1;
                                        }
                                    </script>
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
    <?php                                         
include('includes/scripts.php');
include('includes/footer.php');

?>