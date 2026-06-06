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

$stmt1 = $conn->prepare("SELECT * FROM departmentmaster WHERE DeptID=?");
$stmt1->bind_param("i", $_SESSION['DeptID']);
$stmt1->execute();
$result1 = $stmt1->get_result();

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
                <!-- DataTales Example -->
                <div class="card shadow mb-4">

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





                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $User_data = mysqli_fetch_assoc($result1);

                                        while ($row = $result->fetch_assoc()) {
                                            if ($User_data['DeptName'] === $row['DeptName']) {

                                                echo "<tr>";

                                                echo "<td>" . htmlspecialchars($row['FacultyName'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['ContactNo'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['JoiningDate'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['RelievingDate'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['Designation'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['DeptName'], ENT_QUOTES, 'UTF-8') . "</td>";


                                                echo "</tr>";
                                            }
                                        }
                                        ?>

                                    </tbody>

                                </table>
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