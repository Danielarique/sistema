<?php 
require_once "../modelos/Priv_catprogra.php";

$priv_catprogra = new Priv_catprogra();

switch ($_GET["op"]) {
	
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
	
}


?>