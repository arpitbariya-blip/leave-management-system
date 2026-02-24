<?php

include('includes/connect.php');
include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['CPassword'])) {

        $query = "Select * from usermaster where UserMasterID=" . $_SESSION["UserMasterID"];
        $result = $conn->query($query);
        if ($result) {

            if ($result && mysqli_num_rows($result) > 0) {
                $OldPassword = $_POST["OldPassword"];
                $ConfirmPassword = $_POST["ConfirmPassword"];
                $NewPassword = $_POST["NewPassword"];

                $stmt2 = "Select * from usermaster where Password=$OldPassword";
                $result2 = $conn->query($stmt2);
                $User_Password = mysqli_num_rows($result2);

                if ($User_Password > 1) {
                    echo "<script>confirm('Please Enter Strong Password!')</script>";
                } else {
                 $User_data = mysqli_fetch_assoc($result);
                    if ($User_data['Password'] === $OldPassword && $NewPassword === $ConfirmPassword) {
                        $NewPassword = $_POST["NewPassword"];
                        $stmt = "Update usermaster set Password='" . $NewPassword . "' where UserMasterID=" . $_SESSION['UserMasterID'];
                        if ($conn->query($stmt) === TRUE) {
                            header("location:index.php?message=Password Changed SuccessFully");
                        }
                    } else {
                        echo "<script>alert('Password does Not Match!')</script>";
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Change Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-3 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">
                                            <?php echo $_SESSION['UserName']; ?> Are You Want To Change Password?
                                        </h1>

                                    </div>
                                    <form class="user" method="Post">
                                        <div class="form-group">
                                            <input type="Password" class="form-control" name="OldPassword"
                                                placeholder="Enter Old Password.....">
                                        </div>
                                        <div class="form-group">
                                            <input type="Password" class="form-control" name="NewPassword"
                                                placeholder="Enter New  Password.....">
                                        </div>
                                        <div class="form-group">
                                            <input type="Password" class="form-control" name="ConfirmPassword"
                                                placeholder="Enter New Confirm Password.....">
                                        </div>

                                        <br>

                                        <button type="submit" class="btn btn-primary btn-block" name="CPassword">Change
                                            Password</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="log.php"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>