<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/connect.php');
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">
      <?php
      if (isset($_GET['message'])) {
        ?>


        <div class='alert alert-success'>
          <?php echo $_GET['message']; ?>
        </div>

        <?php
      } else {
        echo "";
      }
      ?>

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

      <?php
      if ($_SESSION['UserType'] == 'Admin') {
        ?>
        <a href="DataBaseBackup.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
          style="float:right;"><i class="fas fa-download fa-sm text-white-50"></i>DataBase Backup </a>
          </div>
          <br>
          <br>
        <!--<a href="Report2.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report Faculty</a>-->
        <?php

      }
      $stmt = "SELECT COUNT(FacultyInfoID) AS TOTAL FROM facultyinfo ";
      $result = mysqli_query($conn, $stmt);
      $User_data = mysqli_fetch_array($result);

      $stmt2 = "SELECT COUNT(DeptID) AS TOTAL FROM departmentmaster where Flag=0 ";
      $result2 = mysqli_query($conn, $stmt2);
      $User_data2 = mysqli_fetch_array($result2);

      $stmt3 = "SELECT COUNT(TypeOfLeaveID) AS TOTAL FROM typeofleave where Flag=0 ";
      $result3 = mysqli_query($conn, $stmt3);
      $User_data3 = mysqli_fetch_array($result3);
    $a = time();
    $b = strtotime('first day of next month');
    /*echo $a;
    echo"<br>";
    echo $b;*/
      ?>
</div>

<div class="row">

    <div class="col-sm-2"></div>
        <div class="col-sm-4">
                        <div class="row-xl-3 row-md-6 mb-2" >
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Total Faculties </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">       <?php echo $User_data['TOTAL'];  ?> </div>
                                        </div>
                                       <div class="col-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
</svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    </div>
                </div>

<br> 
<div class="row">

    <div class="col-sm-4"></div>
        <div class="col-sm-4">
                        <div class="row-xl-3 row-md-6 mb-2" >
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-3">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                               TotaL Department's</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo $User_data2['TOTAL'];  ?>          </div>
                                        </div>
                                        <div class="col-auto">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
  <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V.5ZM2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-1 2v1H2v-1h1Zm1 0h1v1H4v-1Zm9-10v1h-1V3h1ZM8 5h1v1H8V5Zm1 2v1H8V7h1ZM8 9h1v1H8V9Zm2 0h1v1h-1V9Zm-1 2v1H8v-1h1Zm1 0h1v1h-1v-1Zm3-2v1h-1V9h1Zm-1 2h1v1h-1v-1Zm-2-4h1v1h-1V7Zm3 0v1h-1V7h1Zm-2-2v1h-1V5h1Zm1 0h1v1h-1V5Z"/>
</svg> 
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    </div>
                    <br> 
<div class="row">

    <div class="col-sm-6"></div>
        <div class="col-sm-4">
                        <div class="row-xl-3 row-md-6 mb-2" >
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-3">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Total Leave Types </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $User_data3['TOTAL'];  ?> </div>
                                        </div>
                                        <div class="col-auto">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-escape" viewBox="0 0 16 16">
                                               <path d="M8.538 1.02a.5.5 0 1 0-.076.998 6 6 0 1 1-6.445 6.444.5.5 0 0 0 0-.997.076A7 7 0 1 1 8.5381.02Z"/>
                                               <path d="M7.096 7.828a.5.5 0 0 0 .707-.707L2.707 2.025h2.768a.5.5 0 1 0 0-1H1.5a.5.5 0 0 0-.5.5V5.5a.5.5 0 0 0 1 0V2.732l5.096 5.096Z"/>
                                           </svg>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    </div>
                    <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023</span>
                    </div>
                </div></footer> -->

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

   
  <?php

  include('includes/scripts.php');
  include('includes/footer.php');

  ?>