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

	if(empty($_POST['proyec']) || empty($_POST['nombre']) 

	   || empty($_POST['fecini']) || empty($_POST['fecfin']) || empty($_POST['descri']) || empty($_POST['ot_cliente']) 

	   ){

		echo "Usted no a llenado todos los campos";

		exit;

	}

	

	/*modificar el registro*/

	$fecini = explode("/", $_POST['fecini']);

	$fecini = date('Y-m-d', strtotime($fecini[2] . "-" . $fecini[1] . "-" . $fecini[0]));

	

	$fecfin = explode("/", $_POST['fecfin']);

	$fecfin = date('Y-m-d', strtotime($fecfin[2] . "-" . $fecfin[1] . "-" . $fecfin[0]));

	

	$campo = '';

	$estado = '';

	

	if($_POST['fecha_facturado'] != '0000-00-00'):

		$estado = 'FACTURADO';

	elseif($_POST['fecha_facturacion'] != '0000-00-00'):

		$estado = 'EN FACTURACION';

	elseif($_POST['fecha_liquidacion'] != '0000-00-00'):

		$estado = 'LIQUIDADO';

	elseif($_POST['fecha_informe'] != '0000-00-00'):

		$estado = 'INFORME ENVIADO';

	elseif($_POST['fecha_ejecutado'] != '0000-00-00'):

		$estado = 'EJECUTADO';

	elseif($_POST['fecha_inicio_ejecucion'] != '0000-00-00'):

		$estado = 'EN EJECUCION';
		
	elseif(!empty($_POST['estadofgr'])):
	
		$estado = $_POST['estadofgr']; 
		
	else:
		
		$estado = 'PENDIENTE';

	endif;

	

	$campo .= ' ,fecha_facturado = "'.$_POST['fecha_facturado'].'"'; 

	$campo .= ' ,fecha_facturacion = "'.$_POST['fecha_facturacion'].'"'; 

	$campo .= ' ,fecha_liquidacion = "'.$_POST['fecha_liquidacion'].'"'; 

	$campo .= ' ,fecha_informe = "'.$_POST['fecha_informe'].'"';

	$campo .= ' ,fecha_ejecutado = "'.$_POST['fecha_ejecutado'].'"';

	$campo .= ' ,fecha_inicio_ejecucion = "'.$_POST['fecha_inicio_ejecucion'].'"';

	
	$dias_hito = dias_transcurridos($_POST['fecini'],$_POST['fecfin']);
	
	if(empty($_POST['dias_para_facturar']))
		$dias_para_facturar = 'NULL';
	else
		$dias_para_facturar = $_POST['dias_para_facturar'];

	$sql = sprintf("UPDATE hitos SET id_proyecto=%s, nombre='%s', 

									 fecha_inicio='%s', fecha_final='%s', 

									 descripcion='%s', ot_cliente = '%s', id_sitios='%s',

									 estado='%s', 

									 po='%s', gr='%s' , factura='%s', 

									 po2='%s', gr2='%s' , factura2='%s', dias_hito = %s, valor_cotizado_hito = %s,
									 
									 dias_para_facturar = %s

									 ".$campo."

					WHERE id=%d;",

		fn_filtro($_POST['proyec']),

		fn_filtro($_POST['nombre']),

		fn_filtro($_POST['fecini']),

		fn_filtro($_POST['fecfin']),

		fn_filtro($_POST['descri']),

		fn_filtro($_POST['ot_cliente']),

		fn_filtro($_POST['sitios']),  

		fn_filtro($estado),  

		fn_filtro($_POST['po']),

		fn_filtro($_POST['gr']),

		fn_filtro($_POST['factura']),

		fn_filtro($_POST['po2']),

		fn_filtro($_POST['gr2']),

		fn_filtro($_POST['factura2']),
		
		fn_filtro($dias_hito),
		
		fn_filtro($_POST['valor_cotizado_hito']),
		
		fn_filtro($dias_para_facturar),

		fn_filtro((int)$_POST['id'])

	);

	if(!mysql_query($sql))

		echo "Error al actualizar el hito:\n$sql";

	exit;

?>