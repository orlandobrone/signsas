<? header('Content-type: text/html; charset=iso-8859-1');

	session_start();

	include "../../conexion.php";

	#Include the connect.php file

	#Connect to the database

	//connection String	

	// get data and store in a json array

	

	$sqlfgr = "select opcion as region from opciones_perfiles where id_perfil = ".$_SESSION['perfil']." and opcion > 100 order by id asc";

    $paifgr = mysql_query($sqlfgr);

	$filtroRegion = '';

	$filtroRegion2 = '';

	$filtroRegion3 = '';

	$cont=0;

	while($usuariofgr=mysql_fetch_assoc($paifgr)){

		if($cont==0){

			$filtroRegion .= ' (';

			$filtroRegion3 .= ' (';

		}

		$filtroRegion .= ' s.id_regional='.substr($usuariofgr['region'], 2).' or';

		$filtroRegion3 .= ' o.id_regional='.substr($usuariofgr['region'], 2).' or';

		$cont++;

	}

	if($cont>0){

		$filtroRegion = substr($filtroRegion, 0, -2).') and';

		$filtroRegion3 = substr($filtroRegion3, 0, -2).') and';

		$filtroRegion2 = ' and'.$filtroRegion;

	}

	

	if($filtroRegion == '')

		$filtroRegion2 = ' and';



	$pagenum = $_GET['pagenum'];

	$pagesize = $_GET['pagesize'];

	$start = $pagenum * $pagesize;

	$query = "SELECT SQL_CALC_FOUND_ROWS *, s.id AS ID, c.nombre AS centro_costo 

			  FROM anticipo AS s 

	          LEFT JOIN centros_costos AS c ON  s.id_centroscostos = c.id

			  WHERE ".$filtroRegion." s.publicado != 'draft' 

			  LIMIT $start, $pagesize ";

			  

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

	$sql = "SELECT FOUND_ROWS() AS `found_rows`;";

	$rows = mysql_query($sql);

	$rows = mysql_fetch_assoc($rows);

	$total_rows = $rows['found_rows'];

	$filterquery = "";

	

	// filter data.

	

	

	if (isset($_GET['filterscount']))

	{

		$filterscount = $_GET['filterscount'];

		

		if ($filterscount > 0)

		{

			$where = " WHERE ( ";

			$tmpdatafield = "";

			$tmpfilteroperator = "";

			for ($i=0; $i < $filterscount; $i++)

		    {

				

				$orden_trabajo = '';

				$hito = false;

				// get the filter's value.

				// get the filter's column.

				$filterdatafield = $_GET["filterdatafield" . $i];

				

				switch($_GET["filterdatafield" . $i]):

				

					case "s.estado":

						switch($_GET["filtervalue" . $i]):

							case "NO REVISADO":

								$estado = 0;

							break;

							case "APROBADO":

								$estado = 1;

							break;

							case "RECHAZADO":

								$estado = 2;

							break;

							case "REVISADO":

								$estado = 3;

							break;

						endswitch;

						

						$filtervalue = $estado;

						

					break;

					case "s.id_ordentrabajo";

						$sql4 = "SELECT o.id_proyecto AS idproyecto, a.id AS idanticipo FROM `orden_trabajo` AS o

								 RIGHT JOIN anticipo AS a ON o.id_proyecto = a.id_ordentrabajo

								 WHERE ".$filtroRegion3." o.orden_trabajo LIKE '%".strtoupper($_GET["filtervalue" . $i])."%'";

        				$pai4 = mysql_query($sql4); 

						$total_rows2 = mysql_num_rows($pai4);

						if($total_rows2 == 0){

							$data[] = array(

								'TotalRows' => $total_rows2,

								'Rows' => NULL

							);

							echo json_encode($data);

							exit;

						}

						$filtervalue = '';

						$i2=0;

						while($rs_pai4 = mysql_fetch_assoc($pai4)):

							if($i2==0):

								$orden_trabajo .= ' AND s.id = '.$rs_pai4['idanticipo'];

								$i2++;

							else:

								$orden_trabajo .= ' OR s.id = '.$rs_pai4['idanticipo'];

							endif;

						endwhile;

					break;	

					case "s.total_anticipo":

						$sql4 = "SELECT DISTINCT(id_anticipo) AS idanticipo

								 FROM `items_anticipo` AS ia

								 RIGHT JOIN anticipo AS a ON ia.id_anticipo = a.id

								 WHERE ia.id_hitos = ".(int)$_GET["filtervalue" . $i];

        				$pai4 = mysql_query($sql4); 

						$filtervalue = '';

						$hito = true;

						$i2=0;

						while($rs_pai4 = mysql_fetch_assoc($pai4)):

							if($i2==0):

								$orden_trabajo .= ' AND s.id = '.$rs_pai4['idanticipo'];

								$i2++;

							else:

								$orden_trabajo .= ' OR s.id = '.$rs_pai4['idanticipo'];

							endif;

						endwhile;

					break;				

					default:

						$filtervalue = $_GET["filtervalue" . $i];

					break;

					

				endswitch;

				

			

				// get the filter's condition.

				$filtercondition = $_GET["filtercondition" . $i];				

				// get the filter's operator.

				$filteroperator = $_GET["filteroperator" . $i];

				

				if($_GET["filterdatafield" . $i] != 's.total_anticipo'):

				

					if ($tmpdatafield == "")

					{

						$tmpdatafield = $filterdatafield;			

					}

					else if ($tmpdatafield <> $filterdatafield)

					{

						$where .= ")AND(";

					}

					else if ($tmpdatafield == $filterdatafield)

					{

						if ($tmpfilteroperator == 0)

						{

							$where .= " AND ";

						}

						else $where .= " OR ";	

					}

				

					// build the "WHERE" clause depending on the filter's condition, value and datafield.

					switch($filtercondition)

					{

						case "NOT_EMPTY":

						case "NOT_NULL":

							$where .= " " . $filterdatafield . " NOT LIKE '" . "" ."'";

							break;

						case "EMPTY":

						case "NULL":

							$where .= " " . $filterdatafield . " LIKE '" . "" ."'";

							break;

						case "CONTAINS_CASE_SENSITIVE":

							$where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";

							break;

						case "CONTAINS":

							$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";

							break;

						case "DOES_NOT_CONTAIN_CASE_SENSITIVE":

							$where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";

							break;

						case "DOES_NOT_CONTAIN":

							$where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";

							break;

						case "EQUAL_CASE_SENSITIVE":

							$where .= " BINARY " . $filterdatafield . " = '" . $filtervalue ."'";

							break;

						case "EQUAL":

							$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";

							break;

						case "NOT_EQUAL_CASE_SENSITIVE":

							$where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue ."'";

							break;

						case "NOT_EQUAL":

							$where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";

							break;

						case "GREATER_THAN":

							$where .= " " . $filterdatafield . " > '" . $filtervalue ."'";

							break;

						case "LESS_THAN":

							$where .= " " . $filterdatafield . " < '" . $filtervalue ."'";

							break;

						case "GREATER_THAN_OR_EQUAL":

							$where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";

							break;

						case "LESS_THAN_OR_EQUAL":

							$where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";

							break;

						case "STARTS_WITH_CASE_SENSITIVE":

							$where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue ."%'";

							break;

						case "STARTS_WITH":

							$where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";

							break;

						case "ENDS_WITH_CASE_SENSITIVE":

							$where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue ."'";

							break;

						case "ENDS_WITH":

							$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";

							break;

					}

				

				endif;

								

				if ($i == $filterscount - 1)

				{

					$where .= ") ".$orden_trabajo;

				}

				

				$tmpfilteroperator = $filteroperator;

				$tmpdatafield = $filterdatafield;			

			}

			// build the query.

			if($hito == true):

				$where = ' WHERE 1 '.$orden_trabajo;

			endif;

			

			$query = "SELECT *, s.id AS ID, c.nombre AS centro_costo 

			  		  FROM anticipo AS s 

	          		  LEFT JOIN centros_costos AS c ON  s.id_centroscostos = c.id ".$where." ".$filtroRegion2."

					  s.publicado != 'draft'";

			$filterquery = $query;

			$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

			$sql = "SELECT FOUND_ROWS() AS `found_rows`;";

			$rows = mysql_query($sql);

			$rows = mysql_fetch_assoc($rows);

			$new_total_rows = $rows['found_rows'];		

			$query = "SELECT *, s.id AS ID, c.nombre AS centro_costo 

			  		  FROM anticipo AS s 

	          		  LEFT JOIN centros_costos AS c ON  s.id_centroscostos = c.id ".$where." ".$filtroRegion2." s.publicado != 'draft' 

					  LIMIT $start, $pagesize";		

			$total_rows = $new_total_rows;	

		}

	}

	

	if (isset($_GET['sortdatafield']))

	{

	

		$sortfield = $_GET['sortdatafield'];

		$sortorder = $_GET['sortorder'];

		

		if ($sortorder != '')

		{

			if ($_GET['filterscount'] == 0)

			{

				if ($sortorder == "desc")

				{

					$query = "SELECT *, s.id AS ID, c.nombre AS centro_costo 

			  				  FROM anticipo AS s 

	          				  LEFT JOIN centros_costos AS c ON  s.id_centroscostos = c.id 

							  WHERE ".$filtroRegion." s.publicado != 'draft' 

							  ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";

				}

				else if ($sortorder == "asc")

				{

					$query = "SELECT *, s.id AS ID, c.nombre AS centro_costo 

			  				  FROM anticipo AS s 

	          				  LEFT JOIN centros_costos AS c ON  s.id_centroscostos = c.id 

							  WHERE ".$filtroRegion." s.publicado != 'draft' 

							  ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";

				}

			}

			else

			{

				if ($sortorder == "desc")

				{

					$filterquery .= " ORDER BY" . " " . $sortfield . " DESC LIMIT $start, $pagesize";

				}

				else if ($sortorder == "asc")	

				{

					$filterquery .= " ORDER BY" . " " . $sortfield . " ASC LIMIT $start, $pagesize";

				}

				$query = $filterquery;

			}		

		}

	}

	

	//echo $query;

	

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

	$orders = null;

	// get data and store in a json array

		
	$letters = array(',','.');
	$fruit   = array('');	

		

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

		$estado = '';

		$editado = '';

		$aprobar = '';

		$eliminar = '';
		
		$total = 0;

		switch($row['estado']):

				case 0:

					$estado = "No Revisado";

				break;

				case 1:

					$estado = "Aprobado";

				break;

				case 2:

					$estado = "Rechazado";

				break;

				case 3:

					$estado = "Revisado";

				break;

		endswitch;

		if($row['fecha_edit'] != '0000-00-00 00:00:00'):

           $editado = '<img class="tolltip" title="Fecha Editado:'.$row['fecha_edit'].'" src="https://cdn1.iconfinder.com/data/icons/16x16-free-toolbar-icons/16/58.png" /></td>';

       	endif;

		

		if($_SESSION['perfil'] == 5):

			$eliminar = '<a href="javascript: fn_eliminar('.$row['ID'].');"><img src="../extras/ico/delete.png" /></a>';

		endif;

		

		if($row['estado']==0):

        	if($_SESSION['aprobar_anticipo'] === true):

         		$aprobar = '&nbsp;<a title="Aprobar Anticipo" href="javascript: fn_aprobar_anticipo('.$row['ID'].');"><img src="https://cdn2.iconfinder.com/data/icons/color-svg-vector-icons-part-2/512/ok_check_yes_tick_accept_success-16.png" /></a>';

          	endif; 

   	 	endif; 

		

		$sql4 = "SELECT orden_trabajo FROM `orden_trabajo` WHERE id_proyecto = ".$row['id_ordentrabajo'];

        $pai4 = mysql_query($sql4); 

		$rs_pai4 = mysql_fetch_assoc($pai4);

		

		switch($row['prioridad']):

			case 'CRITICA':

				$prioridad = '<span style="color:#C00;text-shadow: 1px 1px 0px #333;">'.$row['prioridad'].'</span>';

			break;

			case 'ALTA':

				$prioridad = '<span style="color:#CF0;text-shadow: 1px 1px 0px #333;">'.$row['prioridad'].'</span>';

			break;

			case 'MEDIA':

				$prioridad = '<span style="color:#039;text-shadow: 1px 1px 0px #333;">'.$row['prioridad'].'</span>';

			break;

			case 'BAJA':

				$prioridad = '<span style="color:#090;text-shadow: 1px 1px 0px #333;">'.$row['prioridad'].'</span>';

			break;

			case 'GIRADO':

				$prioridad = '<span style="color:#A901DB;text-shadow: 1px 1px 0px #333;">'.$row['prioridad'].'</span>';

			break;

			case 'VINCULADO':

				$prioridad = '<span style="color:#FE9A2E;text-shadow: 1px 1px 0px #333;">'.$row['prioridad'].'</span>';

			break;

			case 'RETORNO':

				$prioridad = '<span style="color:#000000;text-shadow: 1px 1px 0px #333;">'.$row['prioridad'].'</span>';

			break;
			
		endswitch;	
		
				
		$sql6 = " SELECT id_hitos
				  FROM  `items_anticipo` 
				  WHERE id_anticipo = ".$row['ID'];
        $pai6 = mysql_query($sql6);	
		while($rs_pai6 = mysql_fetch_assoc($pai6)):
		
			$sql5 = " SELECT SUM(total_hito) AS total
					  FROM  `items_anticipo` 
					  WHERE  `id_hitos` = ".$rs_pai6['id_hitos']."
					  AND id_anticipo < ".$row['ID'];
			$pai5 = mysql_query($sql5);	
			$rs_pai5 = mysql_fetch_assoc($pai5);
			
			$total += $rs_pai5['total'];
		
		endwhile;
		
		if($total > 0):			
			$warning = '<img src="https://cdn1.iconfinder.com/data/icons/softwaredemo/PNG/16x16/Warning.png"/>';	
		else:
			$warning = '';
		endif;
		
		$sql7 = "SELECT count(1) AS cuenta FROM `hitos` AS h, items_anticipo AS i WHERE i.id_anticipo = ".$row['ID']." AND i.id_hitos = h.id AND h.estado NOT IN ('PENDIENTE','EN EJECUCIÓN')";

        $pai7 = mysql_query($sql7); 

		$rs_pai7 = mysql_fetch_assoc($pai7);
		
		if($rs_pai7['cuenta'])
			$id_anticipo = '<span style="color:red;text-shadow: 1px 1px 0px #333;">'.$row['ID'].'</span>';
		else
			$id_anticipo = $row['ID'];

		$customers[] = array(

			's.id' => $id_anticipo,

			's.estado' => $estado,

			's.fecha' => $row['fecha'],

			's.prioridad' => $prioridad,

			'prioridad_text' => $row['prioridad'],

			's.id_ordentrabajo' => $rs_pai4['orden_trabajo'],

			's.nombre_responsable' => utf8_encode($row['nombre_responsable']),

			's.cedula_responsable' => $row['cedula_responsable'],

			's.id_centroscostos' => $row['centro_costo'],

			's.v_cotizado' => '$'.$row['v_cotizado'],

			's.total_anticipo' => '$'.$row['total_anticipo'],

			's.beneficiario' =>  utf8_encode($row['beneficiario']),	

			's.num_cuenta' =>  utf8_encode($row['banco']),	

			's.valor_giro' =>  '$'.$row['giro'],	

			's.fecha_creacion' =>  utf8_encode($row['fecha_creacion']),	
			
			's.fecha_aprobado' =>  utf8_encode($row['fecha_aprobado']),	
			
			'acciones' => '<a href="javascript: fn_mostrar_frm_modificar('.$row['ID'].');"><img src="https://cdn1.iconfinder.com/data/icons/humano2/16x16/actions/old-edit-find.png" /></a>&nbsp;<a title="Exportar a PDF" href="javascript: fn_export_anticipo('.$row['ID'].');"><img src="https://cdn2.iconfinder.com/data/icons/ledicons/doc_pdf.png" /></a>&nbsp; '.$aprobar.''.$editado.'&nbsp;'.$eliminar.'&nbsp;'.$warning

		  );

	}

	

    $data[] = array(

       'TotalRows' => $total_rows,

	   'Rows' => $customers

	);

	echo json_encode($data);

?>