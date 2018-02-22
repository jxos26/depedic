<?php
include ("config.php");
//include ("security.php");
session_start();
//echo $_SESSION['user_type']."Hello";
if($_SESSION['user_type']!=2){
  header('Location: login.php?notPermitted=true');
    }
    $dms_id=$_GET['dms_id'];
    $status=$_GET['status'];
    $year= date("Y");
    $sec =$_SESSION["section"];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Document Management System</title>
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
                  <?php $con=con();
                  $section = $_SESSION['section'];
                  $sql= "SELECT * FROM `documents` WHERE `to_office` = '$section' AND status='Pending'";
                  $res = mysqli_query($con,$sql);
                  $row_count1 = mysqli_num_rows($res); ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Personnel Records">
          <a class="nav-link" href="myDocu.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Documents Requests <span class="badge badge-pill badge-primary"><?php echo $row_count1; ?></span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Personnel Records">
          <a class="nav-link" href="documents.php">
            <i class="fa fa-fw fa-table"></i>
            <?php $con=con();
                  $section = $_SESSION['section'];
                  $sql= "SELECT * FROM `documents` WHERE `rcv_office` = '$section' AND status='Pending'";
                  $res = mysqli_query($con,$sql);
                  $row_count2 = mysqli_num_rows($res); ?>
            <span class="nav-link-text">Documents Received <span class="badge badge-pill badge-primary"><?php echo $row_count2; ?></span></span>
          </a>
        </li>
        <li <?php if($_SESSION['user_type']==2) echo"style='display:none;'";?> class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
          <a class="nav-link" href="users.php">
            <i class="fa fa-fw fa-user-plus"></i>
            <span class="nav-link-text">Users</span>
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
       
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Document Details</div>
        <div class="card-body">
          <div class="col-md-10"> 
          <?php   

              if(isset($_GET['dms_id']))
                  {
                  $con=con();
                  $dms_id=$_GET['dms_id'];
                  
                  $sql= "SELECT * FROM `documents` WHERE `dms_id` = '$dms_id';";
                  $res = mysqli_query($con,$sql);

                  //var_dump($res);
                  //$row = mysqli_fetch_array($res);
                  while ($row = mysqli_fetch_array($res)) {

                    ?>
                    <form method="post" action="mydocu.php" class="form-horizontal">
                      <div class="form-group row">
                        <input type="text" style="display:none" value="<?php echo $dms_id;?>" name="dms_id">
                        <input type="text" style="display:none" value="<?php echo $dms_id.'-'.$year."-DOIC"; ?>" name="docrefno">
                        <input type="text" style="display:none" value="<?php echo $sec.'-'.$fname.'-'.$lname;?>" name="rcv_by">
                      </div>
                      <div class="form-group row">
                        <label for="date_rcv" class="col-3 col-form-label">Date Received:</label>
                        <div class="col-9">
                          <input type="text" class="form-control" name="date_rcv" id="date_rcv" value="<?php echo $row['date_rcv'];?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="rcv_from" class="col-3 col-form-label">Received from:</label>
                        <div class="col-9">
                          <input type="text" class="form-control" name="rcv_from" id="rcv_from" value="<?php echo $row['rcv_from'];?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="doctitle" class="col-3 col-form-label">Document Title:</label>
                        <div class="col-9">
                          <input type="text" class="form-control" name="doctitle" id="doctitle" value="<?php echo $row['doctitle'];?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="rcv_office" class="col-3 col-form-label">Receiving office:</label>
                        <div class="col-9">
                          <input type="text" class="form-control" name="rcv_office" id="rcv_office" value="<?php echo $row['rcv_office'];?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="status" class="col-3 col-form-label">Document Status:</label>
                        <div class="col-9">
                          <input type="text" class="form-control" name="status" id="status" value="<?php echo $row['status'];?>" disabled>
                        </div>
                      </div>
                      <div <?php if($row['to_office']!=$_SESSION['section']) echo "style='display:none;'"?> class="form-group pull-right">
                      <input type="submit" class="btn btn-primary" name='received' value="Received">
                      <input type="submit" class="btn btn-danger" name='decline' value="Decline">
                      </div>
                      <div <?php if($row['rcv_office']=='') echo "style='display:none;'"?> class="form-group row">
                        <label for="to_office" class="col-3 col-form-label">To Office:</label>
                        <div class="col-6">
                          <select name="to_office" class="form-control">
                          <?php 
                          $con=con();

                          $query = mysqli_query($con, "SELECT * FROM `sections`");

                          while($rows = mysqli_fetch_array($query)){
                            echo "<option value='$rows[1]'>$rows[1]</option>";
                          }
                          ?>
                          </select>
                        </div><input type="submit" class="btn btn-info" name='forward' value="Forward">
                      </div>

                    <?php
                      
                      
                    }
                  }
                  discon($con);

                  ?>
              </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website <?php echo date("Y"); ?></small>
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
