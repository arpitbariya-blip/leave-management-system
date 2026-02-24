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

?>
<html>
    <div id="content-wrapper" class="d-flex flex-column">
<link rel="stylesheet" href="img/style.css">
        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">User Information </h1>

                </div>
                
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href='UserMaster.php' class="btn btn-info">Add New User</a>
                    </div>
                    <div class="card-body">
                       

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>UserName</th>
                                            <th>Password</th>
                                            <th>UserType</th>


                                            <th>Department Name</th>

                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>UserName</th>
                                            <th>Password</th>
                                            <th>UserType</th>

                                            <th>Department Name</th>






                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="table-data">
                                    </tbody>

                                </table>
                               
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>
</div>
                            </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "UserMas-load-data.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load

    //Delete Records
    $(document).on("click","#btn2", function(){
      if(confirm("Do you really want to delete this record ?")){
        var UserMasterID = $(this).data("id");
        var element = this;

        $.ajax({
          url: "UserDelMas.php",
          type : "POST",
          data : {UserMasterID : UserMasterID},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

    //Show Modal Box
    $(document).on("click","#btn1", function(){
      $("#modal").show();
      var UserMasterID = $(this).data("eid");

      $.ajax({
        url: "UserMaster1.php",
        type: "POST",
        data: {UserMasterID : UserMasterID },
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
        
        var UserMasterID = $("#edit-id").val();
        var UserType = $("#edit-utype").val();
        var UserName = $("#edit-name").val();
        var DeptName = $("#edit-Dname").val();
        var pass = $("#edit-pass").val();
        $.ajax({
          url: "UserdataUpdate.php",
          type : "POST",
          data : {UserType : UserType, UserMasterID: UserMasterID, UserName:UserName, DeptName:DeptName, Password:pass},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
               // $("#successmessage").show();
              loadTable();
            }
          }
        })
      });
     
  });

</script>

          
<?php
include('includes/scripts.php');
include('includes/footer.php');

?>
</html>