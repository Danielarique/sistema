<?php 
require_once "../modelos/Priv_Progra.php";

$priv_progra = new Priv_Progra();

$cat_usuadigi = 'drique';

switch ($_GET["op"]) {
	case 'guardar':	
		$rspta=$priv_progra->insertar($_POST["usuari_id"],$_POST["privil_progra"]);
		echo $rspta ? "Privilegios de Programas Registrados" : "Privilegios de Programas no se pudieron registrar";	
	break;

	case 'priv_progra':
		//Obtenemos todos los cat
		require_once("../modelos/Programa.php");
		$programa = new Programa();
		$rspta = $programa->listarProgra();

		//Obtenemos los permisos asignados al usuario
		$usuari_id = $_GET["usuari_id"];
		$marcados = $priv_progra->listarmarcados($usuari_id);

		//Declaramos el array para almacenar todos los permisos marcados
		$valores = array();
		$data = Array();
		//Almacenamos los permisos asignados al usuario 
		while($programas = $marcados->fetch_object()){
			array_push($valores,$programas->PROGRA_ID);
		}

		while($reg= $rspta->fetch_object()) {
			$sw = in_array($reg->PROGRA_ID, $valores)?'checked':'';
			//echo '<li> <input type="checkbox"'.$sw.' name="privil_cat[]" value="'.$reg->CAT_ID.'">'.$reg->CAT_NOMBRE.'</li>';

			$data[]=array(
				"0"=>'<input type="checkbox"'.$sw.' name="privil_progra[]" value="'.$reg->PROGRA_ID.'">',
				"1"=>$reg->PROGRA_CODIGO,
				"2"=>$reg->PROGRA_NOMBRE
			);
		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}


?>