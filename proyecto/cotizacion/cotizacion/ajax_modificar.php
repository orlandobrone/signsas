<?
	include "../../conexion.php";
	include "../extras/php/basico.php";
	
	/*verificamos si las variables se envian*/
	if(empty($_POST['nombre']) || empty($_POST['descri'])){
		echo "Usted no a llenado todos los campos";
		exit;
	}
	

	/*modificar el registro*/

	$sql = sprintf("UPDATE cotizacion SET nombre='%s',
										descripcion='%s',
										transportes='%s',
										alquileres_vehiculos='%s',
										imprevistos='%s',
										ica='%s',
										coste_financiero='%s',
										acarreos='%s',
										arrendamientos='%s',
										reparaciones='%s',
										profesionales='%s',
										seguros='%s',
										comunicaciones_celular='%s',
										aseo_vigilancia='%s',
										asistencia_tecnica='%s',
										envios_correos='%s',
										otros_servicios='%s',
										combustible='%s',
										lavado_vehiculo='%s',
										gastos_viaje='%s',
										tiquetes_aereos='%s',
										aseo_cafeteria='%s',
										papeleria='%s',
										internet='%s',
										taxis_buses='%s',
										parqueaderos='%s',
										caja_menor='%s',
										peajes='%s',
										polizas='%s',
										transportes2='%s',
										alquileres_vehiculos2='%s',
										imprevistos2='%s',
										ica2='%s',
										coste_financiero2='%s',
										acarreos2='%s',
										arrendamientos2='%s',
										reparaciones2='%s',
										profesionales2='%s',
										seguros2='%s',
										comunicaciones_celular2='%s',
										aseo_vigilancia2='%s',
										asistencia_tecnica2='%s',
										envios_correos2='%s',
										otros_servicios2='%s',
										combustible2='%s',
										lavado_vehiculo2='%s',
										gastos_viaje2='%s',
										tiquetes_aereos2='%s',
										aseo_cafeteria2='%s',
										papeleria2='%s',
										internet2='%s',
										taxis_buses2='%s',
										parqueaderos2='%s',
										caja_menor2='%s',
										peajes2='%s',
										polizas2='%s',
										materiales='%s',
										`MOD`='%s',
										MOI='%s',
										TOES='%s',
										materiales2='%s',
										MOD2='%s',
										MOI2='%s',
										TOES2='%s',
										ganancia_adicional='%s' where id=%d;",
		fn_filtro($_POST['nombre']),
		fn_filtro($_POST['descri']),
		fn_filtro($_POST['transp']),
		fn_filtro($_POST['alqveh']),
		fn_filtro($_POST['imprev']),
		fn_filtro($_POST['ica']),
		fn_filtro($_POST['cosfin']),
		fn_filtro($_POST['acarre']),
		fn_filtro($_POST['arrend']),
		fn_filtro($_POST['repara']),
		fn_filtro($_POST['profes']),
		fn_filtro($_POST['seguro']),
		fn_filtro($_POST['comcel']),
		fn_filtro($_POST['asevig']),
		fn_filtro($_POST['asitec']),
		fn_filtro($_POST['envcor']),
		fn_filtro($_POST['otrser']),
		fn_filtro($_POST['combus']),
		fn_filtro($_POST['lavveh']),
		fn_filtro($_POST['gasvia']),
		fn_filtro($_POST['tiqaer']),
		fn_filtro($_POST['asecaf']),
		fn_filtro($_POST['papele']),
		fn_filtro($_POST['intern']),
		fn_filtro($_POST['taxbus']),
		fn_filtro($_POST['parque']),
		fn_filtro($_POST['cajmen']),
		fn_filtro($_POST['peajes']),
		fn_filtro($_POST['poliza']),
		fn_filtro($_POST['transp2']),
		fn_filtro($_POST['alqveh2']),
		fn_filtro($_POST['imprev2']),
		fn_filtro($_POST['ica2']),
		fn_filtro($_POST['cosfin2']),
		fn_filtro($_POST['acarre2']),
		fn_filtro($_POST['arrend2']),
		fn_filtro($_POST['repara2']),
		fn_filtro($_POST['profes2']),
		fn_filtro($_POST['seguro2']),
		fn_filtro($_POST['comcel2']),
		fn_filtro($_POST['asevig2']),
		fn_filtro($_POST['asitec2']),
		fn_filtro($_POST['envcor2']),
		fn_filtro($_POST['otrser2']),
		fn_filtro($_POST['combus2']),
		fn_filtro($_POST['lavveh2']),
		fn_filtro($_POST['gasvia2']),
		fn_filtro($_POST['tiqaer2']),
		fn_filtro($_POST['asecaf2']),
		fn_filtro($_POST['papele2']),
		fn_filtro($_POST['intern2']),
		fn_filtro($_POST['taxbus2']),
		fn_filtro($_POST['parque2']),
		fn_filtro($_POST['cajmen2']),
		fn_filtro($_POST['peajes2']),
		fn_filtro($_POST['poliza2']),
		fn_filtro($_POST['materiales']),
		fn_filtro($_POST['MOD']),
		fn_filtro($_POST['MOI']),
		fn_filtro($_POST['TOES']),
		fn_filtro($_POST['materiales2']),
		fn_filtro($_POST['MOD2']),
		fn_filtro($_POST['MOI2']), 
		fn_filtro($_POST['TOES2']),
		fn_filtro($_POST['ganancia_adicional']),
		fn_filtro((int)$_POST['id'])
	);
	if(!mysql_query($sql))
		echo "Error al actualizar la cotización:\n$sql";
	exit;
?>