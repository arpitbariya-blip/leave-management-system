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
$FacultyInfoID = "";
$FacultyName = "";
$ContactNo = "";
$JoiningDate = "";
$RelievingDate = "";
$Designation = "";
$DeptName = "";
$message = "";

$stmt = "SELECT FacultyInfoID,FacultyName,JoiningDate,RelievingDate,ContactNo,Designation,DeptName FROM (facultyinfo INNER JOIN departmentmaster ON facultyinfo.DeptID=departmentmaster.DeptID);";
$result = $conn->query($stmt);
if (isset($_POST['btndelete'])) {

    $stmt = "Select * from facultyinfo where FacultyInfoID=" . $_POST["FacultyInfoID"];
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
                        <a href='FacultyInfo.php' class="btn btn-info">Add New Faculty</a>
                    </div>
                    <div class="card-body">
                        <?php

                        if ($result->num_rows > 0) {
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>FacultyName</th>
                                            <th>ContactNo</th>
                                            <th>JoiningDate</th>
                                            <th>RelievingDate</th>
                                            <th>Designation</th>
                                            <th>Department Name</th>

                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>FacultyName</th>
                                            <th>ContactNo</th>
                                            <th>JoiningDate</th>
                                            <th>RelievingDate</th>
                                            <th>Designation</th>
                                            <th>Department Name</th>






                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {


                                            echo "<tr>";

                                            echo "<td>" . $row['FacultyName'] . "</td>";
                                            echo "<td>" . $row['ContactNo'] . "</td>";
                                            echo "<td>" . $row['JoiningDate'] . "</td>";
                                            echo "<td>" . $row['RelievingDate'] . "</td>";
                                            echo "<td>" . $row['Designation'] . "</td>";
                                            echo "<td>" . $row['DeptName'] . "</td>";

                                            echo "<td><a href='FacultyInfo.php?FacultyInfoID=" . $row["FacultyInfoID"] . "' class='btn btn-info'>Edit</a></td>";

                                            echo "<td><a href='FacultyInfoDel.php?FacultyInfoID=" . $row["FacultyInfoID"] . "' id='delete' onclick='delete()'class='btn btn-danger'>Delete</a>
                                             <input type='hidden' value='" . $row["FacultyInfoID"] . "' name='FacultyInfoID' id='FacultyInfoID' /> 
                                            </td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>

                                </table>
                                <script>

                                    function delete ()
                                    {
                                        var v1 = document.getElementById('FacultyInfoID').value;
                                        self.location = 'FacultyInfoDel.php?FacultyInfoID=' + v1;
                                    }
                                </script>
                            </div>

                            <?php
                        } else {
                            echo "<center><h2 style='color:red' >No student Record found</h2></center>";
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