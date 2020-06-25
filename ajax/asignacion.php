<?php 
require_once "../modelos/Asignacion.php";

$asigna = new Asigna();


$asigna_id=isset($_POST["asigna_id"])? limpiarCadena($_POST["asigna_id"]):"";
$cat_id=isset($_POST["cat_id"])? limpiarCadena($_POST["cat_id"]):"";
$despla_id=isset($_POST["despla_id"])? limpiarCadena($_POST["despla_id"]):"";
$materi_id=isset($_POST["materi_id"])? limpiarCadena($_POST["materi_id"]):"";
$docent_document=isset($_POST["docent_documento"])? limpiarCadena($_POST["docent_documento"]):"";
$grupo_id=isset($_POST["grupo_id"])? limpiarCadena($_POST["grupo_id"]):"";
$semana_id=isset($_POST["semana_id"])? limpiarCadena($_POST["semana_id"]):"";
$dia_id=isset($_POST["dia_id"])? limpiarCadena($_POST["dia_id"]):"";
$hora_id=isset($_POST["hora_id"])? limpiarCadena($_POST["hora_id"]):"";
$asigna_lidart=isset($_POST["asigna_lidart"])? limpiarCadena($_POST["asigna_lidart"]):"";
$asigna_salon=isset($_POST["asigna_salon"])? limpiarCadena($_POST["asigna_salon"]):"";
$asigna_observ=isset($_POST["asigna_observ"])? limpiarCadena($_POST["asigna_observ"]):"";
$asigna_usuadigi =isset($_POST["usuari_usuario"])? limpiarCadena($_POST["usuari_usuario"]):"";
	

//SE CONSULTA ID DE DOCENTE CON LA CEDULA Q SE VA A REGISTRAR
if($docent_document != ""){
	require_once "../modelos/Docente.php";
	$docente = new Docente();
	$rspta = $docente->infoDocent($docent_document);
	while ($reg = $rspta->fetch_object()) {
		$docent_id = $reg->DOCENT_ID;
	}
}

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if(empty($asigna_id)){
			$rspta=$asigna->insertar($cat_id,$despla_id,$materi_id,$docent_id,$grupo_id,$semana_id,$dia_id,$hora_id,$asigna_lidart,
				$asigna_salon,$asigna_observ,$asigna_usuadigi);
			echo $rspta ? "Asignación Registrada" : "Asignación no se pudo registrar";
		}else{
			$rspta=$asigna->editar($asigna_id,$cat_id,$despla_id,$materi_id,$docent_id,$grupo_id,$semana_id,$dia_id,$hora_id,$asigna_lidart,$asigna_salon,$asigna_observ,$asigna_usuadigi);
			echo $rspta ? "Asignación Actualizada" : "Asignación no se pudo actualizar";
		}

	break;

	case 'eliminar':
		$rspta=$asigna->eliminar($asigna_id);
		echo $rspta ? "Asignación Eliminada" : "Asignación no se pudo eliminar";
	break;

	case 'mostrar':
		$rspta=$asigna->mostrar($asigna_id);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$asigna->listar();
		$data = Array();

		while ($reg=$rspta->fetch_object()){
		
			$data[]=array(
				"0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->ASIGNA_ID.')"><i class="fa fa-pencil"></i></button>'.' &nbsp; &nbsp;<button class="btn btn-danger btn-xs" onclick="eliminar('.$reg->ASIGNA_ID.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->CAT_CODIGO,
				"2"=>$reg->CAT_NOMBRE,
				"3"=>$reg->PROGRA_CODIGO,
				"4"=>$reg->PROGRA_NOMBRE,
				"5"=>$reg->MATERI_SEMESTRE,
				"6"=>$reg->ASIGNA_GRUPO,
				"7"=>$reg->MATERI_CODIGO,
				"8"=>$reg->MATERI_NOMBRE,
				"9"=>$reg->MATERI_PERFILEST.'<button class="btn btn-default btn-xs" onclick="mostrarPer('.$reg->MATERI_ID.')"><img src="../public/img/viewmore.png" alt="x" /></button>',
				"10"=>$reg->ASIGNA_SEMANA,
				"11"=>$reg->DIA_NOMBRE,
				"12"=>$reg->HORA_HORA,
				"13"=>$reg->MATERI_HORASCUR,
				"14"=>$reg->MATERI_HORASART,
				"15"=>$reg->MATERI_HORASPRAC,
				"16"=>$reg->MATERI_HORASLIDART,
				"17"=>$reg->DOCENT_DOCUMENTO,
				"18"=>$reg->DOCENT_NOMBRE,
				"19"=>$reg->DOCENT_PERFIL.'<button class="btn btn-default btn-xs" onclick="mostPerDoc('.$reg->DOCENT_ID.')"><img src="../public/img/viewmore.png" alt="x" /></button>',
				"20"=>$reg->DOCENT_RESIDENCIA,
				"21"=>$reg->DOCENT_TELEFONO,
				"22"=>$reg->DOCENT_CELULAR,
				"23"=>$reg->DOCENT_EMAILINST,
				"24"=>$reg->DOCENT_EMAILPERS,
				"25"=>$reg->DOCENT_PLANTA,
				"26"=>$reg->DESPLA_ORIGEN,
				"27"=>$reg->DESPLA_DESTINO,
				"28"=>$reg->ASIGNA_SALON,
				"29"=>$reg->ASIGNA_OBSER
			);
		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'selectCat':
		require_once "../modelos/Priv_Cat.php";
		$priv_cat = new Priv_Cat();
		$usuari_id = $_GET["usuari_id"];
		$rspta = $priv_cat->listarmarcados($usuari_id);

		while ($reg = $rspta->fetch_object()) {
			echo '<option value=' .$reg->CAT_ID .'>' . $reg->CAT_NOMBRE .'</option>';
		}

	break;

	case 'selectDespla':
		require_once "../modelos/Desplazamiento.php";
		$desplaza = new Desplaza();
		$usuari_id = $_GET["usuari_id"];
		$rspta = $desplaza->listDesp($usuari_id);

		while ($reg = $rspta->fetch_object()) {
			echo '<option value=' .$reg->DESPLA_ID .'>' . $reg->DESPLA_ORIGEN .'-'.$reg->DESPLA_DESTINO.'</option>';
		}

	break;

	case 'selectMateria':
		require_once "../modelos/Materia.php";
		$materia = new Materia();
		$usuari_id = $_GET["usuari_id"];
		$rspta = $materia->listMate($usuari_id);

		while ($reg = $rspta->fetch_object()) {
			echo '<option value=' .$reg->MATERI_ID .'>' . $reg->MATERI_CODIGO .'-'.$reg->MATERI_NOMBRE.'</option>';
		}

	break;

	case 'buscDoce':
		require_once "../modelos/Docente.php";
		$docente = new Docente();
		$busq = $_POST["busqueda"];
		$rspta = $docente->buscDoce($busq);

		while ($reg = $rspta->fetch_object()) {
			$Resultado[] = $reg->DOCENT_DOCUMENTO.'-'.$reg->DOCENT_NOMBRE;
		}
		echo json_encode($Resultado);

	break;

	case 'cursosAsigna':
		$docent_document = $_GET["docent_document"];
		$rspta=$asigna->cursosAsigna($docent_document);

		$cantid = 0;
		while ($reg = $rspta->fetch_object()) {
			$cantid++;
		}
		echo $cantid;
	break;

	case 'cruceHorari':
		$docent_document = $_GET["docent_document"];
		$semana_id = $_GET["semana_id"];
		$dia_id = $_GET["dia_id"];
		$hora_id = $_GET["hora_id"];
		$rspta=$asigna->cruceHorari($docent_document,$semana_id,$dia_id,$hora_id);

		$cantid = 0;
		while ($reg = $rspta->fetch_object()) {
			$cantid++;
		}
		echo $cantid;
	break;

	case 'cruceMateri':
		$materi_id = $_GET["materi_id"];
		$semana_id = $_GET["semana_id"];
		$dia_id = $_GET["dia_id"];
		$hora_id = $_GET["hora_id"];
		$grupo_id = $_GET["grupo_id"];
		$cat_id = $_GET["cat_id"];
		$rspta=$asigna->cruceMateri($materi_id,$semana_id,$dia_id,$hora_id,$grupo_id,$cat_id);

		$cantid = 0;
		while ($reg = $rspta->fetch_object()) {
			$cantid++;
		}
		echo $cantid;
	break;

	case 'doblemateri':
		$materi_id = $_GET["materi_id"];
		$grupo_id = $_GET["grupo_id"];
		$cat_id = $_GET["cat_id"];
		$rspta=$asigna->doblemateri($materi_id,$grupo_id,$cat_id);

		$cantid = 0;
		while ($reg = $rspta->fetch_object()) {
			$cantid++;
		}
		echo $cantid;
	break;

}


?>