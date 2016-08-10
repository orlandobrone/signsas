<?php

	header("Pragma: public");

	header("Expires: 0");

	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

	header("Content-Type: application/force-download");

	header("Content-Type: application/octet-stream");

	header("Content-Type: application/download");

	header("Content-Disposition: attachment;filename=Hitos_export_".date('d-m-Y').".xls");

	header("Content-Transfer-Encoding: binary ");	

	include "../../conexion.php";
	include "../extras/php/basico.php";	

	$query = "SELECT * FROM hitos ORDER BY id DESC";			  

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
	

?>

	<table rules="all" border="1">

    	<tr bgcolor="#CCCCCC">

        	<td align="center"><strong>ID</strong></td>

            <td align="center"><strong>Proyecto</strong></td>

            <td align="center"><strong>Nombre Hito</strong></td>

            <td align="center"><strong>Estado</strong></td>

            <td align="center"><strong>Descripci&oacute;n</strong></td>

            <td align="center"><strong>OT Cliente</strong></td>
            
            <td align="center"><strong>Cliente</strong></td>

            <td align="center"><strong>PO</strong></td>

            <td align="center"><strong>GR</strong></td>
            
            <td align="center"><strong>#Factura 1</strong></td>
            
            <td align="center"><strong>Valor Facturado</strong></td>
            
            <td align="center"><strong>PO2</strong></td>

            <td align="center"><strong>GR2</strong></td>
            
            <td align="center"><strong>#Factura 2</strong></td>
            
            <td align="center"><strong>Valor Facturado 2</strong></td>

            <td align="center"><strong>Fecha Inicio</strong></td>

            <td align="center"><strong>Fecha Final</strong></td>

            <td align="center"><strong>Fecha Inicio Ejecuci&oacute;n</strong></td>

            <td align="center"><strong>Fecha Ejecuci&oacute;n</strong></td>

            <td align="center"><strong>Fecha Informe</strong></td>

            <td align="center"><strong>Fecha Liquidaci&oacute;n</strong></td>

            <td align="center"><strong>Fecha Facturaci&oacute;n</strong></td>

            <td align="center"><strong>Fecha Facturado</strong></td>
            
            <td align="center"><strong>Valor Cotizado</strong></td>

        </tr>

	

<?php	



	$letters = array('-');

	$fruit   = array('/');	

	

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)):	

		$sqlfgr = "select estado from hitos where id = ".$row['id'];

		$paifgr = mysql_query($sqlfgr); 

		$rs_paifgr = mysql_fetch_assoc($paifgr);
		
		if($rs_paifgr['estado'] != 'ELIMINADO') {

			$sql2 = "select p.nombre AS nombre, (SELECT c.nombre FROM cliente AS c where c.id = p.id_cliente) AS nomcliente from proyectos p where p.id = ".$row['id_proyecto'];
	
			$pai2 = mysql_query($sql2); 
	
			$rs_pai2 = mysql_fetch_assoc($pai2);

		

?>

                <tr>

                    <td bgcolor="#CCCCCC"><?=$row['id']?></td>

                    <td><?=$rs_pai2['nombre']?></td>

                    <td><?=$row['nombre']?></td>

                    <td><?=$row['estado']?></td>

                    <td><?=$row['descripcion']?></td>

                    <td><?=$row['ot_cliente']?></td>
                    
                    <td><?=$rs_pai2['nomcliente']?></td>

                    <td><?=$row['po']?></td>

                    <td><?=$row['gr']?></td>
                    
                    <td><?=$row['factura']?></td>
                    
                    <td>$<?=$row['valor_facturado']?></td>
                    
                    <td><?=$row['po2']?></td>

                    <td><?=$row['gr2']?></td>
                    
                    <td><?=$row['factura2']?></td> 
                    
                    <td>$<?=$row['valor_facturado2']?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_inicio'])?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_final'])?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_inicio_ejecucion'])?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_ejecutado'])?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_informe'])?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_liquidacion'])?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_facturacion'])?></td>

                    <td><?=str_replace($letters, $fruit,$row['fecha_facturado'])?></td>
                    
                    <td><?=$row['valor_cotizado_hito']?></td> 

                </tr>

<?		
		}
	endwhile;

?>

	</table>

    