<?php 
include('includes/connect.php');
if(isset($_POST['btnlogout']))
{
    session_unset();
    session_destroy();
    header('Location:frmlogin.php');
   
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Leave Mgmt system</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Leave Management</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        
            <h6 class="collapse-header"><?php echo htmlspecialchars($_SESSION['UserType'], ENT_QUOTES, 'UTF-8');?></h6>
            <?php
            if ($_SESSION['UserType'] == 'Admin')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/year/YearMas.php">Year Master</a>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/department/DepartmentMas.php">Department Master</a>
            <?php 
            } 
            ?>
            <?php
            if ($_SESSION['UserType'] == 'Admin' || $_SESSION['UserType'] == 'ESTA')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/faculty/FacultyInfo1.php">Faculty Info</a>
            <?php 
            } 
            ?>
            <?php
            if ($_SESSION['UserType'] == 'Department User')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/faculty/FacultyInfo2.php">Faculty Info</a>
            <?php 
            } 
            ?>
            <?php
            if ($_SESSION['UserType'] == 'Admin')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/leave/LeaveOfType1.php">Leave Of Type</a>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/user/UserMas.php">User Master</a>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/user/AdminEntry.php">Create Admin</a>
            <?php 
            } 
            ?>
            <?php
            if ($_SESSION['UserType'] == 'Admin' || $_SESSION['UserType'] == 'ESTA')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/leave/FacultyLeaveMas.php">Faculty Leave Master</a>
            <?php 
            } 
            ?>
            <?php
            if ($_SESSION['UserType'] == 'Department User' || $_SESSION['UserType'] == 'ESTA')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/leave/FacultyLeaveAllocation1.php">Faculty Leave Allocation</a>
            <?php 
            } 
            ?>
            <?php
            if ($_SESSION['UserType'] == 'Department User')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/reports/Report1.php">Report</a>
            <?php 
            } 
            ?>
            <?php
            if ($_SESSION['UserType'] == 'ESTA')
            {
            ?>
            <a class="collapse-item" href="<?= BASE_URL ?>pages/reports/Report.php">Report</a>
            <?php 
            } 
            ?>
        </div>
    </div>
</li>
<!-- Nav Item - Utilities Collapse Menu -->

<!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->
<form method="post" action="frmlogin.php"> 
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure wants to logout ?</div>
                <div class="modal-footer">
                    
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="logout.php" class="btn btn-primary" id="btnlogout" name="btnlogout" >Logout</a>
                    
                </div>
            </div>
        </div>
    </div>
    </form>
  <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION['UserName'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= BASE_URL ?>img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="<?= BASE_URL ?>pages/user/ChangePassword.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
