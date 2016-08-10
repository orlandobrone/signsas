<?

	include "../../conexion.php";

	include "../extras/php/basico.php";

	

	/*verificamos si las variables se envian*/

	if(empty($_POST['id'])

		|| empty($_POST['hitos'])

		){

		echo json_encode(array('estado'=>false, 'message'=>"No han llegado todos los campos"));

		exit;

	}

	

	$letters = array('.');

	$fruit   = array('');

	

	$acpm = 0;

	$valor_transporte = 0;

	$toes = 0;

	$total_acpm = 0;

	$total_transporte = 0;

	$total_toes = 0;

	$total_hito = 0;

	

	$acpm = explode(',00',$_POST['acpm']);

	$acpm = str_replace($letters, $fruit, $acpm[0] );

	$total_acpm += $acpm;

	

	$valor_transporte = explode(',00',$_POST['valor_transporte']);

	$valor_transporte = str_replace($letters, $fruit, $valor_transporte[0] );

	$total_transporte += $valor_transporte;

	

	$toes = explode(',00',$_POST['toes']);

	$toes = str_replace($letters, $fruit, $toes[0] );

	$total_toes += $toes;

	

	$total_hito += ($total_acpm+$total_transporte+$total_toes);

	

	$sql = sprintf("INSERT INTO `items_anticipo` VALUES ('', '%s', '%s', '%s', '%s', '%s', %s, NULL);",

		fn_filtro($_POST['id']),

		fn_filtro($_POST['hitos']),

		fn_filtro($_POST['acpm']),

		fn_filtro($_POST['valor_transporte']),

		fn_filtro($_POST['toes']),

	    fn_filtro($total_hito)

        //fn_filtro(str_replace('.','',$_POST['valor_hito']))

	);



	if(!mysql_query($sql)){

		//echo "Error al insertar un nuevo item:\n$sql";

		echo json_encode(array('estado'=>false, 'message'=>"Error al insertar un nuevo item:\n$sql"));

		exit;



	}else{

		

		

		$letters = array('.');

		$fruit   = array('');		

		

		$reintegro = 0;

		$acpm = 0;

		$valor_transporte = 0;

		$toes = 0;

		$total_acpm = 0;

		$total_transporte = 0;

		$total_toes = 0;

		$total_anticipo = 0;

		

		$resultado = mysql_query("SELECT * FROM items_anticipo WHERE id_anticipo =".$_POST['id']) or die(mysql_error());

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

		if($_POST['giro'] != 0){

			$giro = explode(',00',$_POST['giro']);

			$giro = str_replace($letters, $fruit, $giro[0] );

		}

		

		$total_anticipo = $total_acpm + $total_toes + $total_anticipo + $giro;	

		$total_anticipo = number_format($total_anticipo, 2, '.', ',');	

		

		/*----------------- Acttualizar Anticipo --------------------------*/

		

		$sql = sprintf("UPDATE `anticipo` SET						

								giro='%s',

								total_anticipo='%s'				

						WHERE id=%d;",

			fn_filtro($_POST['giro']),

			fn_filtro($total_anticipo),

			fn_filtro((int)$_POST['id']) 

		);

		if(!mysql_query($sql)){

			echo json_encode(array('estado'=>false, 'message'=>"Error al actualizar el anticipo:\n$sql"));

			exit;

		}

		/*----------------- Acttualizar Legalizacion --------------------------*/

		$sql = sprintf("UPDATE `legalizacion` SET						

								valor_fa='%s'				

						WHERE id_anticipo=%d;",

			fn_filtro($total_anticipo),

			fn_filtro((int)$_POST['id']) 

		);

		

		if(!mysql_query($sql)){

			echo json_encode(array('estado'=>false, 'message'=>"Error al actualizar legalización:\n$sql"));

			exit;

		}

			

		

		echo json_encode(array('estado'=>true, 'total_anticipo'=>$total_anticipo));

		exit;

	}



	

?>