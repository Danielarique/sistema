<?php 
require_once "../modelos/Materia.php";

$materia = new Materia();

$materi_id=isset($_POST["materi_id"])? limpiarCadena($_POST["materi_id"]):"";
$materi_codigo=isset($_POST["materi_codigo"])? limpiarCadena($_POST["materi_codigo"]):"";
$materi_nombre=isset($_POST["materi_nombre"])? limpiarCadena($_POST["materi_nombre"]):"";
$progra_id=isset($_POST["progra_id"])? limpiarCadena($_POST["progra_id"]):"";
$materi_planest=isset($_POST["materi_planest"])? limpiarCadena($_POST["materi_planest"]):"";
$materi_semestre=isset($_POST["materi_semestre"])? limpiarCadena($_POST["materi_semestre"]):"";
//$materi_semes=isset($_POST["materi_semes"])? limpiarCadena($_POST["materi_semes"]):"";
$materi_horascur=isset($_POST["materi_horascur"])? limpiarCadena($_POST["materi_horascur"]):"";
$materi_horasart=isset($_POST["materi_horasart"])? limpiarCadena($_POST["materi_horasart"]):"";
$materi_horaslidart=isset($_POST["materi_horaslidart"])? limpiarCadena($_POST["materi_horaslidart"]):"";
$materi_horasprac=isset($_POST["materi_horasprac"])? limpiarCadena($_POST["materi_horasprac"]):"";
$materi_perfilest=isset($_POST["materi_perfilest"])? limpiarCadena($_POST["materi_perfilest"]):"";
$materi_actacurr=isset($_POST["materi_actacurr"])? limpiarCadena($_POST["materi_actacurr"]):"";
$materi_usuadigi = 'drique';

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if(empty($materi_id)){
			$rspta=$materia->insertar($materi_codigo,$materi_nombre,$progra_id,$materi_planest,$materi_semestre,
				$materi_horascur,$materi_horasart,$materi_horaslidart,$materi_horasprac,$materi_perfilest,$materi_actacurr,
				$materi_usuadigi);
			echo $rspta ? "Materia Registrada" : "Materia no se pudo registrar";
		}else{
			$rspta=$materia->editar($materi_id,$materi_codigo,$materi_nombre,$progra_id,$materi_planest,$materi_semestre,
				$materi_horascur,$materi_horasart,$materi_horaslidart,$materi_horasprac,$materi_perfilest,$materi_actacurr,$materi_usuadigi);
			echo $rspta ? "Materia Actualizada" : "Materia no se pudo actualizar";
		}


	break;

	case 'eliminar':
		$rspta=$materia->eliminar($materi_id);
		echo $rspta ? "Materia Eliminada" : "Materia no se pudo eliminar";
	break;

	case 'mostrar':
		$rspta=$materia->mostrar($materi_id);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$materia->listar();
		$data = Array();
		


		while ($reg=$rspta->fetch_object()){
		
			$data[]=array(
				"0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->MATERI_ID.')"><i class="fa fa-pencil"></i></button>'.' <br><button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->MATERI_ID.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->MATERI_CODIGO,
				"2"=>$reg->MATERI_NOMBRE,
				"3"=>$reg->PROGRA_CODIGO,
				"4"=>$reg->PLANEST,
				"5"=>$reg->SEMESTRE,
				"6"=>$reg->MATERI_HORASCUR,
				"7"=>$reg->MATERI_HORASART,
				"8"=>$reg->MATERI_HORASLIDART,
				"9"=>$reg->MATERI_HORASPRAC,
				"10"=>$reg->MATERI_PERFILEST.'<button class="btn btn-default btn-xs" onclick="mostrarPer('.$reg->MATERI_ID.')"><img src="../public/img/viewmore.png" alt="x" /></button>',
				"11"=>$reg->MATERI_ACTACURR
			);
		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectPrograma':
		require_once "../modelos/Programa.php";
		$programa = new Programa();
		$rspta = $programa->select();

		while ($reg = $rspta->fetch_object()) {
			echo '<option value=' .$reg->PROGRA_ID .'>' . $reg->PROGRA_CODIGO .'</option>';
		}

	break;

	case 'selectSemestre':
		require_once "../modelos/Semestre.php";
		$semestre = new Semestre();
		$rspta = $semestre->selectSemestre();

		while ($reg = $rspta->fetch_object()) {
			echo '<option value=' .$reg->SEMEST_ID .'>' . $reg->SEMEST_NOMBRE .'</option>';
		}

	break;	

	case 'mostrarPer';
		$rspta=$materia->mostrarPer($materi_id);
		echo json_encode($rspta);
	break;
		
}


?>