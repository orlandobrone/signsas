<? 	header('Content-type: text/html; charset=iso-8859-1');

	session_start();

	include "../../conexion.php";

	#Include the connect.php file

	#Connect to the database

	//connection String	

	// get data and store in a json array



	$pagenum = $_GET['pagenum'];

	$pagesize = $_GET['pagesize'];

	$start = $pagenum * $pagesize;

	

	if($_GET['pagesize'] != 1):

		$litmit = " LIMIT $start, $pagesize";

	else:

		$litmit = " ";

		$pagenum  = 1;

		$start = 1;

	endif;

	

	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM hitos ".$litmit ;

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

			$where = " WHERE (";

			$tmpdatafield = "";

			$tmpfilteroperator = "";

			for ($i=0; $i < $filterscount; $i++)

		    {

				// get the filter's value.

				$filtervalue = $_GET["filtervalue" . $i];

				// get the filter's condition.

				$filtercondition = $_GET["filtercondition" . $i];

				// get the filter's column.

				$filterdatafield = $_GET["filterdatafield" . $i];

				// get the filter's operator.

				$filteroperator = $_GET["filteroperator" . $i];

				

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

								

				if ($i == $filterscount - 1)

				{

					$where .= ")";

				}

				

				$tmpfilteroperator = $filteroperator;

				$tmpdatafield = $filterdatafield;			

			}

			// build the query.

			$query = "SELECT * FROM hitos ".$where;

			$filterquery = $query;

			$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

			$sql = "SELECT FOUND_ROWS() AS `found_rows`;";

			$rows = mysql_query($sql);

			$rows = mysql_fetch_assoc($rows);

			$new_total_rows = $rows['found_rows'];		

			$query = "SELECT * FROM hitos ".$where." ".$litmit ;		

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

					$query = "SELECT * FROM hitos ORDER BY" . " " . $sortfield . " DESC ".$litmit;

				}

				else if ($sortorder == "asc")

				{

					$query = "SELECT * FROM hitos ORDER BY" . " " . $sortfield . " ASC ".$litmit;

				}

			}

			else

			{

				if ($sortorder == "desc")

				{

					$filterquery .= " ORDER BY" . " " . $sortfield . " DESC ".$litmit;

				}

				else if ($sortorder == "asc")	

				{

					$filterquery .= " ORDER BY" . " " . $sortfield . " ASC ".$litmit;

				}

				$query = $filterquery;

			}		

		}

	}

	

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

	$orders = null;

	// get data and store in a json array

	

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		$sqlfgr = "select estado from hitos where id = ".$row['id'];

		$paifgr = mysql_query($sqlfgr); 

		$rs_paifgr = mysql_fetch_assoc($paifgr);
		
		if($rs_paifgr['estado'] != 'ELIMINADO') {
		

			$sql2 = "select nombre from proyectos where id = ".$row['id_proyecto'];
	
			$pai2 = mysql_query($sql2); 
	
			$rs_pai2 = mysql_fetch_assoc($pai2);
	
			
	
			
	
			if($_SESSION['perfil'] == 5 || $_SESSION['perfil']  == 19 ):
	
				$eliminar = '&nbsp;<a href="javascript: fn_eliminar('.$row['id'].');"><img src="../extras/ico/delete.png" /></a>';
	
			endif; 
	
			
	
			
	
			$customers[] = array(
	
				'id' => $row['id'],
	
				'id_proyecto' => $rs_pai2['nombre'],
	
				'nombre' => utf8_encode($row['nombre']),
	
				'estado' => utf8_encode($row['estado']),
	
				'fecha_inicio' => $row['fecha_inicio'],
	
				'fecha_final' => $row['fecha_final'],
				
				'dias_hito' => $row['dias_hito'],
	
				'fecha_inicio_ejecucion' => $row['fecha_inicio_ejecucion'],
	
				'fecha_ejecutado' => $row['fecha_ejecutado'],
	
				'fecha_informe' => $row['fecha_informe'],
	
				'fecha_liquidacion' => $row['fecha_liquidacion'],
	
				'fecha_facturacion' => $row['fecha_facturacion'],
	
				'fecha_facturado' => $row['fecha_facturado'],
	
				'descripcion' =>  utf8_encode($row['descripcion']),
	
				'ot_cliente' => $row['ot_cliente'], /*FGR*/
	
				'po' => $row['po'], /*FGR*/
	
				'gr' => $row['gr'], /*FGR*/
	
				'factura' => $row['factura'], /*JOB*/
	
				'po2' => $row['po2'], /*JOB*/
	
				'gr2' => $row['gr2'], /*JOB*/
	
				'factura2' => $row['factura2'], /*JOB*/
				
				'valor_cotizado_hito' => $row['valor_cotizado_hito'], /*FGR*/
	
				'acciones' => '<a href="javascript: fn_mostrar_frm_modificar('.$row['id'].');"><img src="../extras/ico/page_edit.png" /></a>'.$eliminar
	
			  );
		  
		}

	}

    $data[] = array(

       'TotalRows' => $total_rows,

	   'Rows' => $customers

	);

	echo json_encode($data);

?>