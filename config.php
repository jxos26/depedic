<?php 
	function con() 
	{
	    $link = mysqli_connect('localhost','root','','dmsdb') or die ('Unable to connect to Database..');
	    return $link;
	}
	  
	function discon($c) 
	{
		mysqli_close($c);
	}

?>
