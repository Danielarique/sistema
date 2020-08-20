<?php 
require_once "../modelos/Priv_Cat.php";

$priv_cat = new Priv_Cat();

$privcat_usuadigi =isset($_POST["usuari_usuadigi"])? limpiarCadena($_POST["usuari_usuadigi"]):"";
 
switch ($_GET["op"]) {
	case 'guardar':	
		if(isset($_POST["privil_cat"])){
			$cats = $_POST["privil_cat"];
		}else{
			$cats = "";
		}
			$rspta=$priv_cat->insertar($_POST["usuari_id"],$cats,$privcat_usuadigi);
			echo $rspta ? "Privilegios de Cats Registrados" : "Privilegios de Cats no se pudieron registrar";
	break;

	case 'priv_cat':
		//Obtenemos todos los cat
		require_once("../modelos/Cat.php");
		$cat = new Cat();
		$rspta = $cat->listarCat();

		//Obtenemos los permisos asignados al usuario
		$usuari_id = $_GET["usuari_id"];
		$marcados = $priv_cat->listarmarcados($usuari_id);
		
		//Declaramos el array para almacenar todos los permisos marcados
		$valores = array();
		$data = Array();
		//Almacenamos los permisos asignados al usuario 
		while($cats = $marcados->fetch_object()){
			array_push($valores,$cats->CAT_ID);
		}

		
		while($reg= $rspta->fetch_object()) {
			$sw = in_array($reg->CAT_ID, $valores)?'checked':'';
			//echo '<li> <input type="checkbox"'.$sw.' name="privil_cat[]" value="'.$reg->CAT_ID.'">'.$reg->CAT_NOMBRE.'</li>';

			$data[]=array(
				"0"=>'<input type="checkbox"'.$sw.'  name="privil_cat[]"   value="'.$reg->CAT_ID.'">',
				"1"=>$reg->CAT_CODIGO,
				"2"=>$reg->CAT_NOMBRE
			);
			
		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'priv_cat2':

		//Obtenemos los permisos asignados al usuario
		$usuari_id = $_GET["usuari_id"];
		$rspta = $priv_cat->listarmarcados($usuari_id);
		
		while($reg= $rspta->fetch_object()) {
			
			echo '<li>'.$reg->CAT_NOMBRE.'</li>';
		}

	break;
}


?>