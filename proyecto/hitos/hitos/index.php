<?php  include "../../restrinccion.php";  ?>

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

	require_once "../../restrinccion.php";

	//session_start(); 

	define('URL_SECCION', URL_HITOS);

	define('SECCION', HITOS); ?>

	<?php require_once "../../tpl_top.php"; 

		$query = "SELECT COUNT(*) AS Total FROM hitos" ;

		$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

		$rows = mysql_fetch_assoc($result);

	?>

     <script type="text/javascript">

        $(document).ready(function () {

            var source =

            {

                 datatype: "json",

                 datafields: [

					 { name: 'id', type: 'integer'},

					 { name: 'id_proyecto', type: 'string'},

					 { name: 'nombre', type: 'string'},

					 { name: 'estado', type: 'string'},

					 { name: 'fecha_inicio', type: 'date'},

					 { name: 'fecha_final', type: 'date'},
					 
					 { name: 'dias_hito', type: 'string'},

					 { name: 'fecha_inicio_ejecucion', type: 'date'},

					 { name: 'fecha_ejecutado', type: 'date'},

					 { name: 'fecha_informe', type: 'date'},

					 { name: 'fecha_liquidacion', type: 'date'},

					 { name: 'fecha_facturacion', type: 'date'},

					 { name: 'fecha_facturado', type: 'date'},					

					 { name: 'descripcion', type: 'string'},

					 { name: 'ot_cliente', type: 'string'}, /*FGR*/

					 { name: 'po', type: 'string'}, /*FGR*/

					 { name: 'gr', type: 'string'}, /*FGR*/

					 { name: 'factura', type: 'string'}, /*JOB*/

					 { name: 'po2', type: 'string'}, /*FGR*/

					 { name: 'gr2', type: 'string'}, /*FGR*/

					 { name: 'factura2', type: 'string'}, /*JOB*/
					 
					 { name: 'valor_cotizado_hito', type: 'string'}, /*FGR*/

					 { name: 'acciones', type: 'string'}

                ],

				cache: false,

			    url: 'ajax_data.php',

				sortcolumn: 'id',

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

				});



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

				rendergridrows: function(obj)

				{

					 return obj.data;      

				},              

                columns: [ 

                  { text: 'ID', datafield: 'id',  filtertype: 'textbox', filtercondition: 'equal',  width: 40,  columntype: 'textbox'  },

                  { text: 'Proyecto', datafield: 'id_proyecto', filtertype: 'textbox', width: 60 },

                  { text: 'Nombre Hito', datafield: 'nombre', filtertype: 'textbox', filtercondition: 'starts_with', width: 120 },

				  { text: 'Estado', datafield: 'estado', filtertype: 'checkedlist', filtercondition: 'equal', width: 70, filteritems: ['PENDIENTE', 'EN EJECUCIÓN', 'EJECUTADO', 'LIQUIDADO', 'INFORME ENVIADO', 'EN FACTURACIÓN', 'FACTURADO', 'CANCELADO', 'DUPLICADO', 'PAGADO', 'ADMIN']  },

                  { text: 'Fecha Inicio', datafield: 'fecha_inicio', filtertype: 'date', filtercondition: 'equal', width: 80, cellsformat: 'yyyy-MM-dd' },

                  { text: 'Fecha Final', datafield: 'fecha_final', filtertype: 'date', filtercondition: 'equal', width: 80, cellsformat: 'yyyy-MM-dd' },
				  
				  { text: 'Días Hitos', datafield: 'dias_hito',  filtertype: 'textbox', filtercondition: 'equal',  width: 40,  columntype: 'textbox'  },

				  { text: 'Fecha Ini. Ejecución', datafield: 'fecha_inicio_ejecucion', filtertype: 'date', filtercondition: 'equal', width: 80, cellsformat: 'yyyy-MM-dd' },

				  { text: 'Fecha Ejecutado', datafield: 'fecha_ejecutado', filtertype: 'date', filtercondition: 'equal', width: 80, cellsformat: 'yyyy-MM-dd' },

				  { text: 'Fecha Informe', datafield: 'fecha_informe', filtertype: 'date', filtercondition: 'equal', width: 80, cellsformat: 'yyyy-MM-dd' },

				  { text: 'Fecha Liquidación', datafield: 'fecha_liquidacion', filtertype: 'date', filtercondition: 'equal', width: 100, cellsformat: 'yyyy-MM-dd'  },

				  { text: 'Fecha Facturación', datafield: 'fecha_facturacion', filtertype: 'date', filtercondition: 'equal', width: 80, cellsformat: 'yyyy-MM-dd' },

				  { text: 'Fecha Facturado', datafield: 'fecha_facturado', filtertype: 'date', filtercondition: 'equal', width: 80, cellsformat: 'yyyy-MM-dd' },

				  { text: 'Descripción', datafield: 'descripcion', filtertype: 'textbox',  cellsalign: 'left'},

				  { text: 'OT Cliente', datafield: 'ot_cliente', filtertype: 'textbox',  cellsalign: 'left'}, /*FGR*/

				  { text: 'PO', datafield: 'po', filtertype: 'textbox',  cellsalign: 'left', width: 40}, /*FGR*/

				  { text: 'GR', datafield: 'gr', filtertype: 'textbox',  cellsalign: 'left', width: 40}, /*FGR*/

				  { text: 'Factura', datafield: 'factura', filtertype: 'textbox',  cellsalign: 'left', width: 40}, /*JOB*/

				  { text: 'PO2', datafield: 'po2', filtertype: 'textbox',  cellsalign: 'left', width: 40}, /*FGR*/

				  { text: 'GR2', datafield: 'gr2', filtertype: 'textbox',  cellsalign: 'left', width: 40}, /*FGR*/

				  { text: 'Factura2', datafield: 'factura2', filtertype: 'textbox',  cellsalign: 'left', width: 40}, /*JOB*/
				  
				  { text: 'Valor Cotizado Hito', datafield: 'valor_cotizado_hito', filtertype: 'textbox',  cellsalign: 'left', width: 40}, /*FGR*/

				  { text: '-', datafield: 'acciones', filtertype: 'none', width:40, pinned: true}

                ]

            });

            $('#clearfilteringbutton').click(function () {

                $("#jqxgrid").jqxGrid('clearfilters');

            });

			$("#excelExport").click(function () {

					$('#jqxgrid').jqxGrid('hidecolumn', 'acciones'); 

				setTimeout(function(){    

                	$("#jqxgrid").jqxGrid('exportdata', 'xls', 'Hitos');   

				},1000);

				setTimeout(function(){

					$('#jqxgrid').jqxGrid('showcolumn', 'acciones');  

				},3000);

				

            });

			

			$('#excelExport2').click(function(){

				window.open("/hitos/hitos/export_excel.php");

			});

			

			//$('#grid').jqxGrid({ pagesizeoptions: ['10', '20', '30']}); 

        });

    </script>

    

    

    	<div id="cuerpo">

            <h1>HITOS</h1>

            <div style="background:#ECECEC; margin-bottom:15px;border:1px solid #CCC;padding:10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px; width:96%; margin-top:20px;">

             <?php if($_SESSION['perfil'] != 13):?>   

             	<input value="Agregar Hito" type="button" onclick="javascript: fn_mostrar_frm_agregar();" class="btn_table" />

             <?php endif; ?>

             <input value="Reiniciar Filtros" id="clearfilteringbutton" type="button" class="btn_table" />

             <input type="button" value="Exportar a Excel" id='excelExport' class="btn_table" />

             

             <input type="button" value="Exportar Todo a Excel" id='excelExport2' class="btn_table" />

            </div>

            <div id="jqxgrid"></div>

            <div id="div_oculto" style="display: none;"></div>

            <p align="right">Desarrollado por: <strong>Ingecall SAS</strong><br /><a href="http://www.ingecall.com" target="_blank">www.ingecall.com</a></p>

        </div>

    <?php require_once "../../tpl_bottom.php"; ?>



<!--    </body>

</html>-->