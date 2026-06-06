<?php


include('../../includes/header.php');
include('../../includes/navbar.php');
include('../../includes/connect.php');
$TypeOfLeaveID = "";
$LeaveType = "";
$Flag = "";


$stmt = "Select TypeOfLeaveID,LeaveType from typeofleave Where Flag=0";
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
                    <h1 class="h3 mb-0 text-gray-800">Type Of Leave</h1>

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
                        <a href='<?= BASE_URL ?>pages/leave/LeaveOfType.php' class="btn btn-info">Add New Leave Type</a>
                    </div>
                    <div class="card-body">
                        <?php

                        if ($result->num_rows > 0) {
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>LeaveType</th>


                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>LeaveType</th>


                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {

                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['LeaveType'], ENT_QUOTES, 'UTF-8') . "</td>";

                                            echo "<td><a href='LeaveOfType.php?TypeOfLeaveID=" . htmlspecialchars($row['TypeOfLeaveID'], ENT_QUOTES, 'UTF-8') . "' class='btn btn-info'>Edit</a></td>";
                                            echo "<td><a href='DelLeaveOfType.php?TypeOfLeaveID=" . htmlspecialchars($row["TypeOfLeaveID"], ENT_QUOTES, 'UTF-8') . "' class='btn btn-danger' id='deleteRecord' onclick='deleteRecord()'>Delete</a>
                                             <input type='hidden' value='" . htmlspecialchars($row['TypeOfLeaveID'], ENT_QUOTES, 'UTF-8') . "' name='TypeOfLeaveID' id='TypeOfLeaveID' /> 
                                            </td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                                    <script>

                                        function deleteRecord ()
                                        {
                                            var v1 = document.getElementById('TypeOfLeaveID').value;
                                            //document.write(v1);
                                            //v1 = $DeptID;
                                            self.location = 'DelLeaveOfType.php?TypeOfLeaveID=' + v1;


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