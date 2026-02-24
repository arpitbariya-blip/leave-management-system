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
$FacultyLeaveMasterID = "";
$FacultyName = "";
$DeptName = "";
$LeaveType = "";
$LeaveCount = "";
$Year = "";
$message = "";

$stmt = "SELECT FacultyLeaveMasterID,FacultyName,LeaveCount,LeaveType,Year,DeptName FROM ((((facultyleavemaster INNER JOIN facultyinfo ON facultyleavemaster.FacultyInfoID=facultyinfo.FacultyInfoID)INNER JOIN  typeofleave ON facultyleavemaster.TypeOfLeaveID=typeofleave.TypeOfLeaveID)INNER JOIN yearmaster ON facultyleavemaster.YearID=yearmaster.YearID)INNER JOIN departmentmaster ON facultyleavemaster.DeptID=departmentmaster.DeptID);";
$result = $conn->query($stmt);
if (isset($_POST['btndelete'])) {



    $stmt = "Select * from facultyleavemaster where FacultyLeaveMasterID=" . $_POST["FacultyLeaveMasterID"];
    $result = $conn->query($stmt);

}

?>
<form method="post" action="">

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
                    <script>alert("Are You Want To Sure To Delete ?")</script>

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
                        <a href='FacultyLeaveMaster1.php' class="btn btn-info">Add New FacultyLeave</a>
                    </div>
                    <div class="card-body">
                        <?php

                        if ($result->num_rows > 0) {
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Department Name</th>
                                            <th>FacultyName</th>
                                            <th>LeaveType</th>
                                            <th>LeaveCount</th>


                                            <th>Year</th>

                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Department Name</th>
                                            <th>FacultyName</th>
                                            <th>LeaveType</th>
                                            <th>LeaveCount</th>

                                            <th>Year</th>






                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {


                                            echo "<tr>";
                                            echo "<td>" . $row['DeptName'] . "</td>";
                                            echo "<td>" . $row['FacultyName'] . "</td>";
                                            echo "<td>" . $row['LeaveType'] . "</td>";
                                            echo "<td>" . $row['LeaveCount'] . "</td>";

                                            echo "<td>" . $row['Year'] . "</td>";

                                            echo "<td><a href='FacultyLeaveMaster.php?FacultyLeaveMasterID=" . $row["FacultyLeaveMasterID"] . "' class='btn btn-info'>Edit</a></td>";

                                            echo "<td><a href='FacultyLeaveDelMaster.php?FacultyLeaveMasterID=" . $row["FacultyLeaveMasterID"] . "' class='btn btn-danger' id='delete' onclick='delete()'>Delete</a>
                                             <input type='hidden' value='" . $row["FacultyLeaveMasterID"] . "' name='FacultyLeaveMasterID' id='FacultyLeaveMasterID' /> 
                                            </td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>

                                </table>
                                <script>

                                    function delete ()
                                    {
                                        var v1 = document.getElementById('FacultyLeaveMasterID').value;
                                        //document.write(v1);
                                        //v1 = $DeptID;
                                        self.location = 'FacultyLeaveDelMaster.php?FacultyLeaveMasterID=' + v1;


                                    }
                                </script>
                            </div>

                            <?php require_once 'FacultyLeaveDelMaster.php'; ?>



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
    <!-- End of Main Content -->
</form>
<?php
include('includes/scripts.php');
include('includes/footer.php');

?>