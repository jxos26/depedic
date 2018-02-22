<?php
include ("config.php");
//include ("security.php");
session_start();
//echo $_SESSION['user_type']."Hello";
if($_SESSION['user_type']==1 && $_SESSION['user_type']==2){
  header('Location: login.php?notPermitted=true');
    }
?>
<?php
          
          if(isset($_GET['emp_id']))
            {
              $con=con();
              $emp_id=$_GET['emp_id'];

                if(isset($_POST['edit']))
                {
                  $con=con();
                $lname= $_POST['lname'];
                $fname= $_POST['fname'];
                $mname= $_POST['mname'];
                $extname= $_POST['extname'];
                $dob= $_POST['dob'];
                $sex=$_POST['sex'];
                $marstat=$_POST['marstat'];
                $postitle=$_POST['postitle'];
                $sgrade=$_POST['sgrade'];
                $salary=$_POST['salary'];
                $emp_stat=$_POST['emp_stat'];
                $stepdate = $_POST['stepdate'];
                $edol=$_POST['edol'];
                $work=$_POST['work'];   
                $emp_id=$_GET['emp_id'];

                $result = "UPDATE `personal_info` SET `lname`='$lname',`fname`='$fname',`mname`='$mname',`extname`='$extname',`dob`='$dob',`sex`='$sex',`marstat`='$marstat',`postitle`='$postitle',`sgrade`='$sgrade',`salary`='$salary',`emp_stat`='$emp_stat',`stepdate`='$stepdate',`edol`='$edol',`work`='$work' WHERE `emp_id`='$emp_id'";
                if ($con->query($result) === TRUE) {
                    echo '<script language="javascript">alert("Successfully Updated!")</script>';

                } else {
                    echo "Error updating record: " . $con->error;
                }
                
              }

            $sql="SELECT * FROM `personal_info` WHERE `emp_id`='$emp_id'";
            $qryE=mysqli_query($con, $sql);
            if(mysqli_num_rows($qryE)>=1){
              while($rows = mysqli_fetch_array($qryE)){
                $emp_id = $rows['emp_id'];
                $lname= $rows['lname'];
                $fname= $rows['fname'];
                $mname= $rows['mname'];
                $extname= $rows['extname'];
                $dob= $rows['dob'];
                $sex= $rows['sex'];
                $marstat= $rows['marstat'];
                $postitle= $rows['postitle'];
                $sgrade= $rows['sgrade'];
                $salary= $rows['salary'];
                $emp_stat= $rows['emp_stat'];
                $stepdate = $rows['stepdate'];
                $edol= $rows['edol'];
                $work= $rows['work'];   
              }
            }
            
          }
?>
<?php
  $errorName = false;
  $successAdd = false;
  
  $con=con();
  if(isset($_POST["add"])){
    $lname= $_POST['lname'];
    $fname= $_POST['fname'];
    $mname= $_POST['mname'];
    $extname= $_POST['extname'];
    $dob= $_POST['dob'];
    $sex=$_POST['sex'];
    $marstat=$_POST['marstat'];
    $postitle=$_POST['postitle'];
    $sgrade=$_POST['sgrade'];
    $salary=$_POST['salary'];
    $emp_stat=$_POST['emp_stat'];
    $edol=$_POST['edol'];
    $work=$_POST['work'];

    /*$sql="INSERT INTO `personal_info`(`lname`, `fname`, `mname`, `extname`, `dob`, `sex`, `marstat`, `postitle`, `sgrade`, `salary`, `emp_stat`, `edol`, `work`) VALUES ('$lname','$fname','$mname','$extname','$dob','$sex','$marstat','$postitle','$sgrade','$salary','$emp_stat','$edol','$work')";

                  if($con->query($sql) === TRUE){
                      $successAdd = true;
                  }else {
                      $errorName=true; 
                  }*/
    
    $res3=mysqli_query($con,"SELECT * FROM personal_info WHERE `lname` LIKE '$lname' AND fname LIKE '$fname' AND mname LIKE '$mname';");
    
    
    if(mysqli_num_rows($res3) > 0){
      $errorName=true; 
    }
    if(mysqli_num_rows($res3) == 0){
      $ins = mysqli_query($con,"INSERT INTO `personal_info` (`lname`, `fname`, `mname`, `extname`, `dob`, `sex`, `marstat`, `postitle`, `sgrade`, `salary`, `emp_stat`, `edol`, `work`) VALUES ('$lname','$fname','$mname','$extname','$dob','$sex','$marstat','$postitle','$sgrade','$salary','$emp_stat','$edol','$work')");
      //echo "INSERT INTO item VALUES (null, $supplier, '$name', '$qty', '$brand', '$price', '$restockdate', '$desc');";
      $successAdd = true;
    }
    discon($con);
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
  <title>Personnel Record System</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
   <!-- Favicons -->
  <link rel="icon" type="image/png" href="depedlogo.png">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><i class="fa fa-user"></i> <?php echo $_SESSION["fname"]." ".$_SESSION["lname"];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Personnel Records</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#addModal">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Add New Record</span>
          </a>
        </li>
        <li <?php if($_SESSION['user_type']==2) echo"style='display:none;'";?> class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
          <a class="nav-link" href="users.php">
            <i class="fa fa-fw fa-user-plus"></i>
            <span class="nav-link-text">Users</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Step Incriment">
          <a class="nav-link" href="step.php">
            <i class="fa fa-fw fa-line-chart"></i>
            <span class="nav-link-text">Step Incriment</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#Logout">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add Record</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="post" class="form-horizontal" data-toggle="validator">
              <div class="modal-body">
              <div class="form-group">
                <label for="name" class="col-form-label"><strong>Personal Information</strong></label>
              </div>
              <div class="form-group row">
                <label for="lname" class="sr-only">Last Name:</label>
                <div class="col-3">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="lname" id="lname" placeholder="Last Name" required>
                </div>
                <label for="fname" class="sr-only">First Name:</label>
                <div class="col-3">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="fname" id="fname" placeholder="First Name" required>
                </div>
                <label for="mname" class="sr-only">Middle Name:</label>
                <div class="col-3">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="mname" id="mname" placeholder="Middle Name" required>
                </div>
                <label for="extname" class="sr-only">Extn. Name:</label>
                <div class="col-2">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="extname" id="extname" placeholder="Extn Name" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="dob" class="col-2 col-form-label">Date of Birth:</label>
                <div class="col-4">
                  <input type="date" class="form-control" name="dob" id="dob" required>
                </div>
                <label for="sex" class="col-1 col-form-label">Sex:</label>
                <select name="sex" id="sex" class="form-control col-2">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
               </div>
              <div class="form-group row">
                <label for="marstat" class="col-2 col-form-label">Marital Status:</label>
                <select name="marstat" id="marstat" class="form-control col-2">
                  <option value="Single">Single</option>
                  <option value="Married">Married</option>
                  <option value="Widowed">Widowed</option>
                  <option value="Separted">Separted</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label"><strong>Employment Record</strong></label>
              </div>
              <div class="form-group row">
                <label for="postitle" class="sr-only">Position Title:</label>
                <div class="col-4">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="postitle" id="postitle" placeholder="Position Title" required>
                </div>
                <label for="sgrade" class="sr-only">Salary Grade:</label>
                <div class="col-4">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="sgrade" id="sgrade" placeholder="Salary Grade" required>
                </div>
                <label for="salary" class="sr-only">Salary:</label>
                <div class="col-4">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="salary" id="salary" placeholder="Salary" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="emp_stat" class="col-3 col-form-label">Employment Status:</label>
                <div class="col-4">
                  <input type="text" class="form-control" name="emp_stat" id="emp_stat" placeholder="Employment Status" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="edol" class="col-3 col-form-label">Effectivity Date of Latest:</label>
                <div class="col-4">
                  <input type="date" class="form-control" name="edol" id="edol" required>
                </div>
               </div>
               <div class="form-group row">
                <label for="work" class="col-3 col-form-label">Work Station/Unit:</label>
                <div class="col-6">
                  <input type="work" class="form-control" name="work" id="work" placeholder="Work Station/Unit" required>
                </div>
               </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" name='add' value="Add">
              </div>
            </form>
          </div>
          </div>
        </div>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Blank Page</li>
      </ol> -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Edit Record</div>
        <div class="card-body">
          <div class="col-lg-12">
            <center>
            <div class="alert alert-success" style="<?php if(!$successAdd) echo "display:none";?>">
              <strong>Successfully Added!</strong>
            </div>
            <div class="alert alert-danger" style="<?php if(!$errorName) echo "display:none";?>">
              <strong>Error Adding!</strong>
            </div>
          </center>
          </div>
          <form action="" method="post" class="form-horizontal" data-toggle="validator">
              <fieldset>
              <div class="form-group">
                <label for="name" class="col-form-label"><strong>Personal Information</strong></label>
              </div>
              <div class="form-group">
                <div class="col-lg-8">
                  <input type="hidden" class="form-control" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>">
                </div></div>
              <div class="form-group row">
                <label for="lnameE" class="sr-only">Last Name:</label>
                <div class="col-3">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="lname" id="lname" value="<?php echo $lname; ?>">
                </div>
                <label for="fname" class="sr-only">First Name:</label>
                <div class="col-3">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="fname" id="fname" value="<?php echo $fname; ?>">
                </div>
                <label for="mname" class="sr-only">Middle Name:</label>
                <div class="col-3">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="mname" id="mname" value="<?php echo $mname; ?>">
                </div>
                <label for="extname" class="sr-only">Extn. Name:</label>
                <div class="col-2">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="extname" id="extname" value="<?php echo $extname; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="dob" class="col-2 col-form-label">Date of Birth:</label>
                <div class="col-4">
                  <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $dob; ?>">
                </div>
                <label for="sex" class="col-1 col-form-label">Sex:</label>
                <select name="sex" id="sex" class="form-control col-2">
                  <option value="Male" <?php if(!empty($sex) && $sex == 'M' || $sex == 'Male' || $sex == 'MALE') echo 'selected="selected"'; ?>>Male</option>
                  <option value="Female" <?php if(!empty($sex) && $sex == 'F' || $sex == 'Female' || $sex == 'FEMALE') echo 'selected="selected"'; ?>>Female</option>
                </select>
               </div>
              <div class="form-group row">
                <label for="marstat" class="col-2 col-form-label">Marital Status:</label>
                <select name="marstat" id="marstat" class="form-control col-2">
                  <option value="Single" <?php if(!empty($marstat) && $marstat == 'Single' || $marstat == 'SINGLE' || $marstat == 'single' || $marstat == 'S' ) echo 'selected="selected"'; ?>>Single</option>
                  <option value="Married" <?php if(!empty($marstat) && $marstat == 'Married' || $marstat == 'MARRIED' || $marstat == 'M') echo 'selected="selected"'; ?>>Married</option>
                  <option value="Widowed" <?php if(!empty($marstat) && $marstat == 'Widow' || $marstat == 'W' || $marstat == 'WIDOW' || $marstat == 'Widowed' || $marstat == 'WIDOWED' ) echo 'selected="selected"'; ?>>Widowed</option>
                  <option value="Separated" <?php if(!empty($marstat) && $marstat == 'Separated' || $marstat == 'SEPARATED') echo 'selected="selected"'; ?>>Separated</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name" class="col-form-label"><strong>Employment Record</strong></label>
              </div>
              <div class="form-group row">
                <label for="postitle" class="sr-only">Position Title:</label>
                <div class="col-4">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="postitle" id="postitle" value="<?php echo $postitle; ?>">
                </div>
                <label for="sgrade" class="sr-only">Salary Grade:</label>
                <div class="col-4">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="sgrade" id="sgrade" value="<?php echo $sgrade; ?>">
                </div>
                <label for="salary" class="sr-only">Salary:</label>
                <div class="col-4">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="salary" id="salary" value="<?php echo $salary; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="emp_stat" class="col-3 col-form-label">Employment Status:</label>
                <div class="col-4">
                  <input type="text" class="form-control" name="emp_stat" id="emp_stat" value="<?php echo $emp_stat; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="stepdate" class="col-3 col-form-label">Step Date:</label>
                <div class="col-4">
                  <input type="date" class="form-control" name="stepdate" id="stepdate" value="<?php echo $stepdate; ?>">
                </div>
               </div>
              <div class="form-group row">
                <label for="edol" class="col-3 col-form-label">Effectivity Date of Latest:</label>
                <div class="col-4">
                  <input type="date" class="form-control" name="edol" id="edol" value="<?php echo $edol; ?>">
                </div>
               </div>
              <div class="form-group row">
                <label for="work" class="col-3 col-form-label">Work Station/Unit:</label>
                <div class="col-6">
                  <input type="work" class="form-control" name="work" id="work" value="<?php echo $work; ?>">
                </div>
               </div>
                  <input type="submit" class="btn btn-success pull-right" name='edit' value="Update">
              </fieldset>
            </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="Logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php?logout=true">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>
