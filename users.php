<?php
include ("config.php");
//include ("security.php");
session_start();
//echo $_SESSION['user_type']."Hello";
//if($_SESSION['user_type']!=1){
  //header('Location: login.php?notPermitted=true');
    //}
?>
<?php
  $successEdit = false;
  $errorAccnum = false;
  $errorEmail = false;
  $errorUsername = false;
  $successAdd = false;

  if(isset($_POST["edit"])){
    $con=con();
    $userid= $_POST["userid"];
    $fname = $_POST["fnameE"];
    $lname = $_POST["lnameE"];
    $position = $_POST["positionE"];
    $department = $_POST["departmentE"];
    $contact = $_POST["contactE"];
    $email = $_POST["emailE"];
    $type = $_POST["typeE"];
    $uname = $_POST["unameE"];
    $pword = md5(trim($_POST["pword"]));
    
    
    //$res6=mysqli_query($con,"SELECT * FROM user WHERE email = '$email' AND user_id != $userid;");
    $res5=mysqli_query($con,"SELECT * FROM user WHERE username = '$uname' AND user_id != $userid;");
    
    
    /*if(mysqli_num_rows($res6) > 0){
      $errorEmail=true; 
    }*/
    if(mysqli_num_rows($res5) > 0){
      $errorUsername=true; 
    }
    if(mysqli_num_rows($res5) == 0){
      
      $sql = "UPDATE user SET fname = '$fname', lname = '$lname', username = '$uname', position = '$position', department = '$department', contact = '$contact', email = '$email', type = $type WHERE user_id=$userid;";
      
      if($pword != "d41d8cd98f00b204e9800998ecf8427e"){
        $sql = "UPDATE user SET fname = '$fname', lname = '$lname', username = '$uname', password = '$pword', position = '$position', department = '$department', contact = '$contact', email = '$email', type = $type WHERE user_id=$userid;";
      }
      //echo"$sql";
      $res=mysqli_query($con, $sql);
      $successEdit = true;
    }
      
    discon($con);
  }

  if(isset($_POST["addU"])){
    $con=con();
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $initial = $_POST["initial"];
    $position = $_POST["position"];
    $department = $_POST["department"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $type = $_POST["type"];
    $uname = $_POST["uname"];
    $pword = md5(trim($_POST["pwordA"]));
    
    //$res3=mysqli_query($con,"SELECT * FROM user WHERE email = '$email';");
    $res2=mysqli_query($con,"SELECT * FROM user WHERE username = '$uname';");
    
    
    /*if(mysqli_num_rows($res3) > 0){
      $errorEmail=true; 
      
    }*/
    if(mysqli_num_rows($res2) > 0){
      $errorUsername=true; 
      
    }
    if(mysqli_num_rows($res2) == 0){
      
      $ins = mysqli_query($con,"INSERT INTO user VALUES (null, '$uname', '$pword', '$fname', '', '$lname', '$position', '$department', '$contact', '$email', $type);");
      //echo "INSERT INTO user VALUES (null, '$pword', '$fname', '', '$lname', '$position', '$department', '$contact', '$email', $type);";
      $successAdd = true;
    }
    discon($con);
  } 






?>
<?php
  $errorNameP = false;
  $successAddP = false;
  
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
    <a class="navbar-brand" href="index.php"><i class="fa fa-user"></i> <?php //echo $_SESSION["fname"]." ".$_SESSION["lname"];?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="mydocu.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Document Records</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#addModal">
            <i class="fa fa-fw fa-file"></i>
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

        <!-- Add Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add New Document</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="addform" id="addform" action="" method="post" class="form-horizontal" data-toggle="validator">
              <div class="modal-body">
              <div class="form-group">
                <input type="hidden" class="form-control" name="dmsid" id="dmsid" required>
              </div>
              <div class="form-group row">
                <label for="lname" class="col-3 col-form-label">Received from:</label>
                <div class="col-9">
                  <input type="text" class="form-control" name="rcvfrom" id="rcvfrom" placeholder="Received from" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="fname" class="col-3 col-form-label">Document Title:</label>
                <div class="col-9">
                  <input type="text" class="form-control" name="doctitle" id="doctitle" placeholder="Document Title" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="date_rcv" class="col-3 col-form-label">Date & Time Received: </label>
                <div class="col-9">
                  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="date_rcv" id="date_rcv" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="rcv_by" class="col-3 col-form-label">Received By:</label>
                <div class="col-9">
                  <input type="text" class="form-control" name="rcv_by" id="rcv_by" placeholder="Received By" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="rcv_office" class="col-3 col-form-label">Receiving Office:</label>
                <div class="col-9">
                  <input type="text" class="form-control" name="rcv_office" id="rcv_office" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-3 col-form-label">Document Status:</label>
                <div class="col-3">
                <select name="status" id="status" class="form-control">
                  <option value="pending">Pending</option>
                  <option value="release">To be Release</option>
                </select>
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

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="post" class="form-horizontal" data-toggle="validator">
            <fieldset id="editform">
              <div class="modal-body">
              <div class="form-group row">
                <input type="hidden" class="form-control" name="userid" id="userid" required>
              </div>
              <div class="form-group  row">
                <label class="control-label col-sm-4" for="fnameE">First Name:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="fnameE" id="fnameE" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-4" for="lnameE">Last Name:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="lnameE" id="lnameE" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-4" for="initialE">Middle Initial:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="initialE" id="initialE" required>
                </div>
              </div>


              <div class="form-group row">
                <label class="control-label col-sm-4" for="positionE">Position:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="positionE" id="positionE" required>
                </div>
               </div>
              <div class="form-group row">
                <label class="control-label col-sm-4" for="departmentE">Department:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="departmentE" id="departmentE" required>
                </div>
               </div>
              <div class="form-group row" style="display: none">
                <label class="control-label col-sm-4" for="contactE">Contact:</label>
                <div class="col-sm-7">
                  <input type="text"  value="default@noemail.com" class="form-control" name="contactE" id="contactE" required>
                </div>
               </div>
              <div class="form-group row" style="display: none">
                <label class="control-label col-sm-4" for="emailE">Email:</label>
                <div class="col-sm-7">
                  <input type="email" value="default@noemail.com" class="form-control" name="emailE" id="emailE" required>
                </div>
               </div>
              <div class="form-group row">
                <label class="control-label col-sm-4" for="typeE">Type:</label>
                <div class="col-sm-7">
                  <select name="typeE" id="typeE"  class="form-control">
                      <option value="1">Admin</option>
                      <option value="2">User</option>
                  </select>
                </div>
               </div>
              <div class="form-group row">
                <label class="control-label col-sm-4" for="unameE">Username:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="unameE" id="unameE" required>
                </div>
              </div>
               <div class="form-group row">
                 <label class="control-label col-sm-4" for="pword"><input id="chk" type="checkbox"> New Password:</label>
                <div class="col-sm-5">
                  <input style="display:none;" type="password" class="form-control" name="pword" id="pword" disabled data-minlength="6" data-error="Minimum of 6 characters">
                <div class="help-block with-errors"></div>
                </div>
               </div>
              <div class="form-group row" id="confirm" style="display: none;">
                <label class="control-label col-sm-4" for="pwordConfirm">Confirm New Password:</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" name="pwordConfirm" id="pwordConfirm" disabled placeholder="Confirm Password"  data-match="#pword" data-match-error="Password don't match">
                <div class="help-block with-errors"></div>
                </div>
               </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-success" name='edit' value="Edit">
              </div>
              </fieldset>
            </form>
          </div>
          </div>
        </div>
                
                
                
                
                
                
                <!-- Add User Modal -->
            <div class="modal fade" id="addModalU" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add User</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="addform" id="addform" action="" method="post" class="form-horizontal" data-toggle="validator">
                <fieldset >
                  <div class="modal-body">
                  <div class="form-group row">
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-3" for="fname">First Name:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="fname" id="fname" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-3" for="lname">Last Name:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="lname" id="lname" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-3" for="initial">M.I.:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="initial" id="initial" required>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label class="control-label col-3" for="position">Position:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="position" id="position" required>
                    </div>
                   </div>
                  <div class="form-group row">
                    <label class="control-label col-3" for="department">Department:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="department" id="department" required>
                    </div>
                   </div>
                  <div class="form-group row" style="display: none">
                    <label class="control-label col-3" for="contact">Contact:</label>
                    <div class="col-sm-7">
                      <input type="text" value="default" class="form-control" name="contact" id="contact" required>
                    </div>
                   </div>
                  <div class="form-group row" style="display: none">
                    <label class="control-label col-3" for="email">Email:</label>
                    <div class="col-sm-7">
                      <input type="email"  value="default@noemail.com" class="form-control" name="email" id="email" required>
                    </div>
                   </div>
                  <div class="form-group row">
                    <label class="control-label col-3" for="type">Type:</label>
                    <div class="col-sm-7">
                      <select name="type" id="type"  class="form-control">
                          <option value="1">Admin</option>
                          <option value="2">User</option>
                      </select>
                    </div>
                   </div>
                   
                  <div class="form-group row">
                    <label class="control-label col-3" for="uname">Username:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="uname" id="uname" required>
                    </div>
                  </div>
                   <div class="form-group row">
                     <label class="control-label col-3" for="pwordA"> Password:</label>
                    <div class="col-sm-7">
                      <input style="" type="password" class="form-control" name="pwordA" id="pwordA" data-minlength="6" data-error="Minimum of 6 characters">
                    <div class="help-block with-errors"></div>
                    </div>
                   </div>
                  <div class="form-group row" id="confirmA" style="">
                    <label class="control-label col-3" for="pwordConfirmA">Confirm Password:</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control" name="pwordConfirmA" id="pwordConfirmA" placeholder="Confirm Password"  data-match="#pwordA" data-match-error="Password don't match">
                    <div class="help-block with-errors"></div>
                    </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary" name='addU' value="Add">
                  </div>
                  </fieldset>
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
            <div class="alert alert-success" style="<?php if(!$successEdit) echo "display:none";?>">
              User <strong>sucessfully updated!</strong>
            </div>
            <div class="alert alert-success" style="<?php if(!$successAdd) echo "display:none";?>">
              New User <strong>sucessfully added!</strong>
            </div>
            <div class="alert alert-danger" style="<?php if(!$errorEmail) echo "display:none";?>">
              Email is already <strong>taken!</strong>
            </div>  
            <div class="alert alert-success" style="<?php if(!$successAddP) echo "display:none";?>">
              <strong>Successfully Added!</strong>
            </div>
            <div class="alert alert-danger" style="<?php if(!$errorNameP) echo "display:none";?>">
              <strong>Error Adding!</strong>
            </div>
          </center>
          </div>

            <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th style='display:none;'>User ID</th>
                                        <th style='display:none;'>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Middle Initial</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th style='display:none;'>Contact</th>
                                        <th style='display:none;'>Email</th>
                                        <th style='display:none;'>Type no</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                  $con=con();

                  $sql= "SELECT * FROM user;";
                  $res = mysqli_query($con,$sql);
                  //var_dump($res);
                  //$row = mysqli_fetch_array($res);
                  while ($row = mysqli_fetch_array($res)) {
                    echo "<tr>
                    <td style='display:none;'>$row[0]</td>
                    <td style='display:none;'>$row[1]</td>
                    <td>$row[3]</td>
                    <td>$row[5]</td>
                    <td>$row[4]</td>
                    <td>$row[6]</td>
                    <td>$row[7]</td>
                    <td style='display:none;'>$row[8]</td>
                    <td style='display:none;'>$row[9]</td>
                    <td style='display:none;'>$row[10]</td>
                    <td>";
                      if($row[10]==1){
                        echo "Admin";
                      }
                      else{
                        echo "User";
                      }

                      echo"</td>
                      <td><center><button class='btn btn-success' role='button' data-toggle='modal' data-target='#editModal'>Edit User</button></center></td>
                    </tr>";
                  }


                  discon($con);
                ?>
                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <!-- Button trigger modal -->

              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModalU">
                Add User
              </button>
                        </div>
                        <!-- /.panel-body -->
          
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Personnel Record System 2018</small>
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
      <script>
    
            $('#chk').click(function() { 
                    if ($(this).is(':checked')) {
                      $("#pword").prop('required', true);
                      $("#pwordConfirm").prop('required', true);
                      $("#pword").prop('disabled', false);
                      $("#pwordConfirm").prop('disabled', false);
                      $("#pword").css("display","");
                      $("#confirm").css("display","");
                      alert("You are about to change the password!");
                      //alert("");
                    } else {
                      $("#pword").prop('disabled', true);
                      $("#pwordConfirm").prop('disabled', true);
                      $("#pword").prop('required', false);
                      $("#pwordConfirm").prop('required', false);
                      $("#pword").css("display","none");
                      $("#confirm").css("display","none");
                    }
                  });
            
            
          $(document).ready(function() {
            var table = $('#dataTables-example').DataTable( {
              responsive: true,
              select: true,
              "order": [[ 0, "desc" ]]
            } );

            $('#dataTables-example tbody').on('click', 'tr', function () {
              var data = table.row( this ).data();
              $("#editform").prop('disabled', false);
              //alert( 'You clicked on '+data[0]+'\'s row' );
              document.getElementById("userid").value=data[0];
              document.getElementById("unameE").value=data[1];
              document.getElementById("fnameE").value=data[2];
              document.getElementById("lnameE").value=data[3];
              document.getElementById("initialE").value=data[4];
              document.getElementById("positionE").value=data[5];
              document.getElementById("departmentE").value=data[6];
              document.getElementById("contactE").value=data[7];
              document.getElementById("emailE").value=data[8];
              
              $('#typeE option')
                 .removeAttr('selected')
                 .filter('[value='+data[9]+']')
                   .attr('selected', true)
            } );
          } );
    </script>
  </div>
</body>

</html>