<?  header('Content-type: text/html; charset=iso-8859-1');

	session_start();

	if(empty($_POST['ide_per'])){

		echo "Por favor no altere el fuente";

		exit;

	}



	include "../extras/php/basico.php";

	include "../../conexion.php";



	$sql = sprintf("select * from anticipo where id=%d",

		(int)$_POST['ide_per']

	);

	$per = mysql_query($sql);

	$num_rs_per = mysql_num_rows($per);

	if ($num_rs_per==0){

		echo "No existen anticipo con ese ID";

		exit;

	}

	

	$rs_per = mysql_fetch_assoc($per);

	

	

	$letters = array('.');

	$fruit   = array('');		

	

	$acpm = 0;

	$valor_transporte = 0;

	$toes = 0;

	$total_acpm = 0;

	$total_transpornte = 0;

	$total_toes = 0;

	$total_anticipo = 0;

	

	$resultado = mysql_query("SELECT * FROM items_anticipo WHERE id_anticipo =".$_POST['ide_per']) or die(mysql_error());

	$total = mysql_num_rows($resultado);

	while ($rows = mysql_fetch_assoc($resultado)):

	

		if($rows['acpm'] != 0):

			$acpm = explode(',00',$rows['acpm']);

			$acpm = str_replace($letters, $fruit, $acpm[0] );

			$total_acpm += $acpm;

		endif;

		

		if($rows['valor_transporte'] != 0):

			$valor_transporte = explode(',00',$rows['valor_transporte']);

			$valor_transporte = str_replace($letters, $fruit, $valor_transporte[0] );

			$total_acpm += $valor_transporte;

		endif;

		

		

		if($rows['toes'] != 0):

			$toes = explode(',00',$rows['toes']);

			$toes = str_replace($letters, $fruit, $toes[0] );

			$total_anticipo += $toes;

		endif;

		

	endwhile;

	$giro = 0;



	if($rs_per['giro'] != 0){

		$giro = explode(',00',$rs_per['giro']);

		$giro = str_replace($letters, $fruit, $giro[0] );

	}

	

	$total_anticipo = $total_acpm + $total_toes + $total_anticipo + $giro;		

	$total_anticipo = '$'.number_format($total_anticipo).',00';

	

?>

<!--Hoja de estilos del calendario -->

<link rel="stylesheet" type="text/css" media="all" href="../../calendario/calendar-blue.css" title="win2k-cold-1">



<!-- librería principal del calendario -->

<script type="text/javascript" src="../../calendario/calendar.js"></script>



<!-- librería para cargar el lenguaje deseado -->

<script type="text/javascript" src="../../calendario/calendar-es.js"></script>



<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->

<script type="text/javascript" src="../../calendario/calendar-setup.js"></script>



<link rel="stylesheet" href="/js/chosen/chosen.css">

<script src="/js/chosen/chosen.jquery.js" type="text/javascript"></script> 



<style>

.list_combo{ display:none; }

</style>



<div id="content_form">

    <img src="/images/logo_sign.png"  style="float:left;"/>

    <h1 style="float:left; margin-left:20px;line-height: 43px;">FORMATO DE SOLICITUD DE ANTICIPO</h1> 

    <div style="clear:both"></div>

<div>



<form action="javascript: fn_modificar();" method="post" id="frm_per">

<input type="hidden"  name="action" value="edit" readonly="readonly" />

	<table style="display:block;">

        <tbody>

        	 <tr>

                <td>ID:</td>

                <td><input type="text" id="id" name="id" value="<?=$rs_per['id']?>" readonly="readonly" /></td>

                <td width="20%">Fecha:</td>

                <td width="30%"><input name="fecha" type="text" id="fecha" readonly="readonly required" value="<?=$rs_per['fecha']?>"/>

                  <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador" />

				<script type="text/javascript">

					Calendar.setup({

						inputField     :    "fecha",      // id del campo de texto

						ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto

						button         :    "lanzador"   // el id del botón que lanzará el calendario

					});

				</script>

                </td>

                <td width="20%">Prioridad:</td>

                <td width="30%">

                 <input type="text" name="prioridad" id="prioridad" value="<?=$rs_per['prioridad']?>"/>                

                </td>

            </tr> 

         </tbody>

      </table>   

      

      <h3>Responsable del Anticipo</h3>

      

      <table style="display:block">      

            

            <tr>

            	 <td>Regional:</td>

                 <td>

                 <? $sqlPry = "SELECT * FROM regional ORDER BY region ASC"; 

                    $qrPry = mysql_query($sqlPry);

                 ?>

                 <select name="regional" id="regional" class="chosen-select required var_ordenes">

                 	 <? while ($rsPry = mysql_fetch_array($qrPry)) { ?>

                        <option value="<?=$rsPry['id']?>" <?php echo ($rsPry['id']==$rs_per['id_regional'])? 'selected="selected"': '';?>><?=$rsPry['region']?></option> 

                     <? } ?>

                 </select>    

             	</td>

                <td colspan="2">

                	<div id="mensaje" class="alert" style="display:none;">Debe selecionar Regional y Centro Costos.</div>

                </td>

            </tr>

            

            <tr>           

            

                <td>Nombre:</td>

                <td>

                 <!--<input type="text" name="nombre_responsable" id="nombre_responsable" size="40" value="<?=$rs_per['nombre_responsable']?>" class="required"/>-->      

                 	<select name="nombre_responsable" id="nombre_responsable" class="chosen-select required">

                    	<option value="<?=$rs_per['nombre_responsable']?>"><?=$rs_per['nombre_responsable']?></option>

                    </select>          

                </td>

                

                <td>Cedula:</td>

                <td>

                 <input type="text" name="cedula_responsable" id="cedula_responsable" size="40" value="<?=$rs_per['cedula_responsable']?>" alt="integer" class="required"/>                

                </td>            

            </tr>

            

            <tr>             

                <td>Centro Costo:</td>

                <td>

                    <? $sqlPry = "SELECT * FROM centros_costos ORDER BY sigla ASC"; 

                    $qrPry = mysql_query($sqlPry);

                    ?>

                    <select name="centros_costos" id="centros_costos" class="chosen-select required var_ordenes">

                        <? while ($rsPry = mysql_fetch_array($qrPry)) { ?>

                        <option value="<?=$rsPry['id']?>" <?php echo ($rsPry['id']==$rs_per['id_centroscostos'])? 'selected="selected"': '';?>><?=$rsPry['sigla']?> / <?=$rsPry['nombre']?></option>

                        <? } ?>

                    </select>            

                </td>              

           

            	<td>Ordenes de Trabajos:<?=$rs_per['id_ordentrabajo']?></td>

                <td>

                    <select name="orden_trabajo" id="orden_trabajo" class="chosen-select required">

                    	 <? 

						 	$resultado = mysql_query("SELECT * FROM orden_trabajo WHERE id_regional = ".$rs_per['id_regional']." AND id_centroscostos = ".$rs_per['id_centroscostos']) or die(mysql_error());

                    	 ?>

                         <? while ($rsPry = mysql_fetch_array($resultado)) { 

						 ?>

                        		<option value="<?=$rsPry['id_proyecto']?>" <?=($rsPry['id_proyecto']==$rs_per['id_ordentrabajo'])? 'selected="selected"' : '';?>><?=$rsPry['orden_trabajo']?></option>

                         <? } ?>

                         

                    </select>     

                </td>

                

            </tr>  

            </tbody>  

    </table>  

    

    <table style="width:100%;">

        <tbody>            

            

            <tr>

            	<td colspan="4"><h3>Consignar a:</h3></td>

            </tr>   

            <tr>

            	<td>CEDULA:</td>

                <td>

              	<input type="text" name="cedula_consignar" id="cedula_consignar" size="30" alt="integer" class="required" value="<?=$rs_per['cedula_consignar']?>"/>

                </td>  

                

                <td>BENEFICIARIO:</td>

                <td>

              		<input type="text" name="beneficiario" id="beneficiario" size="30" class="required" value="<?=$rs_per['beneficiario']?>"/>       

                </td>       

            </tr>          

            <tr>

            	<td>BANCO:</td>

                <td>

                 	<input type="text" name="banco" id="banco" size="30"  class="required" value="<?=$rs_per['banco']?>"/>               

                </td>

                

                <td>TIPO CUENTA:</td>

                <td>

              		<input type="text" name="tipo_cuenta" id="tipo_cuenta" size="30" class="required" value="<?=$rs_per['tipo_cuenta']?>"/>       

                </td> 

            </tr> 

            <tr>    

                <td>N&deg; DE CUENTA:</td>

                <td>

              		<input type="text" name="num_cuenta" id="num_cuenta" size="30"  alt="integer" class="required" value="<?=$rs_per['num_cuenta']?>"/>    

                </td>         

           

            	<td>OBSERVACIONES:</td>

                <td>

              		<input type="text" name="observaciones" id="observaciones" size="30" value="<?=$rs_per['observaciones']?>"/>       

                </td>      

            </tr> 
            
            <tr>
            	<td>TIPO BANCO</td>
                <?
					switch($rs_per['tipo_banco']){
						case 'Bancolombia';
							$opcion1 = 'checked="checked"';
						break;
						case 'Otros Bancos';
							$opcion2 = 'checked="checked"';
						break;
						case 'Giro Efectivo';
							$opcion3 = 'checked="checked"';
						break;
					}				
				?>
                
                
                <td colspan="3">
                	<input type="radio" name="opcionbanco" value="Bancolombia"  <?=$opcion1?> class="required"/> Bancolombia.                   
                    <input type="radio" name="opcionbanco" value="Otros Bancos" <?=$opcion2?> class="required"/> Otros Bancos.
                    <input type="radio" name="opcionbanco" value="Giro Efectivo" <?=$opcion3?> class="required"/> Giro Efectivo.
                </td>
            </tr>      

        </tbody>

    </table>   

    <h3>Informaci&oacute;n Cotizaci&oacute;n</h3>

        <table>

            <tbody>          	

                <tr>

                  <td>Valor cotizado:</td>

                  <td>

                     <input type="text" name="v_cotizado" id="v_cotizado" class="required" value="<?=$rs_per['v_cotizado']?>" 		                       readonly="readonly"/> 

                  </td>            

                </tr>       

            </tbody>   

       </table>  

       <br />

</form>

  

<form action="javascript: fn_agregar_item();" method="post" id="frm_item">



<input type="hidden" id="id" name="id" value="<?=$rs_per['id']?>" />

	<h3>Informaci&oacute;n del Anticipo</h3>

   

    <table style="width:100%">

        <tbody>          	

            <tr>

              <td>Valor del Giro (Aplica para Efecty, etc):</td>

              <td>

                 <input type="text" name="giro" id="giro" value="<?=$rs_per['giro']?>" alt="decimal"/> 

              </td> 

               <td>Total Anticipo:</td>

              <td>

                  <input type="text" name="total_anticipo" id="total_anticipo" alt="decimal" readonly="readonly" value="<?=$total_anticipo?>"/>               

              </td>           

        	</tr>       

        </tbody>   

   </table>

   <div class="agregar_item_content" style="display:block;">

   <h4>Agregar Item</h4>  

   <table style="width:100%;table-layout: fixed;word-wrap: break-word;">

        <tbody>       

           

          	<tr>

                  <td>Hitos:</td>

                  <td>

                      <select name="hitos" id="hitos" class="chosen-select required">

                      	<option>Seleccione...</option>

                      <?php

                      	$total = 0;

						$resultado = mysql_query("SELECT * FROM hitos  						  

						  						  WHERE id_proyecto = ".$rs_per['id_ordentrabajo']) or die(mysql_error());

                        

						$total = mysql_num_rows($resultado);

                        if($total > 0):

                            while($row = mysql_fetch_assoc($resultado)):

								?>

                                	<option value="<?=$row['id']?>"><?=utf8_encode($row['nombre']).'-'.$row['fecha_inicio']?></option>

                                <?php			

                            endwhile;

                        endif;

						?>

                           

                      </select>            

                  </td> 

           </tr>

           <tr>                  

            

                  <td>Valor ACPM para el suministro:</td>

                  <td>

                      <input type="text" name="acpm" id="acpm" value="0" alt="decimal" class="required" />               

                  </td>

            

                  <td>Valor Transporte - Trasiego o Mular:</td>

                  <td>

                      <input type="text" name="valor_transporte" value="0" id="valor_transporte" alt="decimal" class="required"/>      

                  </td>    

           </tr>

           <tr>       

                  <td>Valor Viaticos - TOES :</td>

                  <td>

                      <input type="text" name="toes" id="toes" value="0" alt="decimal" class="required" />                 

                  </td>        

           </tr> 

           <tr>

           	<td colspan="2"><input name="agregar" type="submit" id="agregar" value="Agregar Item" class="btn_table"/></td>

           </tr>

               

    	  </tbody>	

    	</table>

    </div>

	</form>

    <div id="grid_html"></div>

	<div id="jqxgrid2" style="margin-top:20px; margin-bottom:20px;"></div>

</div>



<div style="background:#ECECEC; margin-bottom:15px;border:1px solid #CCC;padding:10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px; width:96%; margin-top:20px;">

      <?php if($_SESSION['modificar_anticipo'] == true ): ?>

       <input name="update" type="button" id="update" value="Actualizar" class="btn_table" /> 

      <?php endif; ?>                 

       <input name="btn_print" type="button" id="btn_print" value="Imprimir" class="btn_table" /> 

       <input name="cancelar" type="button" id="cancelar" value="Cancelar" onclick="fn_cerrar();"  class="btn_table" />                  

</div>



</div>



<script type="text/javascript">

$(document).ready(function () {

            var source =

            {

                 datatype: "json",

                 datafields: [

					 { name: 'i.id', type: 'number'},

					 { name: 'idHitos', type: 'number'},					 

					 { name: 'id_hitos', type: 'string'},

					 { name: 'acpm', type: 'string'},

					 { name: 'valor_transporte', type: 'string'},

					 { name: 'toes', type: 'string'},

					 { name: 'total_hito', type: 'string'},

                     { name: 'valor_hito', type: 'string'},			

					 { name: 'acciones', type: 'string'}						 

                ],

				updaterow: function (rowid, rowdata, commit) {

                    // synchronize with the server - send update command

                    // call commit with parameter true if the synchronization with the server is successful 

                    // and with parameter false if the synchronization failder.

                    commit(true);

                },

				cache: false,

			    url: 'ajax_list_items.php?id=<?=$_POST['ide_per']?>',

				root: 'Rows',

				sortcolumn: 'i.id',

                sortdirection: 'desc',

				filter: function()

				{

					// update the grid and send a request to the server.

					$("#jqxgrid2").jqxGrid('updatebounddata', 'filter');

				},

				sort: function()

				{

					// update the grid and send a request to the server.

					$("#jqxgrid2").jqxGrid('updatebounddata', 'sort');

				},

				root: 'Rows',

				beforeprocessing: function(data)

				{		

					if (data != null)

					{

						source.totalrecords = data[0].TotalRows;					

					}

				}

				};		

				var dataadapter = new $.jqx.dataAdapter(source, {

					loadError: function(xhr, status, error)

					{

						alert(error);

					}

				}

				);



            var dataadapter = new $.jqx.dataAdapter(source);



            $("#jqxgrid2").jqxGrid({

                width: 640,

				height: 260,

                source: dataadapter,

				editable: true,

                showfilterrow: false,

                pageable: true,

                filterable: false,

                theme: theme,

				sortable: true,

                rowsheight: 25,

                columnsresize: true,

				virtualmode: true,

				rendergridrows: function(obj)

				{

					 return obj.data;      

				},                

                columns: [ 

				  { text: '-', datafield: 'acciones', filtertype: 'none', width:40, cellsalign: 'center', editable: false },

                  { text: 'ID Hito', datafield: 'idHitos', filtertype: 'textbox', filtercondition: 'equal', width: 60,  columntype: 'textbox', editable: false },

                  { text: 'Hito', datafield: 'id_hitos', columntype: 'dropdownlist', filtertype: 'textbox', width: 150, editable: false },

				  { text: 'Valor ACPM', datafield: 'acpm', filtertype: 'none', width: 130, cellsalign: 'right' },

				  { text: 'Valor Transporte', datafield: 'valor_transporte', filtertype: 'none', width:130, cellsalign: 'right'},

                  { text: 'TOES', datafield: 'toes', filtertype: 'none', width: 130, cellsalign: 'right' },

				  { text: 'Total Anticipo Hito', datafield: 'total_hito', filtertype: 'none', width: 130, cellsalign: 'right' },

                  { text: 'Valor Cotizado', datafield: 'valor_hito', filtertype: 'none', width: 130, cellsalign: 'right' }

                ]

            });			

            $("#jqxgrid2").on('cellendedit', function (event) {

				

                var args = event.args;

				var id = $("#jqxgrid2").jqxGrid('getcellvalue',args.rowindex, 'id');

				

				if(args.datafield == 'fecha'){

					var formattedDate = $.jqx.dataFormat.formatdate(args.value, 'yyyy-MM-dd');

					args.value = formattedDate

				}

				

		   		$.ajax({

					  type: 'POST',

					  dataType: 'json',

					  url: 'ajax_update_item.php',

					  data: {

						  		id_item: id,

								campo: args.datafield,

								valor: args.value

				      },

					  success: function(data){	

						  if (data.estado == true){ 

							 

						  }

					  }

				 });

		   

		    });

			//$("#excelExport").jqxButton({ theme: theme });

            //$('#clearfilteringbutton').jqxButton({ height: 25, theme: theme });

           /* $('#clearfilteringbutton').click(function () {



                $("#jqxgrid2").jqxGrid('clearfilters');

            });*/

			/*$("#excelExport").click(function () {

                $("#jqxgrid2").jqxGrid('exportdata', 'xls', 'Lista Items');           

            });*/

});

</script>



<script language="javascript" type="text/javascript">

	$(document).ready(function(){

		

		$(".chosen-select").chosen({width:"220px"}); 

		$('input').setMask();

		$(".btn_table").jqxButton({ theme: theme });

		

		$('#update').click(function(){ $("#frm_per").submit(); })	

		

		$("#frm_per").validate({

			submitHandler: function(form) {

				var respuesta = confirm('\xBFDesea realmente modificar estos parametros?')

				if (respuesta)

					form.submit();

			}

		});

		

		

		$("#frm_item").validate({

			rules:{

				usu_per:{

					required: true,

					remote: "ajax_verificar_usu_per.php"

				}

			},  

			messages: {

				usu_per: "x"

			},

			onkeyup: false,

			submitHandler: function(form) {

				var respuesta = confirm('\xBFDesea realmente agregar este item?')

				if (respuesta)

					form.submit();

			}

		});

		

		

		

		$('#prioridad').blur(function(){

			var variable = $(this).val().toUpperCase();

			$(this).val(variable);

		})

		

		

		$('#aprobar').click(function(){

			var idAnticipo = <?=$rs_per['id']?>;

			var respuesta = confirm('\xBFDesea realmente cambiar el estado a aprobado?')

				if (respuesta){		

					$.post('ajax_aprobar_anticipo.php',{id:idAnticipo},function(data){

						fn_cerrar();	

						$("#jqxgrid").jqxGrid('updatebounddata', 'cells');

					});

				}

		});

		  

		$('#btn_print').click(function(){

			$(".btn_actions, .agregar_item_content, #jqxgrid2").hide(); 			

			var gridContent = $("#jqxgrid2").jqxGrid('exportdata', 'html');

			$('#grid_html').html(gridContent);

			$("#content_form").printArea();

			fn_cerrar(); 

		});	

		

		$('#cedula_consignar').change(function(){

			var nombre, banco, tipocuenta, numcuenta;

			$( "#cedula_consignar option:selected" ).each(function() {

			  nombre = $( this ).attr('nombre');

			  banco = $( this ).attr('entidad');

			  tipocuenta = $( this ).attr('tipocuenta');

			  numcuenta = $( this ).attr('numcuenta');

			});

			$('#beneficiario').val(nombre);

			$('#banco').val(banco);

			$('#tipo_cuenta').val(tipocuenta);

			$('#num_cuenta').val(numcuenta);

		});

		

		

		$('#nombre_responsable').change(function(){

			var cedula;

			$( "#nombre_responsable option:selected" ).each(function() {

			  cedula = $( this ).attr('cedula');

			});

			$('#cedula_responsable').val(cedula);

		});

		

		var regional_actual;

		$('.var_ordenes').change(function(){ 

		

			$('#orden_trabajo').empty();

			$("#orden_trabajo").trigger("chosen:updated");

			

			$('#hitos').empty();

			$("#hitos").trigger("chosen:updated");

			

			var regional = $('#regional').val();

			var centrocosto = $('#centros_costos').val(); 

			

			

			if(regional != '0' && regional_actual != regional ){

				

				$.getJSON('ajax_list_responsable.php', {id_regional:regional}, function (data) {

						var options = $('#nombre_responsable');

						$('#nombre_responsable').empty();

						$('#nombre_responsable').append('<option value="">Seleccione..</option>');				

						

						$.each(data, function (i, v) { 

							options.append($("<option></option>").val(v.nombre).text(v.nombre).attr('cedula',v.cedula));

						});

						

						$("#nombre_responsable").trigger("chosen:updated");

						regional_actual = regional;

						$('#cedula_responsable').val('');

				});

				

			}

			

			if(regional != '0' && centrocosto != '0'){

			/* Get Ordenes de trabajo   */	 

				$.getJSON('ajax_list_ordenes_trabajo.php', {id_regional:regional, id_centroscostos:centrocosto}, function (data) {

						var options = $('#orden_trabajo');

						$('#orden_trabajo').empty();

						$('#orden_trabajo').append('<option value="">Seleccione..</option>');				

						

						$.each(data, function (i, v) { 

							options.append($("<option></option>").val(v.id).text(v.orden));

						});

						

						$("#orden_trabajo").trigger("chosen:updated");

				});

			}else{

				$('#mensaje').show();

			}

			

		});

		

		

		$('#orden_trabajo').change(function(){ 

			var orden;

			$('#hitos').empty();

			var proyecto = $( "#orden_trabajo" ).val();			

			

			$.getJSON('ajax_list_hitos_orden.php', {id_proyecto:proyecto}, function (data) { 

					if(data != null){

						var options = $('#hitos');

						$('#hitos').empty();

						$('#hitos').append('<option value="">Seleccione..</option>');				

						

						$.each(data, function (i, v) { 

							options.append($("<option></option>").val(v.id).text(v.orden));

						});

						

						$("#hitos").trigger("chosen:updated");

						

					}else{ 

						alert('No se encontraron hitos para esta orden de trabajo');

						$('#hitos').empty();

						$('#hitos').append('<option value="">Seleccione..</option>');

						$("#hitos").trigger("chosen:updated");

					

					}

			});

		});

		

		

		

	});

	

	

	function replaceAll( text, busca, reemplaza ){

	  while (text.toString().indexOf(busca) != -1)

		  text = text.toString().replace(busca,reemplaza);

	  return text;

	}



	

	$('.anticipo').blur(function(){

		var total = 0;

		$('.anticipo').each(function( index ) {

			var val = replaceAll($( this ).val(),".","");

			total += parseFloat(val);

		});

		

		$('#total_anticipo').val(total+',00').setMask(); 

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

					$("#jqxgrid").jqxGrid('updatebounddata', 'cells');

				}

			},

			error: function(err) {

				alert(err);

			}

		});

	};

	

	function fn_agregar_item(){ 

		  var str = $("#frm_item").serialize();		

		  $.ajax({

			type: 'POST',

			dataType: 'json',

			url: 'ajax_agregar_item.php',

			data: str,

			success: function(data){	

				if (data.estado == true){ 

				   $("#total_anticipo").val(data.total_anticipo);

				  /* $("#valor_pagar").val(data.valor_pagar);*/

				   $("#jqxgrid2").jqxGrid('updatebounddata');

				   //$('#frm_per').reset();

				}else{

					alert(data.message);

				}

			}

	   });

   }

		

</script>