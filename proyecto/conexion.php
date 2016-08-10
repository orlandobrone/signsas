<?
	$bd_host = "localhost";
	$bd_usuario = "signsas_project";
	$bd_password = "project123"; 
	$bd_base = "signsas_project";
	/*$bd_host = "localhost";
	$bd_usuario = "root";
	$bd_password = "";
	$bd_base = "cesprovi_project";*/
	$con = mysql_connect($bd_host, $bd_usuario, $bd_password) or die("Error en la conexi?n a MsSql");
	mysql_select_db($bd_base, $con);
?>