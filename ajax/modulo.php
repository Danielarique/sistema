<?php 
require_once "../modelos/Modulo.php";

$modulo = new Modulo();



switch ($_GET["op"]) {

	case 'listar':
		$rspta=$modulo->listar();
		$data = Array();
		


		while ($reg=$rspta->fetch_object()){
		
			$data[]=array(
				"0"=>$reg->MODULO_NOMBRE
			
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