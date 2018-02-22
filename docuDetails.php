<?php
include ("config.php");
//include ("security.php");
session_start();
//echo $_SESSION['user_type']."Hello";
if($_SESSION['user_type']!=2){
  header('Location: login.php?notPermitted=true');
    }

    $approved=false;
    $disapproved=false;
    $pending=false;
    $delivered=false;
    $deliveryFail=false;

    $con=con();
    if(isset($_POST['approve'])){
      $sql = "UPDATE request SET status = 'Approved' WHERE request_id=$rid;";
      //echo $sql;
      $res=mysqli_query($con, $sql);
      $stat="Approved";
      $approved=true;
    }
    if(isset($_POST['disapprove'])){
      $sql = "UPDATE request SET status = 'Disapproved' WHERE request_id=$rid;";
      //echo $sql;
      $res=mysqli_query($con, $sql);
      var_dump($res);
      $stat="Disapproved";
      $disapproved=true;
    }
    if(isset($_POST['delivered'])){
      $today=date("Y-m-d H:i:s");
      $sql = "UPDATE request SET status = 'Release', delivered_date = '$today' WHERE request_id=$rid;";
      //echo $sql;
      if(checkInventory($rid)){
        subtractInventory($rid);
        $res=mysqli_query($con, $sql);
        $stat="Release";
        $delivered=true;
        }
      else{
        $deliveryFail = true;
        }
    }

    if(isset($_POST['pending'])){
      $sql = "UPDATE request SET status = 'Pending' WHERE request_id=$rid;";
      //echo $sql;
      $res=mysqli_query($con, $sql);
      $stat="Pending";
      $pending=true;
    }



    $sql= "SELECT * FROM `documents` as d INNER JOIN `sections` as s ON d.rcv_office = s.section_name;";
    discon($con);

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
    <a class="navbar-brand" href="profile.php"><i class="fa fa-user"></i> <?php echo $_SESSION["fname"]." ".$_SESSION["lname"];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Personnel Records">
          <a class="nav-link" href="documents.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Document Records</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add New Record">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#addModal">
            <i class="fa fa-fw fa-plus-square-o"></i>
            <span class="nav-link-text">Add New Document</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
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
          <i class="fa fa-table"></i> Document Records</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm" id="dataTable" width="100%">
              <thead>
                <tr>
                  <th style='display:none;'>DMS ID</th>
                  <th style='display:none;'>Document Reference No.</th>
                  <th class="w-25">Date</th>
                  <th>Received from</th>
                  <th>Document Title</th>
                  <th style='display:none;'>Received By</th>
                  <th>Receiving Office</th>
                  <th style='display:none;'>Date and Time Released</th>
                  <th>Document Status</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th style='display:none;'>DMS ID</th>
                  <th style='display:none;'>Document Reference No.</th>
                  <th class="w-25">Date and Time Received</th>
                  <th>Received from</th>
                  <th>Document Title</th>
                  <th style='display:none;'>Received By</th>
                  <th>Receiving Office</th>
                  <th style='display:none;'>Date and Time Released</th>
                  <th>Document Status</th>
                  <th width="10%">Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $con=con();
                  $section = $_SESSION['section'];
                  $sql= "SELECT * FROM `documents` WHERE `rcv_office` = '$section'";
                  $res = mysqli_query($con,$sql);
                  //var_dump($res);
                  //$row = mysqli_fetch_array($res);
                  while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>
                    <td style='display:none;'>$row[0]</td>
                    <td style='display:none;'>$row[1]</td>
                    <td>$row[4]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                    <td style='display:none;'>$row[5]</td>
                    <td>$row[6]</td>
                    <td style='display:none;'>$row[7]</td>
                    <td>$row[8]</td>
                    <td><a href='view.php?dms_id=".$row[0]."' data-toggle='tooltip' data-placement='left' title='View Record'><i class='fa fa-fw fa-eye'></i></a>
                    <a href='update.php?dms_id=".$row[0]."' data-toggle='tooltip' data-placement='left' title='Edit Record'><i class='fa fa-fw fa-pencil-square-o'></i></a>
                    <a href='delete.php?dms_id=".$row[0]."' data-toggle='tooltip' data-placement='right' title='Delete Record' onClick=\"return confirm('Are you sure you want to delete?');\"><i class='fa fa-fw fa fa-trash-o'></i></a>
                    </td>
                    </tr>";
                  }


                  discon($con);
                ?>
              </tbody>
            </table>
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
