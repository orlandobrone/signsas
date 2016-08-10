<?
	include "../../conexion.php";
	include "../extras/php/basico.php";
	
	if(!empty($_POST['idMaterial'])):	
	
	$sql = sprintf("DELETE FROM materiales WHERE id=%d",(int)$_POST['idMaterial']);
	if(!mysql_query($sql))
		echo "Ocurrio un error\n$sql";
		
	endif;

?>