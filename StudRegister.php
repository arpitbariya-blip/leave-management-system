<!doctype html>
<?php
  session_start();
  If(empty($_SESSION['AdminID']))
  {
        $filename="img/profileimg.jpg";
        $DOB="";
        $PH="";
        $Minor="";
        $TFW="";
        $Shift="";
  }
  else
  {
    include('includes/header.php');
    include('includes/navbar.php'); 
  }
  
  
  include('includes/connect.php');
 ?>
<html lang="en">
  <head>
    <?php 
    
      $EnrollNo="";
      $FirstName="";
      $MiddleName="";
      $LastName="";
      $Gender="";
      $category="";
      $dob="";
      $acno="";
      $ph="";
      $monor="";
      $smobile="";
      $pmobile="";
      $email="";
      $address="";
      $department="";
      $admittedyear="";
      $semester="";
      $tfw="";
      $shift="";
      $date="";
      $message="";
      
      if(isset($_POST["btnSubmit"]))
      {
        if(empty($_POST['FirstName']) and empty($_POST['LastName']) and empty($_POST['dob']) and empty($_POST['smobile']) and empty($_POST['pmobile']) and empty($_POST['address']) and empty($_POST['StudPhoto']))
        {

        }
        else
        {
            $EnrollNo=$_POST['EnrollmentNo'];
            $FirstName=$_POST['FirstName'];
            $MiddleName=$_POST['MiddleName'];
            $LastName=$_POST['LastName'];
            $Gender=$_POST['Gender'];
            $category=$_POST['category'];
            $dob=$_POST['dob'];
            $acno=$_POST['acno'];
            $ph=$_POST['ph'];
            $minor=$_POST['minor'];
            $smobile=$_POST['smobile'];
            $pmobile=$_POST['pmobile'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $department=$_POST['department'];
            $admittedyear=$_POST['admittedyear'];
            $semester=$_POST['semester'];
            $tfw=$_POST['tfw'];
            $shift=$_POST['shift'];
            $ip = getenv("REMOTE_ADDR") ;
            date_default_timezone_set("Asia/Calcutta");
            $date = date('m/d/Y h:i:s a', time());

            
            $filename = $_POST["admittedyear"].$_POST["FirstName"].$_POST["LastName"].".jpg";
            $tempname = $_FILES["StudPhoto"]["tmp_name"];    
            $folder = "ProfilePic/".$filename;
            $stmt = "Insert into studregistration (EnrollmentNo,profile,FirstName,MiddleName,LastName,Gender,Category,DOB,AdharcardNo,PH,Minority,MobileNo,ParentsMobileNo,EmailId,Address,DepartmentName,AdmittedYear,Semester,TFW,Shift,RecordCreated,ipadd)values('".$EnrollNo."','".$filename."','".$FirstName."','".$MiddleName."','".$LastName."','".$Gender."','".$category."','".$dob."','".$acno."','".$ph."','".$minor."','".$smobile."','".$pmobile."','".$email."','".$address."','".$department."','".$admittedyear."','".$semester."','".$tfw."','".$shift."','".$date."','".$ip."')";
            
            if($conn->query($stmt)===true)
            {
              move_uploaded_file($tempname, $folder);
              $message ="Student record created successfully!";
            }
        }   
      }
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
      var loadFile = function(event) {
       var image = document.getElementById('output');
       image.src = URL.createObjectURL(event.target.files[0]);
      };
      function isNumber(e){
                 e = e || window.event;
                 var charCode = e.which ? e.which : e.keyCode;
                return /\d/.test(String.fromCharCode(charCode));
     };
    </script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Student Registration - GPDahod</title>
  </head>
  <body>

    <form method ="post" action="" enctype="multipart/form-data">
      <div class="container" style="color:black;">

       <center> <h1 class="display-6">Student Registration </h1></center> 
       <?php
              if($message<>"")
              {
                echo '<div class="alert alert-success alert-dismissible fade show"  role="alert"> Student record created successfully !
                  </div>';
              }
         ?> 
       <h4 class="display-6"><svg xmlns="http://www.w3.org/2000/svg" width="25 " height="25" fill="currentColor" class="bi bi-person-lines-fill"     viewBox="0 0 14 14">
         <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
         
        </svg> Student Personal Details</h4>
      <hr style="border-top: 1px solid black"; />  
    <?php
        if(empty($_GET['StudRegID']))
        {

        }
        else
        {
        $stmt="Select * from studregistration where StudRegID=".$_GET['StudRegID'];
        $result = $conn->query($stmt);
        while( $row = $result->fetch_assoc())
            {
                $EnrollNo=$row['EnrollmentNo'];
               
                //$filename="img/profileimg.jpg";
                
                $filename = "ProfilePic/".$row['profile'];
                
                $FirstName=$row['FirstName'];
                $MiddleName=$row['MiddleName'];
                $LastName=$row['LastName'];
                $Gender=$row['Gender'];
                $category=$row['Category'];
                $DOB=$row['DOB'];
                $acno=$row['AdharcardNo'];
                $PH=$row['PH'];
                $Minor=$row['Minority'];
                $smobile=$row['MobileNo'];
                $pmobile=$row['ParentsMobileNo'];
                $email=$row['EmailId'];
                $address= $row['Address'];
                $department=$row['DepartmentName'];
                $admittedyear=$row['AdmittedYear'];
                $semester=$row['Semester'];
                $TFW=$row['TFW'];
                $Shift=$row['Shift'];
            }
        }
    ?>
       <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                     <label for="fname">Enrollment No :</label>
                     <input type="text" class="form-control" name="EnrollmentNo" value= "<?php echo $EnrollNo?>" onkeypress="return isNumber(event);" maxlength="12" id="EnrollmentNo"  placeholder="Enrollment No">
                </div>
            </div>
            <div class="col-sm-6">
                <label for="formFile" class="form-label">Upload your photo<sup style="color:red; font-size: 15px";>*</sup> :</label>
                <input class="form-control" type="file" value= "<?php echo $filename ?>" name="StudPhoto" id="StudPhoto" onchange="loadFile(event)" accept=".jpg,.png,.gif" required=""><?php echo $filename ?></input>
                
            </div>
            <div class="col-sm-2">
                <img  src="<?php echo $filename; ?>" id= "output" width="100px" height="200px" class="img-thumbnail" >
            </div>
         </div>

        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                     <label for="fname">First Name<sup style="color:red; font-size: 15px";>*</sup>:</label>
                     <input type="text" class="form-control" value= "<?php echo $FirstName?>" name="FirstName" id="FirstName" placeholder="First Name" required="">
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                     <label for="Mname">Middle Name :</label>
                     <input type="text" class="form-control" value= "<?php echo $MiddleName?>" name="MiddleName" id="MiddleName" placeholder="Father Name" >
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                     <label for="Sname">Surname Name<sup style="color:red; font-size: 15px";>*</sup>:</label>
                     <input type="text" class="form-control" value= "<?php echo $LastName?>" name="LastName" id="FirstName" placeholder="Surname Name" required="">
                </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm">
            
                <label for="Gender"  class="form-label">Gender<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <br/>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="Gender" type="radio" <?php echo ($Gender=='M')?'checked':'' ?>  name="inlineRadioOptions" id="Male" value="M" checked>
                    <label class="form-check-label" for="Male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="Gender" type="radio" <?php echo ($Gender=='F')?'checked':'' ?> name="inlineRadioOptions" id="Female" value="F">
                    <label class="form-check-label" for="Female">Female</label>
                </div>
            </div>
            <div class="col-sm">
                <label for="cast" class="form-label">Category<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <select name="category" name="category"  class="form-control" id="category">
                    <option value="OPEN" <?php echo ($category =='OPEN') ? 'selected' : '';?>> OPEN</option>
                    <option value="SEBC" <?php echo ($category =='SEBC') ? 'selected' : '';?>>SEBC</option>
                    <option value="ST" <?php echo ($category =='ST') ? 'selected' : '';?>>ST</option>
                    <option value="SC" <?php echo ($category =='SC') ? 'selected' : '';?>>SC</option>
                </select>
            </div>
            <div class="col-sm">
                <label for="dob">Date of Birth<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <input type="Date" name="dob" value= "<?php echo $DOB?>" class="form-control" id="dob" placeholder="Date of Birth" required="">
            </div>
         </div>
            <br/>
         <div class="row">
            <div class="col-sm">
                <div class="form-group">
                     <label for="Adharcard">Adharcard No<sup style="color:red; font-size: 15px";>*</sup>:</label>
                     <input type="text" name="acno" maxlength="12" value= "<?php echo $acno?>" onkeypress="return isNumber(event);" class="form-control" id="acno" placeholder="Adarcard No">
                </div>
            </div>
            <div class="col-sm">
       
                <label for="ph">Physcal Handicap<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <br/> 
                <div class="form-check form-check-inline">

                    <input class="form-check-input"  type="radio" <?php echo ($PH=='Y')?'checked':'' ?>  name="ph" id="ph" value="Y" >
                    <label class="form-check-label" for="ph">YES</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" <?php echo ($PH=='N')?'checked':'' ?> name="ph" id="ph" value="N" checked>
                    <label class="form-check-label" for="ph">NO</label>
                </div>

               
            </div>
            <div class="col-sm">
                <label for="ph">Is Minority<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <br/>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" <?php echo ($Minor=='Y')?'checked':'' ?>  name="minor" id="minor" value="Y" >
                    <label class="form-check-label" for="ph">YES</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" <?php echo ($PH=='N')?'checked':'' ?> name="minor" id="minor" value="N" checked>
                    <label class="form-check-label" for="minor">NO</label>
                </div>
            </div>
         </div>

         <!-- Contact Details -->
         <h4 class="display-6"><img src="img/contact.png" width="25px" height="25px" />
         Contact Details</h4>
         <hr style="border-top: 1px solid black"; /> 
         <div class="row">
            <div class="col-sm">
                <div class="form-group">
                     <label for="smobile">Student Mobile No<sup style="color:red; font-size: 15px";>*</sup>:</label>
                     <input type="text" name="smobile" value= "<?php echo $smobile; ?>" maxlength="10" onkeypress="return isNumber(event);" class="form-control" id="smobile" placeholder="Studnet Mobile" required="" >
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                     <label for="pmobile">Parents Mobile No<sup style="color:red; font-size: 15px";>*</sup>:</label>
                     <input type="text" name="pmobile" maxlength="10" value= "<?php echo $pmobile; ?>" onkeypress="return isNumber(event);" class="form-control" id="pmobile" placeholder="Parents Mobile" required="">
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                     <label for="Email">Email Id :</label>
                     <input type="email" name="email" value= "<?php echo $email?>" class="form-control" id="email" placeholder="name@example.com">
                </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                     <label for="address" class="form-label"> Full Address (with city and pincode)<sup style="color:red; font-size: 15px";>*</sup>:</label>
                     <textarea class="form-control" name="address" id="address" rows="3" required=""><?php echo $address; ?></textarea>
                </div>
            </div>
         </div>
          <!-- Education and Admission Details -->
         <h4 class="display-6"><img src="img/education.png" width="25px" height="30px" />
         Education and Admission Details</h4>
         <hr style="border-top: 1px solid black"; />
         <div class="row">
            <div class="col-sm">
                <label for="department" class="form-label" >Department Name<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <select name="department" class="form-control" id="department">
                    <option value="CivilDept" <?php echo ($department =='CivilDept') ? 'selected' : '';?>>Civil Department (06)</option>
                    <option value="CompterDept" <?php echo ($department =='ComputerDept') ? 'selected' : '';?>>Computer Department(07)</option>
                    <option value="CDDM" <?php echo ($department =='CDDM') ? 'selected' : '';?>>Computer Aided Design and Dress Making (51) </option>
                    <option value="ElectricalDept" <?php echo ($department =='ElectricalDept') ? 'selected' : '';?>>Electrical Department (09)</option>
                    <option value="ECDept" <?php echo ($department =='ECDept') ? 'selected' : '';?>>Electronics and Communication (11)</option>
                    <option value="MechanicalDept" <?php echo ($department =='MechanicalDept') ? 'selected' : '';?>>Mechanical Department (19)</option>
                    
                </select>
            </div>
            <div class="col-sm">
       
                <label for="admittedyear" class="form-label" >Admitted year<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <select name="admittedyear" class="form-control" id="admittedyear">
                    <option  value="2015" <?php echo ($admittedyear =='2015') ? 'selected' : '';?>>2015</option>
                    <option value="2016" <?php echo ($admittedyear =='2016') ? 'selected' : '';?>>2016</option>
                    <option value="2017" <?php echo ($admittedyear =='2017') ? 'selected' : '';?>>2017</option>
                    <option value="2018"<?php echo ($admittedyear =='2018') ? 'selected' : '';?>>2018</option>
                    <option value="2019"<?php echo ($admittedyear =='2019') ? 'selected' : '';?>>2019</option>
                    <option value="2020"<?php echo ($admittedyear =='2020') ? 'selected' : '';?>>2020</option>
                    <option value="2021"<?php echo ($admittedyear =='2021') ? 'selected' : '';?>>2021</option>
                    <option value="2022"<?php echo ($admittedyear =='2022') ? 'selected' : '';?>>2022</option>
                    <option value="2023"<?php echo ($admittedyear =='2023') ? 'selected' : '';?>>2023</option>
                    <option value="2024"<?php echo ($admittedyear =='2024') ? 'selected' : '';?>>2024</option>
                    <option value="2025"<?php echo ($admittedyear =='2025') ? 'selected' : '';?>>2025</option>
                    <option value="2026"<?php echo ($admittedyear =='2026') ? 'selected' : '';?>>2026</option>
                    <option value="2027"<?php echo ($admittedyear =='2027') ? 'selected' : '';?>>2027</option>
                    <option value="2028"<?php echo ($admittedyear =='2028') ? 'selected' : '';?>>2028</option>
                    <option value="2029"<?php echo ($admittedyear =='2029') ? 'selected' : '';?>>2029</option>
                    <option value="2029"<?php echo ($admittedyear =='2030') ? 'selected' : '';?>>2030</option>
                </select>

               
            </div>
            <div class="col-sm">
                <label for="semester" class="form-label" >Semester<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <select name="semester" class="form-control" id="semester">
                    <option value="1" <?php echo ($semester =='1') ? 'selected' : '';?>>Sem 1</option>
                    <option value="2" <?php echo ($semester =='2') ? 'selected' : '';?>>Sem 2</option>
                    <option value="3" <?php echo ($semester =='3') ? 'selected' : '';?>>Sem 3 </option>
                    <option value="4" <?php echo ($semester =='4') ? 'selected' : '';?>>Sem 4</option>
                    <option value="5" <?php echo ($semester =='5') ? 'selected' : '';?>>Sem 5</option>
                    <option value="6" <?php echo ($semester =='6') ? 'selected' : '';?>>Sem 6</option>
                </select>
            </div>
         </div> 
         <br/>
         <div class="row">
            
            <div class="col-sm-4">
       
                <label for="tfw" class="form-label">Is TFW (Tution Fees Wave Scheme)<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <br/> 
                <div class="form-check form-check-inline">

                    <input class="form-check-input"  type="radio" <?php echo ($TFW=='Y')?'checked':'' ?> name="tfw" id="tfw" value="Y" >
                    <label class="form-check-label" for="tfw">YES</label>
                </div>
                
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" <?php echo ($TFW=='N')?'checked':'' ?> name="tfw" id="tfw" value="N" checked>
                    <label class="form-check-label" for="tfw">NO</label>
                </div>

            </div>
            <div class="col-sm-4">
                <label for="shift" class="form-label">Shift<sup style="color:red; font-size: 15px";>*</sup>:</label>
                <br/>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  type="radio" <?php echo ($Shift=='M')?'checked':'' ?>  name="shift" id="shift" value="M" checked>
                    <label class="form-check-label" for="shift">MORNING</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" <?php echo ($Shift=='E')?'checked':'' ?> name="shift" id="shift" value="E" >
                    <label class="form-check-label" for="shift">EVENING</label>
                </div>
            </div>
         </div>

         <div class="row" style="text-align: right; margin-top:20px";>
            
            <div class="col-sm-12">
                <input class="btn btn-primary" type="submit" name ="btnSubmit" id="btnSubmit" value="Submit"></input>
                <button type="button" class="btn btn-danger">Reset</button>
            </div>
         </div>
         
    </div>
    </form>
    
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
    <script src="js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php 
        include('includes/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>