<?php 
require_once "../modelos/Priv_catprogra.php";

$priv_catprogra = new Priv_catprogra();

$progra_id=isset($_POST["progra_id"])? limpiarCadena($_POST["progra_id"]):"";
$progra_codigo=isset($_POST["progra_codigo"])? limpiarCadena($_POST["progra_codigo"]):"";
$progra_nombre=isset($_POST["progra_nombre"])? limpiarCadena($_POST["progra_nombre"]):"";
$progra_email=isset($_POST["progra_email"])? limpiarCadena($_POST["progra_email"]):"";
$progra_usuadigi = 'drique';

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if(empty($progra_id)){
			$rspta=$programa->insertar($progra_codigo,$progra_nombre,$progra_email,$progra_usuadigi);
			echo $rspta ? "Programa Registrado" : "Programa no se pudo registrar";
		}else{
			$rspta=$programa->editar($progra_id,$progra_codigo,$progra_nombre,$progra_email,$progra_usuadigi);
			echo $rspta ? "Programa Actualizado" : "Programa no se pudo actualizar";
		}


	break;

	case 'eliminar':
		$rspta=$programa->eliminar($progra_id);
		echo $rspta ? "Programa Eliminado" : "Programa no se pudo eliminar";
	break;

	case 'mostrar':
		$rspta=$programa->mostrar($progra_id);
		echo json_encode($rspta);
	break;

	case 'listarUsua':
		$rspta=$priv_catprogra->listarUsua();
		$data = Array();
		


		while ($reg=$rspta->fetch_object()){
		
			$data[]=array(
				"0"=>$reg->USUARI_NOMBRES,
				"1"=>$reg->USUARI_USUARIO,
				"2"=>'<button class="btn btn-primary" title="Asignar Cats" onclick="mostrarCat('.$reg->USUARI_ID.')"><i class="fa fa-plus"></i></button>',
				"3"=>'<button class="btn btn-warning" title="Asignar Programas" onclick="mostrarProgra('.$reg->USUARI_ID.')"><i class="fa fa-plus"></i></button>'
			);
		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'mostrarPer';
		$rspta=$materia->mostrarPer($materi_id);
		echo json_encode($rspta);
	break;

	
	
}


?>