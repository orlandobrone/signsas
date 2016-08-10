<? header('Content-type: text/html; charset=iso-8859-1');

	if(empty($_POST['ide_per'])){

		echo "Por favor no altere el fuente";

		exit;

	}

	include "../extras/php/basico.php";
	include "../../conexion.php";

	$sql = sprintf("select * from solicitud_despacho where id=%d",
		(int)$_POST['ide_per']
	);

	$per = mysql_query($sql);

	$num_rs_per = mysql_num_rows($per);

	if ($num_rs_per==0){
		echo "No existen solicitudes de despacho con ese ID";
		exit;
	}

	$rs_per = mysql_fetch_assoc($per);
	$id_despacho = $rs_per['id'];
	
	$sql = "SELECT * FROM materiales WHERE id_despacho =".(int)$_POST['ide_per'];
  	$resultado = mysql_query($sql) or die(mysql_error());
	$noaprobado = true;

	while($row2 = mysql_fetch_assoc($resultado)):
		if($row2['aprobado']>=1):
			$noaprobado = false;
		endif;				  
	endwhile;


?>

<h1>Formato Solicitud de Despacho No.:<?=$id_despacho?></h1>

<table>

        <tbody>

        	 <tr>

                <td style="font-weight:bold;">Fecha Solicitud:</td>

                <td><?=$rs_per['fecha_solicitud']?></td>

          </tr>

          <tr>

                <td style="font-weight:bold;">Fecha Entrega:</td>

                <td><?=$rs_per['fecha_entrega']?></td>

              

                <td style="font-weight:bold;">Prioridad:</td>

                <td><?=$rs_per['prioridad']?></td>

            </tr> 

            

            <tr>

            	<td colspan="2"><h3>Responsable de la Solicitud</h3></td>

            </tr>

            

            <tr>

            	<td style="font-weight:bold;">Regional:</td>

                <td>

                 <? 

				 	$sqlPry = "SELECT * FROM regional WHERE id =".$rs_per['id_regional']; 

                    $qrPry = mysql_query($sqlPry);

					$rsPry = mysql_fetch_array($qrPry);

                 	echo $rsPry['region'];

				 ?>

                </td> 

                <td colspan="2">

                	<div id="mensaje" class="alert" style="display:none;">Debe selecionar Regional y Centro Costos.</div>   

                </td>  

            </tr>

            <tr>        

                <td style="font-weight:bold;">Nombre:</td>

                <td><?=$rs_per['nombre_responsable']?></td>

                

                <td style="font-weight:bold;">Cedula:</td>

                <td><?=$rs_per['cedula_responsable']?></td> 

           </tr>         

           <tr> 

                <td style="font-weight:bold;">Centro Costo:</td>

                <td>

                    <? 

						$sqlPry = "SELECT * FROM centros_costos WHERE id =".$rs_per['id_centrocostos'];

                    	$qrPry = mysql_query($sqlPry);

                        $rsPry = mysql_fetch_array($qrPry);

					?>

                    <?=$rsPry['sigla']?> / <?=$rsPry['nombre']?>

                </td>            

         

            	<td style="font-weight:bold;">Orden Trabajo:</td>

                <td>

                    <? 

						$sqlPry = "SELECT * FROM orden_trabajo WHERE id_proyecto =".$rs_per['id_proyecto'];

                    	$qrPry = mysql_query($sqlPry);

                        $rsPry = mysql_fetch_array($qrPry);

					?>

                    <?=$rsPry['orden_trabajo'];?>

                </td>

           </tr> 

           <tr>

               <td style="font-weight:bold;">Hitos:</td>

               <td>                     

                	<? 

						$sqlPry = "SELECT * FROM hitos WHERE id =".$rs_per['id_hito'];

                    	$qrPry = mysql_query($sqlPry);

                        $rsPry = mysql_fetch_array($qrPry);

					?>

                    <?=$rsPry['nombre'];?>        

               </td> 

           </tr>

           

        </tbody>

    </table>  

	<br />

    <table>

            <tr>

              <td style="font-weight:bold;">Direcci&oacute;n de entrega</td>

              <td><?=$rs_per['direccion_entrega']?></td>

              <td style="font-weight:bold;">Nombre de quien recibe</td>

              <td><?=$rs_per['nombre_recibe']?></td>

            </tr>

            <tr>

              <td style="font-weight:bold;">Tel&eacute;fono / Celular</td>

              <td><?=$rs_per['celular']?></td>

              <td style="font-weight:bold;">Descripci&oacute;n:</td>

              <td><?=$rs_per['descripcion']?></td>

            </tr>   

    </table>   

</div>



<h3>Agregar Materiales</h3>

   

<h4>Agregando salida de mercancia</h4>   

<p>Por favor rellene el siguiente formulario</p>

<form action="javascript: fn_agregar_material();" method="post" id="form_material">

    

            <input type="hidden" value="<?=$id_despacho?>" name="id_despacho"/>

            <input type="hidden" value="0" name="cantidadPendiente" id="cantidadPendiente"/>

            <table class="formulario">

                <tbody>

                    <tr>

                        <td>Material</td>

                        <td colspan="2">

                            <? $sqlMat = sprintf("SELECT * FROM inventario ORDER BY nombre_material ASC");

                                    $perMat = mysql_query($sqlMat);

                                    $num_rs_per_mat = mysql_num_rows($perMat); ?>

                           <select class="chosen-select" tabindex="2" name="material" id="material">

                                <option value="">Seleccione una opci&oacute;n</option>

                                <? while ($rs_per_mat = mysql_fetch_assoc($perMat)) { ?>

                                <option value="<? echo $rs_per_mat['id']; ?>"><?php echo $rs_per_mat['codigo'].'-'.$rs_per_mat['nombre_material']; ?></option>

                                <? } ?>

                            </select>

                        </td>

                        <td style="display:none;">

                            <a href="javascript:" id="btn_agregar_material">Agregar Material</a>

                        </td>

                    </tr>

                    <tr>

                        <td>Cantidad Existente:</td>

                        <td><input type="text" name="cantidadInv" id="cantidadInv" value="0" readonly/></td>

                        

                        <td>Cantidad Solicitada:</td>

                        <td><input name="cantidad" type="text" id="cantidad" class="required solicitud" alt="zip"/></td>

                        

                    </tr>

                    <tr>

                        <td>Costo:</td>

                        <td><input type="text" name="costoInv" id="costoInv" value="0" readonly alt="signed-decimal"/></td>

                        

                        <td>Costo Solicitado:</td>

                        <td>

                            <input name="costo_solicitado" type="text" id="costo_solicitado" class="required solicitud" readonly alt="integer"/>

                        </td>

                    </tr>

                    

                    <tr>

                        <td>Descripci&oacute;n:</td>

                        <td><textarea id="descripcion" name="descripcion" cols="50" rows="3" style="width: 203px;" disabled="disabled"></textarea></td>

                       	<td>Observaci&oacute;n:</td>

                        <td><textarea id="observacion" name="observacion" cols="50" rows="3" style="width: 203px;"></textarea></td>

                    </tr>

                   

                </tbody>

                <tfoot>

                    <tr>

                        <td colspan="2">

                            <input name="agregar" type="submit" id="agregar" value="Agregar" class="btn_table"/>

                        </td>

                        

                        <td colspan="2"><div class="alert-box"></div></td>

                    </tr>

                </tfoot>

            </table>

</form>



<div id="jqxgrid2" style="margin-top:20px; margin-bottom:20px;"></div>



<div style="background:#ECECEC; margin-bottom:15px;border:1px solid #CCC;padding:10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px; width:96%; margin-top:20px;">

    <input name="cancelar" type="button" id="cancelar" value="Cerrar" onclick="fn_cerrar('');" class="btn_table"/>                   

</div>





<link rel="stylesheet" href="/js/chosen/chosen.css">

<script src="/js/chosen/chosen.jquery.js" type="text/javascript"></script> 



<script type="text/javascript">

$(document).ready(function () {

		window.localStorage.removeItem("idParent");

		$(".chosen-select").chosen({width:"220px"}); 

		$('input').setMask();	

		$(".btn_table").jqxButton({ theme: theme });
		   

		/* Agregar Items */

		$("#material").change(function(){

			$(".solicitud").val('');

			var idMaterial = $(this).val();

			$.getJSON('/ajax/listMaterial.php',{id:idMaterial}, function (data) {

				$.each(data, function (i, v) {					

					$('#'+i).val(v);

				});

			});

		});

		

		

		$('#cantidad').keyup(function(){	//Validad la cantidad con respecto a la disponibilidad del inventario	

			if($(this).val() != ''){

				var cantidad = parseInt($(this).val());
				var cantidadInv = parseInt($('#cantidadInv').val());
				var solicitarCompra = 0;


				/*if(cantidad <= cantidadInv){
					$('.alert-box').removeClass('warning');
					$('.alert-box').addClass('success');
					$('.alert-box').html('<span>OK:</span>&nbsp;En existencia.');
					$('.alert-box').slideDown('slow');
					$('#cantidadPendiente').val(0);
				}else{
					solicitarCompra = cantidad - cantidadInv;
					$('.alert-box').removeClass('success');
					$('.alert-box').addClass('warning');
					$('.alert-box').html('<span>Advertencia:</span>&nbsp;No hay existencia.<br/>Solicitud Compra:'+solicitarCompra);
					$('.alert-box').slideDown('slow');
					$('#cantidadPendiente').val(solicitarCompra);
				}*/				
				
				var costoInv = parseFloat($('#costoInv').val());			
				var costo_solicitado =  parseFloat(costoInv * cantidad);		
				$('#costo_solicitado').val(costo_solicitado);
				$('#costo_solicitado').setMask();

			/*}else{
				$('#costo_solicitado').val('');
				$('.alert-box').removeClass('success');
				$('.alert-box').addClass('warning');
				$('.alert-box').html('<span>Advertencia:</span>&nbsp;Debe ingresar una cantidad');
				$('.alert-box').slideDown('slow');*/
			}			

		});

		

		/* Validacion del formulario agregar materiales */

		$("#form_material").validate({

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

					var respuesta = confirm('\xBFRealmente desea agregar este material?')

					if (respuesta)

						form.submit();		

			}

		});

		/*--------------------------------------------------------------------------------------*/

        var source =
		{
                 datatype: "json",
                 datafields: [
					 { name: 'id', type: 'number'},
					 { name: 'codigo', type: 'string'},
					 { name: 'name_material', type: 'string'},
					 { name: 'cantidad', type: 'number'},
					 { name: 'costo', type: 'number'},	
					 { name: 'aprobado', type: 'string'},	
					 { name: 'observacion', type: 'string'},			
					 { name: 'acciones', type: 'string'},
					 
					 { name: 'ct_materiales', type: 'string'},
					 { name: 'ct_compra', type: 'string'},
					 
					 { name: 'existencia', type: 'number'},
					 { name: 'cantidadc', type: 'number'},
					 { name: 'costo2', type: 'number'},
					 { name: 'iva2', type: 'string'},
					 { name: 'orden_compra2', type: 'string'},
					 { name: 'cantidade', type: 'number'}						 
                ],
				updaterow: function (rowid, rowdata, commit) {
                    // synchronize with the server - send update command
                    // call commit with parameter true if the synchronization with the server is successful 
                    // and with parameter false if the synchronization failder.
                    commit(true);
                },
				cache: true,
			    url: 'ajax_list_materiales.php?id=<?=(int)$_POST['ide_per']?>',
				root: 'Rows',
				sortcolumn: 'id',
                sortdirection: 'desc',
				filter: function()
				{
					// update the grid and send a request to the server.
					$("#jqxgrid2").jqxGrid('updatebounddata', 'filter');
				},
				sort: function()
				{// update the grid and send a request to the server.
					$("#jqxgrid2").jqxGrid('updatebounddata', 'sort');
				},
				root: 'Rows',
				beforeprocessing: function(data)
				{		
					if (data != null){
						source.totalrecords = data[0].TotalRows;					
					}
				}
		};		

		var dataadapter = new $.jqx.dataAdapter(source, {
				loadError: function(xhr, status, error)
				{
					alert(error);
				}
		});

      	var dataadapter = new $.jqx.dataAdapter(source);

        $("#jqxgrid2").jqxGrid({
				width: '100%',
				height: 450,
                source: dataadapter,
                showfilterrow: true,
				editable: true,
                pageable: true,
                filterable: true,
                theme: theme,
				sortable: true,
                columnsresize: true,
				virtualmode: true,
				autorowheight: true,
                //autoheight: true,
				enabletooltips: false,
                selectionmode: 'multiplecellsadvanced',
				rendergridrows: function(obj)
				{
					 return obj.data;      
				},                
                columns: [
				  <?php 
				  	if($noaprobado): 
				  		$text = '<a href="javascript:" class="aprobarALL" onclick="fn_aprobar_allitems('.$id_despacho.');" style="z-index:1000;"><img src="https://cdn2.iconfinder.com/data/icons/color-svg-vector-icons-part-2/512/ok_check_yes_tick_accept_success-16.png" /></a>';
					else:
						$text = '-';
				  	endif; 
				  ?>
				  { text: '<?=$text?>', 
				  	datafield: 'acciones', filtertype: 'none', width:60, cellsalign: 'center', editable: false, sortable:false },
                  { text: 'Item', datafield: 'id', filtertype: 'textbox', hidden: true , filtercondition: 'equal',  columntype: 'textbox', editable: false },
				  { text: 'C&oacute;digo', datafield: 'codigo', filtertype: 'textbox', filtercondition: 'equal',  columntype: 'textbox', editable: false, width:60 },
                  { text: 'Material', datafield: 'name_material',  filtertype: 'textbox', filtercondition: 'starts_with', editable: false },
				  { text: 'Cant.', datafield: 'cantidad', filtertype: 'none', cellsalign: 'right',editable: false },
				  { text: 'Costo', datafield: 'costo', columntype: 'numberinput', filtertype: 'none', cellsalign: 'right',editable: false,cellsformat: 'c2'},
				  { text: 'Observaci&oacute;n', datafield: 'observacion', filtertype: 'none',cellsalign: 'right',editable: false, width:80},
                  { text: 'Estado', datafield: 'aprobado', filtertype: 'none', cellsalign: 'center', editable: false, width:60 },
				  
				 
				  { text: 'Existencia', datafield: 'existencia', filtertype: 'none', cellsalign: 'center', editable: false, width:60 },
				  
				  //campos add de materiales
				  { text: 'Cant. Comprada', datafield: 'cantidadc', align: 'right', cellsalign: 'right', sortable:false,columntype: 'numberinput', width:80, filtertype: 'none', editable: true,
					  validation: function (cell, value) {
						  if (value < 0) {
							  return { result: false, message: "La cantidad Comprada no puede ser negativa" };
						  }
						  return true;
					  },
					  createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ decimalDigits: 0});  
                      }
				  },
				  
				  { text: 'Costo Unidad', datafield: 'costo2', align: 'right', cellsalign: 'right', cellsformat: 'c2', columntype: 'numberinput', editable: true, sortable:false, filtertype: 'none',width:90,
                      validation: function (cell, value) {
                          if (value < 0) {
                              return { result: false, message: "Precio no debe ser negativo" };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ decimalDigits: 0 });
                      }
                  },
				  
				  { text: 'IVA', datafield: 'iva2', filtertype: 'none', cellsalign: 'right', editable: true, columntype: 'numberinput',width:40,
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ decimalDigits: 2, digits: 3 });
                      }
				  },
				  
				  { text: 'OC', datafield: 'orden_compra2', filtertype: 'none', cellsalign: 'right', editable: true, sortable:false, width:50 },		 
				  
				  { text: 'Cant. Entregada', datafield: 'cantidade', width: 70, align: 'right', cellsalign: 'right', columntype: 'numberinput', filtertype: 'none',
                      validation: function (cell, value) {
                          if (value <= 0 ) {
                              return { result: false, message: "Cantidad entregada no debe ser menor a 0" };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ decimalDigits: 0 });
                      }
                  },
				  { text: 'CT Materiales', datafield: 'ct_materiales', filtertype: 'none', cellsalign: 'center', editable: false, width:70, cellsformat: 'c2' },
				  { text: 'CT Compra', datafield: 'ct_compra', filtertype: 'none', cellsalign: 'center', editable: false, width:70, cellsformat: 'c2' }]
				  
            });			

            $("#jqxgrid2").on('cellendedit', function (event) {
				
					var args = event.args;
					var id = $("#jqxgrid2").jqxGrid('getcellvalue',args.rowindex, 'id');
					var estado = true;
					var operacion = true;
					var sumaTotal,totalMaterial = 0;
					var total = 0;
					
					var existencia = $("#jqxgrid2").jqxGrid('getcellvalue',args.rowindex, 'existencia');
					var cantidadc = $("#jqxgrid2").jqxGrid('getcellvalue',args.rowindex, 'cantidadc');
					var cantidade = $("#jqxgrid2").jqxGrid('getcellvalue',args.rowindex, 'cantidade');
					
					var costo = $("#jqxgrid2").jqxGrid('getcellvalue',args.rowindex, 'costo');		
					var costo2 = $("#jqxgrid2").jqxGrid('getcellvalue',args.rowindex, 'costo2');//costo unidad	
					
					if(args.datafield == 'cantidade'){//cantidad entregada
						cantidade = args.value;
						total = existencia + cantidadc;
						
						if(args.value > total){
							estado = false;
						}					
					}else if(args.datafield == 'cantidadc'){//cantidad comprada
						cantidadc = args.value;
						operacion = true;
					}else{
						operacion = false;
					}
					
					if(estado){
						
						var totalMateria,totalComprado,sumaTotal = 0;
						
						if(operacion){		
										
							if(existencia > 0){
								if(cantidade <= existencia){							
									totalMaterial = cantidade * costo;						
								}else if(cantidade > existencia && cantidade <= total){
									totalMaterial = existencia * costo;
									totalComprado =  (cantidade - existencia) * costo2;
								}else{
									alert('No ahi existencia para su solicitud');
								}
							}else{
								totalComprado = cantidadc * costo2;
								totalMaterial = 0;
								console.log(cantidadc+'*'+costo2)
							}
							
							sumaTotal = totalComprado + totalMaterial;							
													
							$("#jqxgrid2").jqxGrid('setcellvalue',args.rowindex, 'ct_materiales', totalMaterial);
							$("#jqxgrid2").jqxGrid('setcellvalue',args.rowindex, 'ct_compra', sumaTotal);
						}
						
						$.ajax({ 
							type: 'POST',
							dataType: 'json',
							url: 'ajax_add_mercancia_item.php',
							data: {
									  id_item: id,
									  id_despacho: <?=$id_despacho?>,									
									  campo: args.datafield,
									  valor: args.value,
									  tmateriales: totalMaterial,
									  tcompras: sumaTotal
							}
						});
						
					}else{
						setTimeout(function(){
							$("#jqxgrid2").jqxGrid('setcellvalue',args.rowindex, 'cantidade', args.oldvalue);
						},500);
						
						alert('Error: no se logro guadar los cambio. \n La cantidad entregada no debe ser mayor a la existencia mas la cantidad comprada');						
					}
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



function fn_agregar_material(){ 

	var str = $("#form_material").serialize();  

	$.ajax({

		url: '/solicitud_despacho/solicitud_despacho/ajax_agregar_material.php',

		data: str,

		type: 'post',

		success: function(data){

			if(data != "") {

				alert(data);

			}else{ 

				$('.alert-box').slideUp();

				$('#form_material').reset();

				$("#jqxgrid2").jqxGrid('updatebounddata');

			}

		}

	});

};



jQuery.fn.reset = function () {

	  $(this).each (function() { this.reset(); });

}



</script>      





