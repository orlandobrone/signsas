<? header('Content-type: text/html; charset=iso-8859-1');

	include "../../conexion.php";
	
	$sql = sprintf("INSERT INTO `anticipo` (`id`, `fecha`, `prioridad`, `nombre_responsable`, `cedula_responsable`, `id_regional`, `id_centroscostos`, `giro`, `total_anticipo`, `banco`, `tipo_cuenta`, `num_cuenta`, `cedula_consignar`, `beneficiario`, `observaciones`, `id_ordentrabajo`, `estado`, `fecha_edit`, publicado) 

				    VALUES (NULL, NOW(), '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'draft');");



	if(!mysql_query($sql)){

		echo "Error al insertar la nueva anticipo:\n$sql"; 

		exit;

	}

	

	$id_anticipo = mysql_insert_id();

	

?>

<!--Hoja de estilos del calendario -->

<link rel="stylesheet" type="text/css" media="all" href="../../calendario/calendar-blue.css" title="win2k-cold-1">



<!-- librería principal del calendario -->

<script type="text/javascript" src="../../calendario/calendar.js"></script>



<!-- librería para cargar el lenguaje deseado -->

<script type="text/javascript" src="../../calendario/calendar-es.js"></script>



<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->

<script type="text/javascript" src="../../calendario/calendar-setup.js"></script>



<style>

table{ table-layout: fixed;word-wrap: break-word; }

</style>



<h1>Formato de Solicitud de Anticipo</h1> 



<div style="float:left; width:556px; margin-right:10px;">

<p>Por favor rellene el siguiente formulario</p>

<form action="javascript: fn_modificar();" method="post" id="frm_per">

<input type="hidden" name="total_anticipo" id="total_anticipo"/>



    <table>

        <tbody>

        	 <tr>

                 <td>ID Anticipo:</td>

                 <td>

                    <input type="text" id="id" name="id" value="<?=$id_anticipo?>" readonly="readonly" />

                 </td>

             </tr>

        	 <tr>

                <td width="20%">Fecha:</td>

                <td width="30%"><input name="fecha" type="text" id="fecha" readonly="readonly required" />

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

                 <select name="prioridad" id="prioridad" class="chosen-select required"> 

                 		<option value="">Seleccionar..</option>

                        <option value="CRITICA">CRITICA</option>

                        <option value="ALTA">ALTA</option>

                        <option value="MEDIA">MEDIA</option>

                        <option value="BAJA">BAJA</option>

                        <option value="GIRADO">GIRADO</option>

                        <option value="RETORNO">RETORNO</option>

                 </select>                

                </td>

            </tr> 

            <tr>
            	<td><div class="fechaaprobado" style="display:none">Fecha Aprobado:</div></td>
                <td><div class="fechaaprobado" style="display:none"><input name="fechaapr" type="text" id="fechaapr" readonly="readonly" />
                    <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador2" /></div>
    
                    <script type="text/javascript">
    
                        Calendar.setup({
    
                            inputField     :    "fechaapr",      // id del campo de texto
    
                            ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto
    
                            button         :    "lanzador2"   // el id del botón que lanzará el calendario
    
                        });
    
                    </script>
                </td>
            </tr>

            <tr>

            	<td colspan="2"><h3>Responsable del Anticipo</h3></td>

            </tr>

            

            <tr>

            	<td>Regional:</td>

                <td>

                 <? $sqlPry = "SELECT * FROM regional ORDER BY region ASC"; 

                    $qrPry = mysql_query($sqlPry);

                 ?>

                 <select name="regional" id="regional" class="chosen-select required var_ordenes"> 

                 		<option value="0">Seleccionar..</option>

                 	 <? while ($rsPry = mysql_fetch_array($qrPry)) { ?>

                        <option value="<?=$rsPry['id']?>"><?=$rsPry['region']?></option> 

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

                <select name="nombre_responsable" id="nombre_responsable" class="chosen-select required"></select>

                </td>

                

                <td>Cedula:</td>

                <td>

                 <input type="text" name="cedula_responsable" id="cedula_responsable" size="40" value="" alt="integer" class="required"/>                

                </td> 

           </tr>         

           <tr> 

                <td>Centro Costo:</td>

                <td> 

                    <? $sqlPry = "SELECT * FROM centros_costos WHERE id = 1 OR id = 2 OR id = 3 OR id = 5 OR id = 6 OR id = 4 ORDER BY sigla ASC"; 

                    $qrPry = mysql_query($sqlPry);

                    ?>

                    <select name="centros_costos" id="centros_costos" class="chosen-select required var_ordenes">

                        <option value="0">Seleccionar..</option>

                        <? while ($rsPry = mysql_fetch_array($qrPry)) { ?>

                        <option value="<?=$rsPry['id']?>"><?=$rsPry['sigla']?> / <?=$rsPry['nombre']?></option>

                        <? } ?>

                    </select>            

                </td>            

         

            	<td>Orden Trabajo:</td>

                <td>

                    <select name="orden_trabajo" id="orden_trabajo" class="chosen-select required"></select>  

                </td>

           </tr> 

        </tbody>

    </table>  

    <h3>Consignar a:</h3>

    <table>

             <tr>

            	<td style="width:220px;">CEDULA:</td>

                <td>

              		<!--<input type="text" name="cedula_consignar" id="cedula_consignar" size="30" alt="integer" class="required" />-->      

                    <? $sqlPry = "SELECT * FROM beneficiarios ORDER BY identificacion ASC"; 

                    $qrPry = mysql_query($sqlPry);

                    ?>

                    <select name="cedula_consignar" id="cedula_consignar" class="chosen-select required">

                        <option value="0">Seleccionar..</option>

                        <? while ($rsPry = mysql_fetch_array($qrPry)) { ?>

                            <option value="<?=$rsPry['identificacion']?>" 

                                nombre="<?=$rsPry['beneficiario']?>"

                                entidad="<?=$rsPry['entidad']?>"

                                numcuenta="<?=$rsPry['num_cuenta']?>"

                                tipocuenta="<?=$rsPry['tipo_cuenta']?>"><?=$rsPry['identificacion']?></option>

                        <? } ?>

                    </select>    

                </td>  

                

                <td>BENEFICIARIO:</td>

                <td>

              		<input type="text" name="beneficiario" id="beneficiario" size="30" class="required"/>       

                </td>       

            </tr>

                    

            <tr>

            	<td>BANCO:</td>

                <td>

                 	<input type="text" name="banco" id="banco" size="30"  class="required" />               

                </td>

                

                <td>TIPO CUENTA:</td>

                <td>

              		<input type="text" name="tipo_cuenta" id="tipo_cuenta" size="30" class="required"/>       

                </td> 

            </tr>

            <tr>    

                <td>No. CUENTA:</td>

                <td>

              		<input type="text" name="num_cuenta" id="num_cuenta" size="30" class="required"/>       

                </td> 

                <td>OBSERVACIONES:</td>

                <td>

              		<input type="text" name="observaciones" id="observaciones" size="30" value="<?=$rs_per['observaciones']?>"/>       

                </td>  

            </tr>   
            <tr>
            	<td>TIPO BANCO</td>
                <td colspan="3">
                	<input type="radio" name="opcionbanco" value="Bancolombia" class="required"/> Bancolombia.                   
                    <input type="radio" name="opcionbanco" value="Otros Bancos" class="required"/> Otros Bancos.
                    <input type="radio" name="opcionbanco" value="Giro Efectivo" class="required"/> Giro Efectivo.
                </td>
            </tr>    

      </table> 

      <h3>Informaci&oacute;n Cotizaci&oacute;n</h3>

        <table>

            <tbody>          	

                <tr>

                  <td>Valor cotizado:</td>

                  <td>

                     <input type="text" name="v_cotizado" id="v_cotizado" class="required" readonly="readonly" style="background:#CCC"/> 

                  </td>            

                </tr>       

            </tbody>   

       </table>  

       <br />

</form>

</div>



<form action="javascript: fn_agregar_item();" method="post" id="frm_item">



	<input type="hidden" id="id" name="id" value="<?=$id_anticipo?>" />

	<h3>Informaci&oacute;n del Anticipo</h3>

   

    <table style="width:100%">

        <tbody>          	

            <tr>

              <td>Valor del Giro (Aplica para Efecty, etc):</td>

              <td>

                 <input type="text" name="giro" id="giro" value="0" alt="decimal"/> 

              </td> 

              <td>Total Anticipo:</td>

              <td><input type="text" name="total_anticipo" id="total_anticipo" readonly="readonly" style="background:#CCC"/>  

                  <input type="hidden"  id="test_total"/>               

              </td>           

        	</tr>       

        </tbody>   

   </table>

   <h4>Agregar Item</h4>   

   <table style="width:100%;">

        <tbody>       

           

          	<tr>

                  <td>Hitos:</td>

                  <td>                     

                      <select name="hitos" id="hitos" class="chosen-select required">

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

                  <td><!--Valor cotizado hito al cliente:--></td>

                  <td>

                      <input type="hidden" name="valor_hito" id="valor_hito" value="0" alt="decimal" class="required" />                 

                  </td>        

           </tr> 

           <tr>

           	<td colspan="2"><input name="agregar" type="submit" id="agregar" value="Agregar Item" class="btn_table"/></td>

           </tr>

               

    	  </tbody>	

    	</table>

	</form>

	<div id="jqxgrid2" style="margin-top:20px; margin-bottom:20px;"></div>

</div>  

      

<div style="background:#ECECEC; margin-bottom:15px;border:1px solid #CCC;padding:10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px; width:96%; margin-top:20px;">

    <input name="modificar" type="submit" id="modificar" value="Guardar" class="btn_table" />

    <input name="cancelar" type="button" id="cancelar" value="Cancelar" onclick="fn_cerrar(<?=$id_anticipo?>);"  class="btn_table"/>                   

</div>



<script type="text/javascript">

$(document).ready(function () {

			

            var source =

            {

                 datatype: "json",

                 datafields: [

					 { name: 'i.id', type: 'number'},

					 { name: 'id_hitos', type: 'number'},

					 { name: 'acpm', type: 'string'},

					 { name: 'valor_transporte', type: 'string'},

					 { name: 'toes', type: 'string'},

					 { name: 'total_hito', type: 'string'},

                     //{ name: 'valor_hito', type: 'string'},			

					 { name: 'acciones', type: 'string'}						 

                ],

				updaterow: function (rowid, rowdata, commit) {

                    // synchronize with the server - send update command

                    // call commit with parameter true if the synchronization with the server is successful 

                    // and with parameter false if the synchronization failder.

                    commit(true);

                },

				cache: false,

			    url: 'ajax_list_items.php?id=<?=$id_anticipo?>',

				root: 'Rows',

				sortcolumn: 'i.id',

                sortdirection: 'desc',

				filter: function()

				{

					// update the grid and send a request to the server.

					$("#jqxgrid").jqxGrid('updatebounddata', 'filter');

				},

				sort: function()

				{

					// update the grid and send a request to the server.

					$("#jqxgrid").jqxGrid('updatebounddata', 'sort');

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

                rowsheight: 40,

                columnsresize: true,

				virtualmode: true,

				rendergridrows: function(obj)

				{

					 return obj.data;      

				},                

                columns: [

				  { text: '-', datafield: 'acciones', filtertype: 'none', width:40, cellsalign: 'center', editable: false },

                  { text: 'Item', datafield: 'i.id', filtertype: 'textbox', filtercondition: 'equal', width: 60,  columntype: 'textbox', editable: false },

                  { text: 'Hito', datafield: 'id_hitos',  filtertype: 'textbox', filtercondition: 'starts_with',  width: 150, editable: false },

				  { text: 'Valor ACPM', datafield: 'acpm', filtertype: 'none', width: 130, cellsalign: 'right' },

				  { text: 'Valor Transporte', datafield: 'valor_transporte', filtertype: 'none', width:130, cellsalign: 'right'},

                  { text: 'TOES', datafield: 'toes', filtertype: 'none', width: 130, cellsalign: 'right' },

				  { text: 'Total Anticipo Hito', datafield: 'total_hito', filtertype: 'none', width: 130, cellsalign: 'right' }

                  /*{ text: 'Valor Cotizado', datafield: 'valor_hito', filtertype: 'none', width: 130, cellsalign: 'right' }*/

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

		

		$('#modificar').click(function(){

			$("#frm_per").submit(); 

		});

		

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

		});

		
		$('#prioridad').change(function(){
			
			if($(this).val() == 'GIRADO'){
				$('.fechaaprobado').css('display','block');
				$('#fechaapr').addClass('required');
			}
			else {
				$('.fechaaprobado').css('display','none');
				$('#fechaapr').removeClass('required');
				$('#fechaapr').val('');
			}
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
						
							/*if(v.valido == 0)
								options.append($("<option style='background-color:red;'></option>").val(v.id).text(v.orden+' ('+v.estado+')'));
							else*/
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

	

	/*function fn_agregar(){

		var str = $("#frm_per").serialize();

		$.ajax({

			url: 'ajax_agregar.php',

			data: str,

			type: 'post',

			success: function(data){

				if(data != "") {

					alert(data);

				}else{

					fn_cerrar();	

					$("#jqxgrid").jqxGrid('updatebounddata', 'cells');

				}

			}

		});

	};*/

	

	function fn_agregar_item(){ 

		  var str = $("#frm_item").serialize();	

          var value1, value2, value3, value11, value22;

		

		  $.ajax({

			type: 'POST',

			dataType: 'json',

			url: 'ajax_agregar_item.php', 

			data: str,

			success: function(data){	

				if (data.estado == true){ 

				   $("#total_anticipo, #test_total").val(data.total_anticipo);

				   $("#jqxgrid2").jqxGrid('updatebounddata');

				   

				   value1 = 0;

				   value11 = replaceAll($("#valor_hito").val(),".","");

				   value1 += parseFloat(value11);

				   

                   if($("#v_cotizado").val().length == 0)

				       value2 = 0;

                   else{

					   value2 = 0;

				   	   value22 = replaceAll($("#v_cotizado").val(),".","");

				       value2 += parseFloat(value22);

                       value2 = parseFloat($("#v_cotizado").val().replace('.','').replace(',','.'));

				   }

                                   

                   value3 = value1+value2;

				   $("#v_cotizado").val(value3.toString());

				   

				}else{

					alert(data.message);

				}

			}

	   });

   }

</script>