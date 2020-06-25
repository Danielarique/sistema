<?php
session_start(); 
require_once "../modelos/Usuario.php";

$usuario = new Usuario();
$usuari_id=isset($_POST["usuari_id"])? limpiarCadena($_POST["usuari_id"]):"";
$usuari_nombres=isset($_POST["usuari_nombres"])? limpiarCadena($_POST["usuari_nombres"]):"";
$usuari_usuario=isset($_POST["usuari_usuario"])? limpiarCadena($_POST["usuari_usuario"]):"";
$usuari_password=isset($_POST["usuari_password"])? limpiarCadena($_POST["usuari_password"]):"";
$usuari_email=isset($_POST["usuari_email"])? limpiarCadena($_POST["usuari_email"]):"";
$usuari_rol=isset($_POST["usuari_rol"])? limpiarCadena($_POST["usuari_rol"]):"";
$usuari_estado=isset($_POST["usuari_estado"])? limpiarCadena($_POST["usuari_estado"]):"";
$usuari_usuadigi = 'drique';

switch ($_GET["op"]) {
	case 'guardaryeditar':

	$usuari_passHash = hash("SHA256", $usuari_password);
		if(empty($usuari_id)){
			$rspta=$usuario->insertar($usuari_nombres,$usuari_usuario,$usuari_passHash,$usuari_email,$usuari_rol,$usuari_estado,$usuari_usuadigi,$_POST["modulo"]);
			echo $rspta ? "Usuario Registrado" : "No se pudieron registrar todos los datos del usuario";
		}else{
			$rspta=$usuario->editar($usuari_id,$usuari_nombres,$usuari_usuario,$usuari_passHash,$usuari_email,$usuari_rol,$usuari_estado,$usuari_usuadigi,$_POST["modulo"]);
			echo $rspta ? "Usuario Actualizado" : "No se pudieron actualizar todos los datos del usuario";
		}


	break;

	case 'eliminar':
		$rspta=$usuario->eliminar($usuari_id);
		echo $rspta ? "Usuario Eliminado" : "Usuario Eliminado";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($usuari_id);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
		$data = Array();
		


		while ($reg=$rspta->fetch_object()){
		
			$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->USUARI_ID.')"><i class="fa fa-pencil"></i></button>'.' &nbsp; &nbsp;<button class="btn btn-danger" onclick="eliminar('.$reg->USUARI_ID.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->USUARI_NOMBRES,
				"2"=>$reg->USUARI_USUARIO,
				"3"=>$reg->USUARI_EMAIL,
				"4"=>$reg->USUARI_ROL,
				"5"=>$reg->USUARI_ESTADO
			);
		}
		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;	

	case 'privil_modulo':
		//Obtenemos todos los modulos
		require_once("../modelos/Modulo.php");
		$modulo = new Modulo();
		$rspta = $modulo->listar();

		//Obtenemos los permisos asignados al usuario
		$id= $_GET['id'];
		$marcados = $usuario->listarmarcados($id);

		//Declaramos el array para almacenar todos los permisos marcados
		$valores = array();

		//Almacenamos los permisos asignados al usuario 
		while($mod = $marcados->fetch_object()){
			array_push($valores,$mod->MODULO_ID);
		}

		while($reg= $rspta->fetch_object()) {
			$sw = in_array($reg->MODULO_ID, $valores)?'checked':'';
			echo '<li> <input type="checkbox"'.$sw.' name="modulo[]" value="'.$reg->MODULO_ID.'">'.$reg->MODULO_NOMBRE.'</li>';
		}

	break;

	case 'verificar':
		$logina=$_POST['logina'];
		$clavea=$_POST['clavea'];

		$clavehash= hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina,$clavehash);
		$fetch=$rspta->fetch_object();
		if(isset($fetch)){
			$_SESSION['USUARI_ID']=$fetch->USUARI_ID;
			$_SESSION['USUARI_NOMBRES']=$fetch->USUARI_NOMBRES;
			$_SESSION['USUARI_USUARIO']=$fetch->USUARI_USUARIO;
			$_SESSION['USUARI_EMAIL']=$fetch->USUARI_EMAIL;

			//Obtenemos los permisos del usuario
			$marcados=$usuario->listarmarcados($fetch->USUARI_ID);

			//Declaramos el array para almacenar todos los permisos marcados
			$valores = array();

			//Almacenamos los permisos marcados en el array 
			while ($per = $marcados->fetch_object()) {
				array_push($valores, $per->MODULO_ID);
			}

			//Se determinan los accesos al usuario
			in_array(1, $valores)?$_SESSION['usuario']=1:$_SESSION['usuario']=0;
			in_array(2, $valores)?$_SESSION['docente']=1:$_SESSION['docente']=0;
			in_array(3, $valores)?$_SESSION['materia']=1:$_SESSION['materia']=0;
			in_array(4, $valores)?$_SESSION['cat']=1:$_SESSION['cat']=0;
			in_array(5, $valores)?$_SESSION['programa']=1:$_SESSION['programa']=0;
			in_array(6, $valores)?$_SESSION['asignacion']=1:$_SESSION['asignacion']=0;
			in_array(7, $valores)?$_SESSION['modulo']=1:$_SESSION['modulo']=0;
			in_array(8, $valores)?$_SESSION['privi_catprogra']=1:$_SESSION['privi_catprogra']=0;
		}
		echo json_encode($fetch);	
	break;

	case 'salir':

		//Se limpian las variables de sesion
		session_unset();

		//Se destruye la sesion
		session_destroy();

		//Se redirecciona el login
		header("Location: ../index.php");

	break;
}


?>