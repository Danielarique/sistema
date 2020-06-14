<?php 
require_once "../modelos/Docente.php";

$docente = new Docente();

$docent_id=isset($_POST["docent_id"])? limpiarCadena($_POST["docent_id"]):"";
$docent_documento=isset($_POST["docent_documento"])? limpiarCadena($_POST["docent_documento"]):"";
$docent_lugarexp=isset($_POST["docent_lugarexp"])? limpiarCadena($_POST["docent_lugarexp"]):"";
$docent_nombre=isset($_POST["docent_nombre"])? limpiarCadena($_POST["docent_nombre"]):"";
$docent_perfil=isset($_POST["docent_perfil"])? limpiarCadena($_POST["docent_perfil"]):"";
$docent_fechaing=isset($_POST["docent_fechaing"])? limpiarCadena($_POST["docent_fechaing"]):"";
$docent_residencia=isset($_POST["docent_residencia"])? limpiarCadena($_POST["docent_residencia"]):"";
$docent_telefono=isset($_POST["docent_telefono"])? limpiarCadena($_POST["docent_telefono"]):"";
$docent_celular=isset($_POST["docent_celular"])? limpiarCadena($_POST["docent_celular"]):"";
$docent_emailinst=isset($_POST["docent_emailinst"])? limpiarCadena($_POST["docent_emailinst"]):"";
$docent_emailpers=isset($_POST["docent_emailpers"])? limpiarCadena($_POST["docent_emailpers"]):"";
$docent_planta=isset($_POST["docent_planta"])? limpiarCadena($_POST["docent_planta"]):"";
$docent_grupos=isset($_POST["docent_grupos"])? limpiarCadena($_POST["docent_grupos"]):"";
$docent_usuadigi= 'drique';

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if(empty($docent_id)){
			$rspta=$docente->insertar($docent_documento,$docent_lugarexp,$docent_nombre,$docent_fechaing,$docent_perfil,
				                      $docent_residencia,$docent_telefono,$docent_celular,$docent_emailinst,$docent_emailpers,
				                      $docent_planta,$docent_grupos,$docent_usuadigi);
			echo $rspta ? "Docente Registrado" : "Docente no se pudo registrar";
		}else{
			$rspta=$docente->editar($docent_id,$docent_documento,$docent_lugarexp,$docent_nombre,$docent_fechaing,$docent_perfil,
				                    $docent_residencia,$docent_telefono,$docent_celular,$docent_emailinst,$docent_emailpers,
				                    $docent_planta,$docent_grupos,$docent_usuadigi);
			echo $rspta ? "Docente Actualizado" : "Docente no se pudo actualizar";
		}


	break;

	case 'eliminar':
		$rspta=$docente->eliminar($docent_id);
		echo $rspta ? "Docente Eliminado" : "Docente no se pudo eliminar";
	break;

	case 'mostrar':
		$rspta=$docente->mostrar($docent_id);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$docente->listar();
		$data = Array();

		while ($reg=$rspta->fetch_object()){
		
			$data[]=array(
				"0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->DOCENT_ID.')"><i class="fa fa-pencil"></i></button>'.'<br><button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->DOCENT_ID.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->DOCENT_DOCUMENTO.'<br> Expedida en '.$reg->DOCENT_LUGAREXP,
				"2"=>$reg->DOCENT_NOMBRE,
				"3"=>$reg->DOCENT_FECHAING,
				"4"=>$reg->DOCENT_PERFIL.'<button class="btn btn-default btn-xs" onclick="mostrarPer('.$reg->DOCENT_ID.')"><img src="../public/img/viewmore.png" alt="x" /></button>',
				"5"=>$reg->DOCENT_RESIDENCIA,
				"6"=>$reg->DOCENT_TELEFONO.'<br>'.$reg->DOCENT_CELULAR,
				"7"=>$reg->DOCENT_EMAILINST.'<br>'.$reg->DOCENT_EMAILPERS,
				"8"=>$reg->DOCENT_PLANTA,
				"9"=>$reg->DOCENT_GRUPOS
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
		$rspta=$docente->mostrarPer($docent_id);
		echo json_encode($rspta);
	break;

	
	
}


?>