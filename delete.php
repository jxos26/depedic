<?php
include ("config.php");
if(isset($_GET['emp_id']))
{
	$con=con();
	$emp_id=$_GET['emp_id'];
	$query1=mysqli_query($con, "DELETE FROM `personal_info` WHERE `emp_id`='$emp_id'");
		
		if($query1)
		{
			header('location:index.php');
		}
		else{
			echo "ERROR: could not prepare SQL statement.";
		}
		discon($con);
}
?>