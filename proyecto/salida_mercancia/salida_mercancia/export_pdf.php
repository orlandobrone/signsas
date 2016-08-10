<?php

	header('Content-type: text/html; charset=iso-8859-1');

	if(empty($_GET['ide_per'])){

		echo "Por favor no altere el fuente";

		exit;

	}



	include "../extras/php/basico.php";

	include "../../conexion.php";	

	

	$sql = sprintf("select * from solicitud_despacho where id=%d",

		(int)$_GET['ide_per']

	);

	$per = mysql_query($sql);

	$num_rs_per = mysql_num_rows($per);

	if ($num_rs_per==0){

		echo "No existen solicitud con ese ID";

		exit;

	}  

	

	$rs_per = mysql_fetch_assoc($per);

	



$mensaje = '

<img src=http://proyecto.signsas.com/images/logo_sign.png  style="float:left;"/>

<h2 style="float:left; margin-left:20px;line-height: 43px;">&nbsp;FORMATO DE SOLICITUD SALIDA MERCANCIA</h2> 

<div style="clear:both"></div>

<br />

	<h1>Formato Solicitud de Despacho</h1>

<table>

        <tbody>

        	 <tr>

                <td style="font-weight:bold;">Fecha Solicitud:</td>

                <td>'.$rs_per['fecha_solicitud'].'</td>

          </tr>

          <tr>

                <td style="font-weight:bold;">Fecha Entrega:</td>

                <td>'.$rs_per['fecha_entrega'].'</td>

              

                <td style="font-weight:bold;">Prioridad:</td>

                <td>'.$rs_per['prioridad'].'</td>

            </tr> 

            

            <tr>

            	<td colspan="2"><h3>Responsable de la Solicitud</h3></td>

            </tr>';

			

			$sqlPry = "SELECT * FROM regional WHERE id =".$rs_per['id_regional']; 

			$qrPry = mysql_query($sqlPry);

			$rsPry = mysql_fetch_array($qrPry);

            

           $mensaje .= '<tr>

            	<td style="font-weight:bold;">Regional:</td>

                <td>'.$rsPry['region'].'</td>                 

            </tr>

            <tr>        

                <td style="font-weight:bold;">Nombre:</td>

                <td>'.$rs_per['nombre_responsable'].'</td>

                

                <td style="font-weight:bold;">Cedula:</td>

                <td>'.$rs_per['cedula_responsable'].'</td> 

           </tr>

		   <tr>

		   	<td></td>

		   </tr>

		   <tr>

		   	<td></td>

		   </tr>

		   <tr>

		   	<td></td>

		   </tr>

		   <tr>

		   	<td></td>

		   </tr>';

		   

		   $sqlPry = "SELECT * FROM centros_costos WHERE id =".$rs_per['id_centrocostos'];

           $qrPry = mysql_query($sqlPry);

           $rsPry = mysql_fetch_array($qrPry);

		          

           $mensaje .= '

		   <tr> 

                <td style="font-weight:bold;">Centro Costo:</td>

                <td>'.$rsPry['sigla'].' / '.$rsPry['nombre'].'</td>            

            	<td style="font-weight:bold;">Orden Trabajo:</td>

                <td>';

				

			$sqlPry = "SELECT * FROM orden_trabajo WHERE id_proyecto =".$rs_per['id_proyecto'];

			$qrPry = mysql_query($sqlPry);

			$rsPry = mysql_fetch_array($qrPry);

			

			

           $mensaje .= $rsPry['orden_trabajo'].'

                </td>

           </tr> 
		   <tr>

               <td style="font-weight:bold;">Hitos:</td>

               <td>';                    

			$sqlPry = "SELECT * FROM hitos WHERE id =".$rs_per['id_hito'];

			$qrPry = mysql_query($sqlPry);

			$rsPry = mysql_fetch_array($qrPry);

			

			$mensaje .= $rsPry['nombre'].'      

               </td> 

           </tr>

           <tr>

               <td style="font-weight:bold;">ID Hito:</td>

               <td>                  

			   '.$rs_per['id_hito'].'  

               </td> 

           </tr>

           

        </tbody>

    </table>  

	<br />

    <table>

            <tr>

              <td style="font-weight:bold;">Direcci&oacute;n de entrega</td>

              <td>'.$rs_per['direccion_entrega'].'</td>

              <td style="font-weight:bold;">Nombre de quien recibe</td>

              <td>'.$rs_per['nombre_recibe'].'</td>

            </tr>

            <tr>

              <td style="font-weight:bold;">Tel&eacute;fono / Celular</td>

              <td>'.$rs_per['celular'].'</td>

              <td style="font-weight:bold;">Descripci&oacute;n:</td>

              <td>'.$rs_per['descripcion'].'</td>

            </tr>   

   </table>';

   

   $sql = "SELECT * FROM materiales WHERE id_despacho =".(int)$_GET['ide_per'];

   $resultado = mysql_query($sql) or die(mysql_error());

   

   

   $mensaje .=  ' <h4>Lista Item</h4>   

			   <table style="width:100%;table-layout: fixed;word-wrap: break-word;">

						   <tr>

							 <td style="font-weight:bold;">C&oacute;digo</td>

							 <td style="font-weight:bold; text-align:center;">Material</td>

							 <td style="font-weight:bold;">Cantidad</td> 

							 <td style="font-weight:bold;">Costo</td>

							 <td style="font-weight:bold;">Observaci&oacute;n</td>

							 <td style="font-weight:bold;">Estado</td>
							 
							 <td style="font-weight:bold;">Existencia</td>
							 <td style="font-weight:bold;">C.Comprada</td>
							 <td style="font-weight:bold;">C.U</td>
							 <td style="font-weight:bold;">IVA</td>
							 <td style="font-weight:bold;">O.C</td>
							 <td style="font-weight:bold;">C.Entregada</td>

						   </tr>';

		   			 $total = mysql_num_rows($resultado);

					 if($total > 0):

						   while($row = mysql_fetch_assoc($resultado)):

						    $sql2 = "SELECT nombre_material, cantidad, codigo FROM inventario WHERE id = ".$row['id_material'];
							$pai2 = mysql_query($sql2); 
							$rs_pai2 = mysql_fetch_assoc($pai2);
							
							$sql3 = "SELECT * FROM TEMP_MERCANCIAS WHERE id_item = ".$row['id'];
							$pai3 = mysql_query($sql3); 
							$rs_pai3 = mysql_fetch_assoc($pai3);
							

						   	switch($row['aprobado']):
									case 0:
									case 3:
										$aprobar = "No Aprobado";
									break;
									case 1:
										$aprobar = "Aprobado";
									break;				
						   	endswitch;


						   	$mensaje .= '<tr>

										  <td>'.$rs_pai2['codigo'].'</td>

										  <td width="105">'.utf8_encode($rs_pai2['nombre_material']).'</td> 

										  <td align="center">'.utf8_encode($row['cantidad']).'</td>

										  <td>$'.$row['costo'].'</td>    

										  <td>'.utf8_encode($row['observacion']).'</td>  

										  <td width="60">'.$aprobar.'</td>  
										  
										  <td align="center">'.(int)$rs_pai2['cantidad'].'</td>  
										  <td align="center">'.$rs_pai3['cantidadc'].'</td>  
										  <td align="center">'.$rs_pai3['costo2'].'</td>  
										  <td align="center">'.$rs_pai3['iva2'].'</td>  
										  <td align="center">'.$rs_pai3['orden_compra2'].'</td>  
										  <td align="center">'.$rs_pai3['cantidade'].'</td>  
									
									   </tr> ';
          
           		 	endwhile; endif;

             

    $mensaje .= '</table>';

	

	

	//echo $mensaje;

	

	require_once('/home/signsas/public_html/proyecto/anticipos/anticipo/html2pdf.class.php');

	try

    {

		

        $html2pdf = new HTML2PDF('P', 'A4', 'es');

//      $html2pdf->setModeDebug();

        $html2pdf->setDefaultFont('Arial');

        $html2pdf->WriteHTML($mensaje);

        $html2pdf->Output('Anticipo_ID_'.(int)$_GET['ide_per'].'.pdf');

		exit;

		

    }

    catch(HTML2PDF_exception $e) {

		echo $e;

        exit;

    }

	

?>



