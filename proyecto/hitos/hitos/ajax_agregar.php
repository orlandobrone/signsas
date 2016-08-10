<?

	include "../../conexion.php";

	include "../extras/php/basico.php";
	
	function dias_transcurridos($fecha_i,$fecha_f)
	{
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);	
		$dias++; //Lógica de Iván	
		return $dias;
	}

	

	/*verificamos si las variables se envian*/

	if(empty($_POST['proyec']) || empty($_POST['nombre']) || empty($_POST['fecini']) || empty($_POST['fecfin']) || empty($_POST['descri']) || empty($_POST['ot_cliente'])){

		echo "Usted no a llenado todos los campos";

		exit;

	}
	
	$fecini = explode("/", $_POST['fecini']);

	$fecini = date('Y-m-d', strtotime($fecini[2] . "-" . $fecini[1] . "-" . $fecini[0]));

	

	$fecfin = explode("/", $_POST['fecfin']);

	$fecfin = date('Y-m-d', strtotime($fecfin[2] . "-" . $fecfin[1] . "-" . $fecfin[0]));
	
	$dias_hito = dias_transcurridos($_POST['fecini'],$_POST['fecfin']);
 

	$sql = sprintf("INSERT INTO `hitos` (id,

						id_proyecto,

						nombre,

						fecha_inicio,

						fecha_final,

						descripcion,

						id_sitios,

						fecha,

						fecha_real,

						estado,

						ot_cliente,

						po,

						gr,

						factura,

						po2,

						gr2,

						factura2,
						
						dias_hito,
						
						valor_cotizado_hito) 

					VALUES ('',

							'%s', 

							'%s', 

							'%s',

							'%s', 

							'%s', 

							'%s', 

							now(),

						 	now(),

							'PENDIENTE',

							'%s',

							'%s',

							'%s',

							'%s',

							'%s',

							'%s',

							'%s',
							
							%s,
							
							%s);",

		fn_filtro($_POST['proyec']),

		fn_filtro($_POST['nombre']),

		fn_filtro($_POST['fecini']),

		fn_filtro($_POST['fecfin']),

		fn_filtro($_POST['descri']),

		fn_filtro($_POST['sitios']),

		fn_filtro($_POST['ot_cliente']),

		fn_filtro($_POST['po']),

		fn_filtro($_POST['gr']),

		fn_filtro($_POST['factura']),

		fn_filtro($_POST['po2']),

		fn_filtro($_POST['gr2']),

		fn_filtro($_POST['factura2']),
		
		fn_filtro($dias_hito),
		
		fn_filtro($_POST['valor_cotizado_hito'])

	);



	if(!mysql_query($sql))

		echo "Error al insertar un nuevo hito:\n$sql";



	exit;

?>