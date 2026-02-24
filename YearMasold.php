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
$YearID = "";
$Year = "";
$Flag = "";


$stmt = "Select YearID,Year from yearmaster Where Flag=0";
$result = $conn->query($stmt);
if (isset($_POST['btndelete'])) {
    $stmt = "Select YearID,Year from yearmaster Where Flag=0";
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
                    <h1 class="h3 mb-0 text-gray-800">Year Master</h1>

                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href='YearMaster.php' class="btn btn-info">Add New Year</a>
                    </div>
                    <div class="card-body">
                        <?php

                        if ($result->num_rows > 0) {
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Year</th>


                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Year</th>


                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {

                                            echo "<tr>";
                                            echo "<td id='h2'>" . $row['Year'] . "</td>";

                                            echo "<td><button value=" . $row['YearID'] . "' class='btn btn-info' id='h1'>Edit</button></td>";
                                            echo "<td><button data-id=". $row["YearID"] ."' class='btn btn-danger'>Delete</button>
                                            
                                             <input type='hidden' value='" . $row['YearID'] . "' name='YearID' id='YearID' /> 
                                            </td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                                <link rel="stylesheet" href="img/style.css">
                                <div id="error-message"></div>
                              <div id="success-message"></div>
                              <div id="modal">
                                <div id="modal-form">
                                  <h2>Edit Form</h2>
                                  <table cellpadding="10px" width="100%">
                                  </table>
                                  <div id="close-btn">X</div>
                                </div>
                              </div>
                                <script type="text/javascript" src="js/jquery.js"></script>
                                <script>
                                    $(document).on("click","#h1", function(){
                                     
                                      var YearID = $("#YearID").val();

                                      $.ajax({
                                        url: "load-update-form.php",
                                        type: "POST",
                                        data: {YearID : YearID },
                                        success: function(data) {
                                          $("#modal-form table").html(data);
                                        }
                                      
                                      })
                                    });

                                    //Hide Modal Box
                                    $("#close-btn").on("click",function(){
                                      $("#modal").hide();
                                    });

                                    //Save Update Form
                                      $(document).on("click","#edit-submit", function(){
                                        
                                        var Year = $("#Year").val();
                                        var YearID = $("#YearID").val();

                                        $.ajax({
                                          url: "ajax-update-form.php",
                                          type : "POST",
                                          data : {YearID : YearID , Year : Yaer},
                                          success: function(data) {
                                            if(data == 1){
                                              $("#modal").hide();
                                              loadTable();
                                            }
                                          }
                                        })
                                      });
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