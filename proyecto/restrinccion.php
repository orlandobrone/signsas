<?php 
	session_start();
	//echo "idSession:".$_SESSION['id']; 
	if(!isset($_SESSION['id'])):	
	 header("location:../../index.php?err=2"); 
	 //echo "<br>no ahi session"; 
	endif;
?>