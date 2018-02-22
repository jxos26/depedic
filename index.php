<?php
include ("config.php");
//include ("security.php");
session_start();
//echo $_SESSION['user_type']."Hello";
//if($_SESSION['user_type']==1 && $_SESSION['user_type']==2){
  //header('Location: login.php?notPermitted=true');
    //}
?>
<?php
  $errorName = false;
  $successAdd = false;
  
  $con=con();
  if(isset($_POST["submit"])){
    $rcvfrom= $_POST['rcvfrom'];
    $doctitle= $_POST['doctitle'];
    $to_office= $_POST['to_office'];
    date_default_timezone_set('Asia/Hong_Kong');
    $date= date('Y-m-d H:i:s');
    $status = 'Pending';



    /*$sql="INSERT INTO `personal_info`(`lname`, `fname`, `mname`, `extname`, `dob`, `sex`, `marstat`, `postitle`, `sgrade`, `salary`, `emp_stat`, `edol`, `work`) VALUES ('$lname','$fname','$mname','$extname','$dob','$sex','$marstat','$postitle','$sgrade','$salary','$emp_stat','$edol','$work')";

                  if($con->query($sql) === TRUE){
                      $successAdd = true;
                  }else {
                      $errorName=true; 
                  }*/
    
    $res3=mysqli_query($con,"SELECT * FROM `documents` WHERE `rcv_from` LIKE '$rcvfrom' AND `doctitle` LIKE '$doctitle' AND `date_rcv` LIKE '$date';");
    
    
    if(mysqli_num_rows($res3) > 0){
      $errorName=true; 
    }
    if(mysqli_num_rows($res3) == 0){
      $ins = mysqli_query($con,"INSERT INTO `documents` VALUES (null, null, '$rcvfrom', '$doctitle', '$date', null, null, '$to_office', null, '$status');");
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
  <link href="css/sb-admin.css" rel="stylesheet">
   <!-- Favicons -->
  <link rel="icon" type="image/png" href="depedlogo.png">
</head>

<body class="bg-deped">
  <div class="container">
    <div class="row">
                      <div class="col-md-12">
                          <div class="slider-2-content text-center">
                              <h2 class="mdl-typography--display-2 mdl-typography--text-capitalize" style="color: #fff; margin-top: 40px; font-family: abel;">DEPED Iligan City Division</h2>
                              
                              <h4 class="mdl-typography--text-capitalize" style="color: #fff; font-family: abel;">Document Management System</h4>
                                
                          </div>
                      </div>
                  </div>
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
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Document Management System</div>
      <div class="card-body">
        <form id="addform" class="" action="" method="post" class="form-horizontal">
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
                <label for="to_office" class="col-3 col-form-label">Receiving Office:</label>
                <div class="col-9">
                  <select name="to_office" class="form-control">
                  <?php 
                  $con=con();

                  $query = mysqli_query($con, "SELECT * FROM `sections`");

                  while($rows = mysqli_fetch_array($query)){
                    echo "<option value='$rows[1]'>$rows[1]</option>";
                  }
                  ?>
                  </select>
                </div>
              </div>
              <button type="reset" class="btn btn-default">Clear</button>
              <input type="submit" class="btn btn-info pull-right" name='submit' value="Submit">
            </form>
      </div>
    </div>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © <?php echo date("Y"); ?> | Developed by: Ronillo T. Apas Jr.</small>
        </div>
      </div>
    </footer>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
