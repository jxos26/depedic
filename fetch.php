<?php

include ("config.php");
//include ("security.php");
session_start();
//fetch.php
//
        $con=con();
        $output = '';
        if(isset($_POST["query"]))
        {
         $search = mysqli_real_escape_string($con, $_POST["query"]);
         $query = "SELECT * FROM documents WHERE `docrefno` LIKE '%".$search."%'";

         $result = mysqli_query($con, $query);
         $rows = array();
        if(mysqli_num_rows($result) > 0)
        {
         $output .= '
          <div class="table-responsive">
           <table class="table table-striped table-bordered" id="dataTable">
            <tr>
             <th>Document Reference No.</th>
             <th>Document Title</th>
             <th>Date Received</th>
             <th>Date Released</th>
             <th>Status</th>
            </tr>
         ';
         while($row = mysqli_fetch_assoc($result))
         {
          /*$output .= '
           <tr>
            <td>'.$row["docrefno"].'</td>
            <td>'.$row["doctitle"].'</td>
            <td>'.$row["date_rcv"].'</td>
            <td>'.$row["date_rls"].'</td>
            <td>'.$row["status"].'</td>
           </tr>
          '; */
           $rows[] = $row; 

         }
         return json_encode($array);
        }
        else
        {
         echo 'Data Not Found';
        }
        }
        //else
        //{
         //$query = "
          //SELECT * FROM `documents` ORDER BY CustomerID
         //";
        //}
        

?>