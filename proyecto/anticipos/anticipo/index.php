<?php  

	include "../../restrinccion.php";  

	include "../../conexion.php";

	$resultado = mysql_query("SELECT * FROM centros_costos WHERE id = 1 OR id = 2 OR id = 3 OR id = 5 OR id = 6  OR id = 4") or die(mysql_error());

	$total = mysql_num_rows($resultado);

	

	if($total > 0):

		while($row = mysql_fetch_assoc($resultado)):

			$list .= "'".$row['id'].'.'.utf8_encode($row['nombre'])."',";

		endwhile;

	endif;	

	



?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Documento sin t?tulo</title>

        <script language="javascript" type="text/javascript" src="../extras/js/jquery-1.3.2.min.js"></script>

        <script language="javascript" type="text/javascript" src="../extras/js/jquery.blockUI.js"></script>

        <script language="javascript" type="text/javascript" src="../extras/js/jquery.validate.1.5.2.js"></script>

        <script language="javascript" type="text/javascript" src="../extras/js/mask.js"></script>

        <link href="../extras/css/estilo.css" rel="stylesheet" type="text/css" />

        <link href="../extras/php/PHPPaging.lib.css" rel="stylesheet" type="text/css" />

        <script language="javascript" type="text/javascript" src="index.js"></script>

    </head>

    <body>-->

    <?php require_once "../../config.php"; 

		 

	define('URL_SECCION', URL_ANTICIPOS); 

	define('SECCION', ANTICIPO); ?>   

	<?php require_once "../../tpl_top.php"; 

		$query = "SELECT COUNT(*) AS Total FROM anticipo" ;

		$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

		$rows = mysql_fetch_assoc($result);

	?>

    

    <script src="/js/jquery.printarea.js" type="text/javascript"></script> 

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    

	<link href="/excel/css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="/excel/css/excel.css">

    <style>
		.jqx-grid-content{ z-index:10; }
	</style>

    <link rel="stylesheet" href="/js/chosen/chosen.css">

	<script src="/js/chosen/chosen.jquery.js" type="text/javascript"></script> 

    

   

       

    <script type="text/javascript">

    $(document).ready(function () {   

			

			var url = "/ajax/ajax_list_hitos.php";

			// prepare the data

			var source =

			{

				datatype: "json",

				datafields: [

					{ name: 'id' },

					{ name: 'orden' }

				],

				url: url,

				async: false

			};

			var dataAdapter = new $.jqx.dataAdapter(source);

			// Create a jqxDropDownList

			$("#jqxWidget").jqxDropDownList({

				selectedIndex: 0, source: dataAdapter, displayMember: "orden", valueMember: "id", width: 550, height: 25

			});

			// subscribe to the select event.

			$("#jqxWidget").on('select', function (event) {

				if (event.args) {

					var item = event.args.item;

					if (item) {

						var valueelement = $("<div></div>");

						valueelement.text("Value: " + item.value);

						var labelelement = $("<div></div>");

						labelelement.text("Label: " + item.label);

						$("#selectionlog").children().remove();

						$("#selectionlog").append(labelelement);

						$("#selectionlog").append(valueelement);

					}

				}

			});

	

            var source =

            {

                 datatype: "json",

                 datafields: [

					 { name: 's.id', type: 'number'},

					 { name: 's.estado', type: 'string'},

					 { name: 's.fecha', type: 'date'},

					 { name: 's.prioridad', type: 'string'},

					 { name: 's.id_ordentrabajo', type: 'string'},

					 { name: 's.nombre_responsable', type: 'string'},

					 { name: 's.cedula_responsable', type: 'number'},

					 { name: 's.id_centroscostos', type: 'string'},

					 { name: 's.v_cotizado', type: 'string'},

					 { name: 's.total_anticipo', type: 'string'},

					 { name: 's.beneficiario', type: 'string'},

					 { name: 's.num_cuenta', type: 'string'},

					 { name: 's.fecha_creacion', type: 'date'},
					 
					 { name: 's.fecha_aprobado', type: 'date'},

					 { name: 's.valor_giro', type: 'string'},

					 { name: 'prioridad_text', type: 'string'},

					 { name: 'acciones', type: 'string'}					 

                ],

				cache: false,

				async: false,

			    url: 'ajax_data.php',

				root: 'Rows',

				sortcolumn: 's.id',

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

			

			

            var ordersSource =

            {

				datatype: "json",

                datafields: [

					 { name: 'i.id', type: 'number'},

					 { name: 'id_hitos', type: 'number'},

					 { name: 'acpm', type: 'string'},

					 { name: 'valor_transporte', type: 'string'},

					 { name: 'toes', type: 'string'},	
					 
					 { name: 'anticipos_anteriores', type: 'string'},		
					 
					 { name: 'valor_cotizado_hito', type: 'string'},

					 { name: 'acciones', type: 'string'}					 

                ],

				cache: false, 	

				async: false,

			    url: 'ajax_list_items.php',

				root: 'Rows',

                sortcolumn: 'i.id',

                sortdirection: 'desc'

            };

            var ordersDataAdapter = new $.jqx.dataAdapter(ordersSource, { autoBind: false });

			

            orders = ordersDataAdapter.records;

            var nestedGrids = new Array();

            // create nested grid.

            var initrowdetails = function (index, parentElement, gridElement, record) {

				

                var id = record.uid.toString();

				var id_anticipo = record['s.id'];
				
				if(id_anticipo[0]=='<')
					id_anticipo = $(id_anticipo).text(); //FGR
				

                var grid = $($(parentElement).children()[0]);

               

			    nestedGrids[index] = grid;

				

                var ordersSource =

				{

					datatype: "json",

					datafields: [

						 { name: 'i.id', type: 'number'},

						 { name: 'idHitos', type: 'number'},

						 { name: 'id_hitos', type: 'number'},

						 { name: 'acpm', type: 'string'},

						 { name: 'valor_transporte', type: 'string'},

						 { name: 'toes', type: 'string'},	
						 
						 { name: 'anticipos_anteriores', type: 'string'},	
						 
						 { name: 'valor_cotizado_hito', type: 'string'},		

						 { name: 'acciones', type: 'string'}						 

					],

					cache: false,

					url: 'ajax_list_items.php?id='+id_anticipo,

					root: 'Rows',

					sortcolumn: 'i.id',

					sortdirection: 'desc'

				};

				

                var nestedGridAdapter = new $.jqx.dataAdapter(ordersSource, { autoBind: false });

                if (grid != null) { 

                    grid.jqxGrid({

                        source: nestedGridAdapter, width: '75%', height: 200,

                        columns: [

						 // { text: '-', datafield: 'acciones', filtertype: 'none', width:40, cellsalign: 'center', editable: false },

						  { text: 'ID Hito', datafield: 'idHitos', filtertype: 'textbox', filtercondition: 'equal', width: 60,  columntype: 'textbox', editable: false },

						  { text: 'Hito', datafield: 'id_hitos', columntype: 'dropdownlist', filtertype: 'textbox', editable: false },

						  { text: 'Valor ACPM', datafield: 'acpm', filtertype: 'none', width: 130, cellsalign: 'right' },

						  { text: 'Valor Transporte', datafield: 'valor_transporte', filtertype: 'none', width:130, cellsalign: 'right'},

						  { text: 'TOES', datafield: 'toes', filtertype: 'none', width: 130, cellsalign: 'right' },
						  
						  { text: 'Anticipos Anteriores', datafield: 'anticipos_anteriores', cellsalign: 'right',  filtertype: 'none', width: 150 },
						  { text: 'Valor Cotizado', datafield: 'valor_cotizado_hito', cellsalign: 'right',  filtertype: 'none', width: 150 }

						]

                    });

                }

            }

			

           // var dataadapter = new $.jqx.dataAdapter(source);



            $("#jqxgrid").jqxGrid(

            {

                width: '100%',

				height: 500,

                source: dataadapter,

                showfilterrow: true,

                pageable: true,

                filterable: true,

                theme: theme,

				sortable: true,

                columnsresize: true,

				virtualmode: true,	

				pagesize: 20,

				pagesizeoptions: ['<?=$rows['Total']?>', 10, 20, 50, 100, 150, 250, 500],

				

				rowdetails: true,

				initrowdetails: initrowdetails,

                rowdetailstemplate: { rowdetails: "<div id='grid' style='margin: 10px;'></div>", rowdetailsheight: 220, rowdetailshidden: true },

				

				rendergridrows: function(obj)

				{

					 return obj.data;      

				},                  

                columns: [

				  { text: 'ID', datafield: 's.id', filtertype: 'textbox', filtercondition: 'equal',  width: 40,  columntype: 'textbox' },

                  { text: 'Acciones', datafield: 'acciones', filtertype: 'none', width:100, pinned: true, cellsalign: 'left' },

				  { text: 'Estado', datafield: 's.estado', filtertype: 'checkedlist', filtercondition: 'equal', width: 80,  filteritems: ['APROBADO', 'NO REVISADO', 'RECHAZADO', 'REVISADO'] },

                  { text: 'Fecha', datafield: 's.fecha', filtertype: 'date', filtercondition: 'equal', width: 70, cellsformat: 'yyyy-MM-dd' },

                  { text: 'Prioridad', datafield: 's.prioridad', filtertype: 'checkedlist', filtercondition: 'equal', width: 50, filteritems: ['CRITICA', 'ALTA', 'MEDIA', 'BAJA', 'VINCULADO', 'GIRADO', 'RETORNO'] },

                  { text: 'Prioridades', datafield: 'prioridad_text', hidden: true},	

				  { text: 'OT', datafield: 's.id_ordentrabajo', filtertype: 'textbox', width: 70 },
				  
				  { text: 'Nombre Responsable', datafield: 's.nombre_responsable', filtertype: 'textbox',  filtercondition: 'starts_with', width: 140 },

				  { text: 'Cedula Responsable', datafield: 's.cedula_responsable', filtertype: 'textbox',  filtercondition: 'starts_with', width:90},

				  { text: 'Centro Costo', datafield: 's.id_centroscostos', filtertype: 'checkedlist', width:100, filteritems: [<?=$list?>] },

				  { text: 'Valor Cotizado', datafield: 's.v_cotizado', filtertype: 'none', width:80},

				  { text: 'Total Anticipo', datafield: 's.total_anticipo', filtertype: 'none', width:80},

				  { text: 'Beneficiario', datafield: 's.beneficiario', filtertype: 'textbox',  filtercondition: 'starts_with'},

				  { text: 'Banco', datafield: 's.num_cuenta', filtertype: 'textbox',  filtercondition: 'starts_with'},

				  { text: 'Valor Giro', datafield: 's.valor_giro', hidden: true},	

               	  { text: 'Fecha Creado', datafield: 's.fecha_creacion', filtertype: 'date', filtercondition: 'equal', width: 110, cellsformat: 'yyyy-MM-dd HH:mm:ss' },
				  
				  { text: 'Fecha Aprobado', datafield: 's.fecha_aprobado', filtertype: 'date', filtercondition: 'equal', width: 110, cellsformat: 'yyyy-MM-dd HH:mm:ss' }



			    ]

            });

			$(".btn_table").jqxButton({ theme: theme });

            $('#clearfilteringbutton').click(function () {

                $("#jqxgrid").jqxGrid('clearfilters');

            });

			$("#excelExport").click(function () {

					$('#jqxgrid').jqxGrid('hidecolumn', 'acciones'); 

					$('#jqxgrid').jqxGrid('showcolumn', 's.valor_giro');  

				setTimeout(function(){    

                	$("#jqxgrid").jqxGrid('exportdata', 'xls', 'Anticipos_<?=date('m-d-Y')?>');   

				},1000);

				setTimeout(function(){

					$('#jqxgrid').jqxGrid('showcolumn', 'acciones');

					/*$('#jqxgrid').jqxGrid('hidecolumn', 'prioridad_text');  

					$('#jqxgrid').jqxGrid('hidecolumn', 's.valor_giro'); */  

				},3000);

				

            });

			

			// builds and applies the filter.

            var applyFilter = function (datafield) {

                //$("#jqxgrid").jqxGrid('clearfilters');

               

				 var filtergroup = new $.jqx.filter();

				 var filter_or_operator = 1;

				 var filtervalue = datafield;

				 var filtercondition = 'equal';

				 var filter1 = filtergroup.createfilter('numericfilter', filtervalue, filtercondition);

				

				 filtergroup.addfilter(filter_or_operator, filter1);

				 // add the filters.

				 $("#jqxgrid").jqxGrid('addfilter', 's.total_anticipo', filtergroup);

				 // apply the filters.

				 $("#jqxgrid").jqxGrid('applyfilters');

            }

			

			

			$('#jqxWidget').on('change', function (event) { 

                var dataField = $("#jqxWidget").jqxDropDownList('getSelectedItem').value;

                applyFilter(dataField);

            });

			

			$('#excelExport2').click(function(){

				window.open("/anticipos/anticipo/export_excel.php");

			});
			
			$('#excelExport3').click(function(){

				window.open("/anticipos/anticipo/export_excel_all.php");

			});

			

        });

    </script>

    	

        

    

    	<div id="cuerpo">

            <h1>ANTICIPOS</h1>          

            <div style="background:#ECECEC; margin-bottom:15px;border:1px solid #CCC;padding:10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px; width:96%; margin-top:20px;">

                 <input value="Agregar Anticipo" type="button" id="btn_add_anticipo" onclick="javascript: fn_mostrar_frm_agregar();" class="btn_table"/>

                 <input type="button" value="Importar de Excel" onclick="fn_importar_excel()" class="btn_table" />

                 <input type="button" value="Exportar a Excel" id='excelExport' class="btn_table" /> 

                 <input type="button" value="Exportar a Excel Anticipos e Hitos" id="excelExport2" class="btn_table" />
                 
                 <input type="button" value="Exportar a Excel Todos Anticipos" id="excelExport3" class="btn_table" />                  

                 <input value="Reiniciar Filtros" id="clearfilteringbutton" type="button" class="btn_table" />

                 <br />

                 <h3>Filtro de Hitos:</h3>

                 <div id="jqxWidget"></div>

            </div>

             

            <div id="jqxgrid"></div>

           

            <div id="div_oculto" style="display: none;"></div>

            

            <p align="right">Desarrollado por: <strong>Ingecall SAS</strong><br /><a href="http://www.ingecall.com" target="_blank">www.ingecall.com</a></p>

        </div>

    <?php require_once "../../tpl_bottom.php"; ?>

    <!--</body>

</html>-->