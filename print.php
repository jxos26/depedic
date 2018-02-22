<?php
include ("config.php");
//include ("security.php");
session_start();
//echo $_SESSION['user_type']."Hello";
//if($_SESSION['user_type']==1 && $_SESSION['user_type']==2){
  //header('Location: login.php?notPermitted=true');
    //}
?>
<!DOCTYPE html>
<html>
  <head>
    <style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    </style>
  </head>
  <body onload="window.print()">
    <div class="page">
      <div class="subpage">
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
                        <label for="rcv_office" class="col-3 col-form-label">Received by:</label>
                        <div class="col-9">
                          <input type="text" class="form-control" name="rcv_by" id="rcv_by" value="<?php echo $row['rcv_by'];?>" disabled>
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
                      <div <?php if($row['rcv_by']!='') echo "style='display:none;'"?> class="form-group pull-right">
                      <input type="submit" class="btn btn-primary" name='received' value="Received">
                      <input type="submit" class="btn btn-danger" name='decline' value="Decline">
                      </div>
                      
                    </form>

                    <?php
                      
                      
                    }
                  }
                  discon($con);

                  ?>
                </div>
              </div>
              <div class="page">
                <div class="subpage">
                  
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
                        <label for="rcv_office" class="col-3 col-form-label">Received by:</label>
                        <div class="col-9">
                          <input type="text" class="form-control" name="rcv_by" id="rcv_by" value="<?php echo $row['rcv_by'];?>" disabled>
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
                      <div <?php if($row['rcv_by']!='') echo "style='display:none;'"?> class="form-group pull-right">
                      <input type="submit" class="btn btn-primary" name='received' value="Received">
                      <input type="submit" class="btn btn-danger" name='decline' value="Decline">
                      </div>
                      
                    </form>

                    <?php
                      
                      
                    }
                  }
                  discon($con);

                  ?>
                  <img src="images/Routingslip.jpg" height="330" width="255">
                </div>
              </div>
  </body>
</html>