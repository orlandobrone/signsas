<?

	include "../../conexion.php";

	include "../extras/php/basico.php";

	

	/*verificamos si las variables se envian*/

	if(empty($_POST['hitos']) || empty($_POST['tecnicos']) || empty($_POST['fecini']) || empty($_POST['fecfin'])){

		echo "Usted no a llenado todos los campos";

		exit;

	}

	

	/*modificar el registro*/

	

	$vehiculo = ($_POST['vehiculos']!='')? $_POST['vehiculos']:'';

	

	

	if($_POST['hora_inicio'] != '00:00:00' && $_POST['hora_final'] != '00:00:00'):

	

		$sql = sprintf("UPDATE `asignacion` SET 

					id_hito='%s', 

					id_tecnico='%s', 

					id_vehiculo='%s',

					id_ordentrabajo='%s', 

					observacion='%s',

					fecha_ini='%s', 

					fecha_fin='%s',

					hora_inicio='%s',

					hora_final='%s' 

				   WHERE id=%d;",

		fn_filtro($_POST['hitos']),

		fn_filtro($_POST['tecnicos']),

		fn_filtro($vehiculo),

		fn_filtro($_POST['id_ordentrabajo']),

		fn_filtro($_POST['observacion']),

		fn_filtro($_POST['fecini']),

		fn_filtro($_POST['fecfin']),

		fn_filtro($_POST['hora_inicio']),

		fn_filtro($_POST['hora_final']),

		fn_filtro((int)$_POST['id'])

	);

	else:

	

			$sql = sprintf("UPDATE `asignacion` SET 

					id_hito='%s', 

					id_tecnico='%s', 

					id_vehiculo='%s', 

					id_ordentrabajo='%s',

					observacion='%s',

					fecha_ini='%s', 

					fecha_fin='%s'

				   WHERE id=%d;",

		fn_filtro($_POST['hitos']),

		fn_filtro($_POST['tecnicos']),

		fn_filtro($vehiculo),

		fn_filtro($_POST['id_ordentrabajo']),

		fn_filtro($_POST['observacion']),

		fn_filtro($_POST['fecini']),

		fn_filtro($_POST['fecfin']),

		fn_filtro((int)$_POST['id'])

	);

	endif;



	

	if(!mysql_query($sql))

		echo "Error al actualizar la asignacion:\n$sql";

	exit;

?>