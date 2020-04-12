<?php 
/*require_once "../modelos/Asignacion.php";

$asigna = new Asigna();*/


/*$cat_id=isset($_POST["cat_id"])? limpiarCadena($_POST["cat_id"]):"";
$cat_codigo=isset($_POST["cat_codigo"])? limpiarCadena($_POST["cat_codigo"]):"";
$cat_codigogci=isset($_POST["cat_codigogci"])? limpiarCadena($_POST["cat_codigogci"]):"";
$cat_nombre=isset($_POST["cat_nombre"])? limpiarCadena($_POST["cat_nombre"]):"";
$cat_email=isset($_POST["cat_email"])? limpiarCadena($_POST["cat_email"]):"";
$cat_usuadigi = 'drique';*/

switch ($_GET["op"]) {
	/*case 'guardaryeditar':
		if(empty($cat_id)){
			$rspta=$cat->insertar($cat_codigo,$cat_codigogci,$cat_nombre,$cat_email,$cat_usuadigi);
			echo $rspta ? "Cat Registrado" : "Cat no se pudo registrar";
		}else{
			$rspta=$cat->editar($cat_id,$cat_codigo,$cat_codigogci,$cat_nombre,$cat_email,$cat_usuadigi);
			echo $rspta ? "Cat Actualizado" : "Cat no se pudo actualizar";
		}

	break;

	case 'eliminar':
		$rspta=$cat->eliminar($cat_id);
		echo $rspta ? "Cat Eliminado" : "Cat no se pudo eliminar";
	break;

	case 'mostrar':
		$rspta=$cat->mostrar($cat_id);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cat->listar();
		$data = Array();
		


		while ($reg=$rspta->fetch_object()){
		
			$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->CAT_ID.')"><i class="fa fa-pencil"></i></button>'.' &nbsp; &nbsp;<button class="btn btn-danger" onclick="eliminar('.$reg->CAT_ID.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->CAT_CODIGO,
				"2"=>$reg->CAT_CODIGOGCI,
				"3"=>$reg->CAT_NOMBRE,
				"4"=>$reg->CAT_EMAIL
			);
		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;*/

	case 'selectCat':
		require_once "../modelos/Priv_Cat.php";
		$priv_cat = new Priv_Cat();
		$usuari_id = $_GET["usuari_id"];
		$rspta = $priv_cat->listarmarcados($usuari_id);

		while ($reg = $rspta->fetch_object()) {
			echo '<option value=' .$reg->PRIVIL_ID .'>' . $reg->CAT_CODIGO .'</option>';
		}

	break;
}


?>