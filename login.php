<?php
  
      include ("config.php");
      $logout=false;
      $errorLogin=false;
      $notPermitted=false;
      $inactive=false;
      $errorEmail=false;
      $errorPhone=false;
      $successReg = false;

      //logout code
        if (isset($_GET['logout'])) {
         session_start();         
         session_destroy();   
         $_SESSION = array();
         $logout=true;
        }

      //not permitted code
        if (isset($_GET['notPermitted'])) {
         session_start();         
         session_destroy();   
         $_SESSION = array();
         $notPermitted=true;
        }

      //idle code
        if (isset($_GET['inactive'])) {
         session_start();         
         session_destroy();   
         $_SESSION = array();
         $inactive=true;
        }

      //login code
      if (isset($_POST['login'])) {
        $uname=trim($_POST['username']);
        $pword=md5(trim($_POST['password']));
        
        $con = con();//connect to DB
        $res=mysqli_query($con,"SELECT * FROM user WHERE username = '$uname' AND password = '$pword';");
        //echo"SELECT * FROM user WHERE uname = '$uname' AND pword = '$pword';";
        if(mysqli_num_rows($res) > 0){
          $user = mysqli_fetch_array($res);
          session_start();
          $_SESSION['id'] = $user[0];
          $_SESSION['fname'] = $user[3];
          $_SESSION['lname'] = $user[5];
          $_SESSION['user_type'] =  $user[10];
          $_SESSION['position'] =  $user[6];
          $_SESSION['section'] = $user[7];
          $_SESSION['LAST_ACTIVITY'] = time();
          header("Location: documents.php");
          if($_SESSION['user_type']==2){
            header("Location: myDocu.php");
            }
          exit; 
        }
        else{
          $errorLogin=true;
        }
        discon($con);//disconnect to DB
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

<body class="bg-dark">
  <div class="container">
    <div class="row">
                      <div class="col-md-12">
                          <div class="slider-2-content text-center">
                              <center>
                    <div class="alert alert-danger" style="<?php if(!$errorLogin) echo "display:none";?>">
                      Username or Password is <strong>incorrect!</strong>
                    </div>
                    <div class="alert alert-danger" style="<?php if(!$errorEmail) echo "display:none";?>">
                      <strong>Registration failed!</strong> email is already used.
                    </div>
                    <div class="alert alert-danger" style="<?php if(!$errorPhone) echo "display:none";?>">
                      <strong>Registration failed!</strong> phone is already used.
                    </div>
                    <div class="alert alert-success" style="<?php if(!$logout) echo "display:none";?>">
                      You successfully <strong>logged out!</strong>
                    </div>
                    <div class="alert alert-success" style="<?php if(!$successReg) echo "display:none";?>">
                      You successfully <strong>Registered!</strong> Please login.
                    </div>
                    <div class="alert alert-danger" style="<?php if(!$inactive) echo "display:none";?>">
                      You have been logged out! You have been idle for over <strong>10 mins!</strong>
                    </div>
                    <div class="alert alert-info" style="<?php if(!$notPermitted) echo "display:none";?>">
                      <strong>Welcome to Deped Iligan!</strong>
                    </div>
                  </center>
                              <h2 class="mdl-typography--display-2 mdl-typography--text-capitalize" style="color: #fff; margin-top: 40px; font-family: abel;">DEPED Iligan City Division</h2>
                              
                              <h4 class="mdl-typography--text-capitalize" style="color: #fff; font-family: abel;">Document Management System</h4>
                              <h6 class="mdl-typography--text-capitalize" style="color: #fff; font-family: abel;">by Ronillo T. Apas, Jr.</h6>
                                
                          </div>
                      </div>
                  </div>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post" action="login.php">
          <div class="form-group">
            <label for="loginUsername">Username</label>
            <input class="form-control" name="username" id="loginUsername" type="text" aria-describedby="usernameHelp" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label for="loginPassword">Password</label>
            <input class="form-control" name="password" id="loginPassword" type="password" placeholder="Password">
          </div>
          <!--<div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>-->
          <button type="submit" class="btn btn-primary" name="login" id="login">Login</button>
        </form>
        <!--<div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>-->
      </div>
    </div>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website <?php echo date("Y"); ?></small>
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
