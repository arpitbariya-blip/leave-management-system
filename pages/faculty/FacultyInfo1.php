<?php


include('../../includes/header.php');
include('../../includes/navbar.php');
include('../../includes/connect.php');
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
                        <?php echo htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8'); ?>
                    </div>

                    <?php
                } else {
                    echo "";
                }
                ?>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href='<?= BASE_URL ?>pages/faculty/FacultyInfo.php' class="btn btn-info">Add New Faculty</a>
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

                                            echo "<td>" . htmlspecialchars($row['FacultyName'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['ContactNo'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['JoiningDate'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['RelievingDate'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['Designation'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['DeptName'], ENT_QUOTES, 'UTF-8') . "</td>";

                                            echo "<td><a href='FacultyInfo.php?FacultyInfoID=" . htmlspecialchars($row["FacultyInfoID"], ENT_QUOTES, 'UTF-8') . "' class='btn btn-info'>Edit</a></td>";

                                            echo "<td><a href='FacultyInfoDel.php?FacultyInfoID=" . htmlspecialchars($row["FacultyInfoID"], ENT_QUOTES, 'UTF-8') . "' id='deleteRecord' onclick='deleteRecord()' class='btn btn-danger'>Delete</a>
                                             <input type='hidden' value='" . htmlspecialchars($row["FacultyInfoID"], ENT_QUOTES, 'UTF-8') . "' name='FacultyInfoID' id='FacultyInfoID' /> 
                                            </td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>

                                </table>
                                <script>

                                    function deleteRecord ()
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
include('../../includes/scripts.php');
include('../../includes/footer.php');

?>