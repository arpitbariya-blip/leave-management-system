<!DOCTYPE html>
<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LeaveMGMT</title>
  <link rel="stylesheet" href="img/style.css">
</head>
<body>
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">
          <div class='alert alert-success' id="successmessage" style="display: none;">Updated successfully!</div>
            <div class="container-fluid">
               <div id="error-message"></div>
               <div id="success-message"></div>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Year Master</h1>

                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href='YearMaster.php' class="btn btn-info">Add New Year</a>
                    </div>
                    <div class="card-body">
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
</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "ajax-load.php",
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
        var YearID = $(this).data("id");
        var element = this;

        $.ajax({
          url: "ajax-delete.php",
          type : "POST",
          data : {YearID : YearID},
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
      var YearID = $(this).data("eid");

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
        
        var YearID = $("#edit-id").val();
        var Year = $("#edit-fname").val();

        $.ajax({
          url: "ajax-update-form.php",
          type : "POST",
          data : {YearID : YearID , Year : Year},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
               $("#successmessage").show();
              loadTable();
            }
          }
        })
      });

    // Live Search
     $("#search").on("keyup",function(){
       var search_term = $(this).val();

       $.ajax({
         url: "ajax-live-search.php",
         type: "POST",
         data : {search:search_term },
         success: function(data) {
           $("#table-data").html(data);
         }
       });
     });
  });

</script>
 

</html>
<?php
include('includes/scripts.php');
include('includes/footer.php');

?>