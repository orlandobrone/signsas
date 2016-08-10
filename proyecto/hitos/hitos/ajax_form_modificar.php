<?  header('Content-type: text/html; charset=iso-8859-1');
	session_start();	
	if(empty($_POST['ide_per'])){
		echo "Por favor no altere el fuente";
		exit;
	}
	include "../extras/php/basico.php";
	include "../../conexion.php";
	$sql = sprintf("select * from hitos where id=%d",
		(int)$_POST['ide_per']
	);
	$per = mysql_query($sql);
	$num_rs_per = mysql_num_rows($per);
	if ($num_rs_per==0){
		echo "No existen hitos con ese ID";
		exit;
	}
	
	$rs_per = mysql_fetch_assoc($per);
	$sql_estados = sprintf("SELECT DISTINCT estado FROM hitos");
	$result = mysql_query($sql_estados);
	if($rs_per['editable']=='0'){
		echo '<p>Este hito no se puede editar</p>';	
		echo '<input name="cancelar" style="margin-bottom:25px;" type="button" id="cancelar" value="Cerrar" onclick="fn_cerrar();" class="btn_table"/>';
	}
	
	else {
	
?>
<!--Hoja de estilos del calendario -->
<link rel="stylesheet" type="text/css" media="all" href="../../calendario/calendar-blue.css" title="win2k-cold-1">
<!-- librería principal del calendario -->
<script type="text/javascript" src="../../calendario/calendar.js"></script>
<!-- librería para cargar el lenguaje deseado -->
<script type="text/javascript" src="../../calendario/calendar-es.js"></script>
<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->
<script type="text/javascript" src="../../calendario/calendar-setup.js"></script>
<h1>Modificando Hito</h1>
<p>Por favor rellene el siguiente formulario</p>
<form action="javascript: fn_modificar();" method="post" id="frm_per">
	<input type="hidden" id="id" name="id" value="<?=$rs_per['id']?>" />
    <table class="formulario">
        <tbody>
        	<?php //FGR
			$sqlfgr = "select count(1) as cuenta from opciones_perfiles where id_perfil = ".$_SESSION['perfil']." and opcion = 27";
			$paifgr = mysql_query($sqlfgr);
			$conteofgr=mysql_fetch_assoc($paifgr);
			
			if($conteofgr['cuenta']){ 
            
            	$sololectura = '';
                $displaynone = '';
			}
			
			else{
            
            	$sololectura = 'readonly="readonly"';
                $displaynone = 'style="display:none;"';
			} ?>
        	
        	<tr>
                <td>Proyecto <?=$_SESSION['perfil'] ?></td>
                <td>
                	<?php if($conteofgr['cuenta']){  ?>
                	<select name="proyec" ide="proyec" class="required">
                    	<option value=""></option>
						<?
                            $sql = "select * from proyectos order by nombre asc";
                            $pai = mysql_query($sql);
                            while($rs_pai = mysql_fetch_assoc($pai)){
                        ?>
                            <option value="<?=$rs_pai['id']?>" <? if($rs_pai['id']==$rs_per['id_proyecto']) echo "selected='selected'";?>><?=$rs_pai['nombre']?></option>
                        <? } ?>
					</select>
                    <?php } 
					else {
						$sql = "select nombre from proyectos where id=".$rs_per['id_proyecto'];
                        $pai = mysql_query($sql);
                        $rs_pai = mysql_fetch_assoc($pai);?>
                        <input name="proyec_fgr" type="text" id="proyec_fgr" size="40" value="<?=$rs_pai['nombre']?>" readonly="readonly" />
                        <input name="proyec" id="proyec" type="hidden" value="<?=$rs_per['id_proyecto']?>"  />
						
					<?php }?>
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input name="nombre" type="text" id="nombre" size="40" class="requisssred" value="<?=$rs_per['nombre']?>" <?=$sololectura?>/></td>
            </tr>
            <tr>
            	  <td>Sitios:</td>
                  <td colspan="3">
                  	  <?php if($conteofgr['cuenta']){  ?>
						  <? $sqlPry = "SELECT * FROM sitios"; 
                          $qrPry = mysql_query($sqlPry);
                          ?>
                          <select name="sitios" id="sitios" class="chosen-select required" <?=$sololectura?>>
                              <? while ($rsPry = mysql_fetch_array($qrPry)) { ?>
                              <option value="<?=$rsPry['id']?>" <?php echo ($rsPry['id']==$rs_per['id_sitios'])? 'selected="selected"': '';?>><?=$rsPry['nombre_rb']?></option>
                              <? } ?>
                          </select>   
                      <?php } 
						else {
							$sql = "select nombre_rb from sitios where id=".$rs_per['id_sitios'];
							$pai = mysql_query($sql);
							$rs_pai = mysql_fetch_assoc($pai);?>
							<input name="sitios_fgr" type="text" id="sitios_fgr" size="40" value="<?=$rs_pai['nombre_rb']?>" readonly="readonly" />
                            <input name="sitios" id="sitios" type="hidden" value="<?=$rs_per['id_sitios']?>"  />
							
						<?php }?>         
                  </td>            
             </tr>
             
             <tr>
            	 <td>Estado Actual:</td>
                 <td colspan="3"><?=$rs_per['estado'];?></td>
             </tr>
            
             <tr>
            	  <td>Creaci&oacute;n:</td>
                  <td colspan="3"><?=$rs_per['fecha_real'];?></td>
             </tr>         
            
            <tr>
                <td>Fecha de Inicio</td>
                <td><input name="fecini" type="text" id="fecini" size="40" class="required" value="<?=$rs_per['fecha_inicio']?>" readonly="readonly" />
                <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador" <?=$displaynone?>/>
				<script type="text/javascript">
					Calendar.setup({
						inputField     :    "fecini",      // id del campo de texto
						ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
						button         :    "lanzador"   // el id del botón que lanzará el calendario
					});
				</script></td>
            </tr>
            <? 
			$fecha_final = explode("-", $rs_per['fecha_final']);
			$fecha_final = $fecha_final[2] . "/" . $fecha_final[1] . "/" . $fecha_final[0];
			?>
            <tr>
                <td>Fecha de Finalizaci&oacute;n</td>
                <td><input name="fecfin" type="text" id="fecfin" size="40" class="required" value="<?=$rs_per['fecha_final']?>" readonly="readonly" />
                <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador2" <?=$displaynone?>/>
				<script type="text/javascript">
					Calendar.setup({
						inputField     :    "fecfin",      // id del campo de texto
						ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
						button         :    "lanzador2"   // el id del botón que lanzará el calendario
					});
				</script></td>
            </tr>
            
            
            <tr>
                <td>Descripci&oacute;n</td>
                <td><input name="descri" type="text" id="descri" size="40" class="required" value="<?=$rs_per['descripcion']?>" <?=$sololectura?> /></td>
            </tr>
            
            <tr>
                <td>OT Cliente</td>
                <td><input name="ot_cliente" type="text" id="ot_cliente" size="40" class="required" value="<?=$rs_per['ot_cliente']?>" <?=$sololectura?>/></td>
            </tr>
            <tr>
                <td>Valor Cotizado Hito</td>
                <td><input name="valor_cotizado_hito" type="text" id="valor_cotizado_hito" size="40" class="required" value="<?=$rs_per['valor_cotizado_hito']?>" <?=$sololectura?>/></td>
            </tr>
            
            <tr>
                <td>D&iacute;as para Facturar</td>
                <td><input name="dias_para_facturar" type="text" id="dias_para_facturar" size="40" value="<?=$rs_per['dias_para_facturar']?>" <?=$sololectura?>/></td>
            </tr>
            
            <?php //FGR
			$sqlfgr = "select count(1) as cuenta from opciones_perfiles where id_perfil = ".$_SESSION['perfil']." and opcion = 25";
			$paifgr = mysql_query($sqlfgr);
			$conteofgr=mysql_fetch_assoc($paifgr);
			
			if($conteofgr['cuenta']){ 
            
            	$estilo = '';
                
			}
			
			else{
            
            	$estilo = 'style = "display:none;"';
                
			} ?>
            
            <tr <?=$estilo?>>
                <td>PO</td>
                <td><input name="po" type="text" id="po" size="40"  value="<?=$rs_per['po']?>" /></td>
                <td>PO2</td>
                <td><input name="po2" type="text" id="po2" size="40"  value="<?=$rs_per['po2']?>" /></td>
            </tr>
            <tr <?=$estilo?>>
                <td>GR</td>
                <td><input name="gr" type="text" id="gr" size="40" value="<?=$rs_per['gr']?>" /></td>
                <td>GR2</td>
                <td><input name="gr2" type="text" id="gr2" size="40" value="<?=$rs_per['gr2']?>" /></td>
            </tr>
            <tr <?=$estilo?>>
                <td>#Factura</td>
                <td><input name="factura" type="text" id="factura" size="40" value="<?=$rs_per['factura']?>" /></td>
                <td>#Factura2</td>
                <td><input name="factura2" type="text" id="factura2" size="40" value="<?=$rs_per['factura2']?>" /></td>
            </tr>
            
            <tr <?=$estilo?>>
            	 <td>Estado Actual:</td>
                 <td><?=$rs_per['estado'];?></td>
                 
                 <td>Cambiar Estado:</td>
                 <td>
                 	<select name="estadofgr" id="estadofgr" class="chosen-select">
                      	<option value=""></option>
                        <option value="CANCELADO">CANCELADO</option>
                        <option value="DUPLICADO">DUPLICADO</option>
                        <!--<option value="PAGADO">PAGADO</option>-->
                      </select>  
                 </td>
            </tr>
            
            <tr>
            	  <td>Creaci&oacute;n:</td>
                  <td colspan="3"><?=$rs_per['fecha_real'];?></td>
            </tr> 
            
            <?php //FGR
			$sqlfgr = "select count(1) as cuenta from opciones_perfiles where id_perfil = ".$_SESSION['perfil']." and opcion = 21";
			$paifgr = mysql_query($sqlfgr);
			$conteofgr=mysql_fetch_assoc($paifgr);
			
			if($conteofgr['cuenta']){ 
            
            	$estilo = '';
                
			}
			
			else{
            
            	$estilo = 'style = "display:none;"';
                
			} ?>      
            
            <tr <?=$estilo?>>
            	<td>F.I. Ejecuci&oacute;n</td>
                <td>  
                	  <input name="fecha_inicio_ejecucion" id="fecha_inicio_ejecucion" value="<?=$rs_per['fecha_inicio_ejecucion'];?>" /> 
                	  <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador5" />
					  <script type="text/javascript">
                          Calendar.setup({
                              inputField     :    "fecha_inicio_ejecucion",      // id del campo de texto
                              ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
                              button         :    "lanzador5"   // el id del botón que lanzará el calendario
                          });
                      </script>
                </td>
          
            	<td>F. Ejecutado</td>
                <td>
                	<input name="fecha_ejecutado" id="fecha_ejecutado" value="<?=$rs_per['fecha_ejecutado'];?>" /> 
                    <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador6" />
					<script type="text/javascript">
                          Calendar.setup({
                              inputField     :    "fecha_ejecutado",      // id del campo de texto
                              ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
                              button         :    "lanzador6"   // el id del botón que lanzará el calendario
                          });
                    </script>
                </td>
            </tr>
            <tr <?=$estilo?>>
            	<td>F. Inf. Enviado</td>
                <td>
                	<input name="fecha_informe" id="fecha_informe" value="<?=$rs_per['fecha_informe'];?>" /> 
                    <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador7" />
					<script type="text/javascript">
                          Calendar.setup({
                              inputField     :    "fecha_informe",      // id del campo de texto
                              ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
                              button         :    "lanzador7"   // el id del botón que lanzará el calendario
                          });
                    </script>
                </td>
         
            	<td>F. Liquidado</td>
                <td>
                	<input name="fecha_liquidacion" id="fecha_liquidacion" value="<?=$rs_per['fecha_liquidacion'];?>" />
                    <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador8" />
					<script type="text/javascript">
                          Calendar.setup({
                              inputField     :    "fecha_liquidacion",      // id del campo de texto
                              ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
                              button         :    "lanzador8"   // el id del botón que lanzará el calendario
                          });
                    </script> 
                </td>
            </tr>
            <tr <?=$estilo?>>
            	<td>F. en Facturaci&oacute;n</td>
                <td>
                	<input name="fecha_facturacion" id="fecha_facturacion" value="<?=$rs_per['fecha_facturacion'];?>" /> 
                    <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador9" />
					<script type="text/javascript">
                          Calendar.setup({
                              inputField     :    "fecha_facturacion",      // id del campo de texto
                              ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
                              button         :    "lanzador9"   // el id del botón que lanzará el calendario
                          });
                    </script> 
                </td>
          
            	<td>F. Facturado</td>
                <td>
                	<input name="fecha_facturado" id="fecha_facturado" value="<?=$rs_per['fecha_facturado'];?>" /> 
                    <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador10" />
					<script type="text/javascript">
                          Calendar.setup({
                              inputField     :    "fecha_facturado",      // id del campo de texto
                              ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
                              button         :    "lanzador10"   // el id del botón que lanzará el calendario
                          });
                    </script> 
                </td>
            </tr>
            
        </tbody>
       
    </table>
    
    <div style="background:#ECECEC; margin-bottom:15px;border:1px solid #CCC;padding:10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px; width:96%; margin-top:20px;">
			<input name="modificar" type="submit" id="modificar" value="Modificar" class="btn_table"/>
            <input name="cancelar" type="button" id="cancelar" value="Cancelar" onclick="fn_cerrar();" class="btn_table"/>
    </div>
</form>
<?php } ?>
<link rel="stylesheet" href="/js/chosen/chosen.css">
<script src="/js/chosen/chosen.jquery.js" type="text/javascript"></script> 
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		
		$(".chosen-select").chosen({width:"220px"}); 
		$(".btn_table").jqxButton({ theme: theme });
		
		$("#frm_per").validate({
			submitHandler: function(form) { console.log('click')
				var respuesta = confirm('\xBFDesea realmente modificar este proyecto?')
				if (respuesta)
					form.submit();
			}
		});
		
	});
	
	function fn_modificar(){
		var str = $("#frm_per").serialize();
		$.ajax({
			url: 'ajax_modificar.php',
			data: str,
			type: 'post',
			success: function(data){
				if(data != "") {
					alert(data);
				}else{
					fn_cerrar();	
				}
			}
		});
	};
</script>