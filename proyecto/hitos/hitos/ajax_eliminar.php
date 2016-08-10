<?

	include "../../conexion.php";

	include "../extras/php/basico.php";

	$sql = sprintf("insert into hitos_eliminados select * from hitos where id = %d",

		(int)$_POST['id']

	);

	if(!mysql_query($sql)){

		echo "Ocurrio un error\n$sql";
		exit;
	}
	
	$sql = sprintf("delete from hitos where id=%d",

		(int)$_POST['id']

	);

	if(!mysql_query($sql))

		echo "Ocurrio un error\n$sql";

	exit;

?>

