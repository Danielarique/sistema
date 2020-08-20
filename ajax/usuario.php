<?php
session_start(); 
require_once "../modelos/Usuario.php";

$usuario = new Usuario();
$usuari_id=isset($_POST["usuari_id"])? limpiarCadena($_POST["usuari_id"]):"";
$usuari_nombres=isset($_POST["usuari_nombres"])? limpiarCadena($_POST["usuari_nombres"]):"";
$usuari_usuario=isset($_POST["usuari_usuario"])? limpiarCadena($_POST["usuari_usuario"]):"";
$usuari_password=isset($_POST["usuari_password"])? limpiarCadena($_POST["usuari_password"]):"";
$usuari_email=isset($_POST["usuari_email"])? limpiarCadena($_POST["usuari_email"]):"";
$usuari_estado=isset($_POST["usuari_estado"])? limpiarCadena($_POST["usuari_estado"]):"";
$usuari_usuadigi =isset($_POST["usuari_usuadigi"])? limpiarCadena($_POST["usuari_usuadigi"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if($usuari_password != ""){
		$usuari_passHash = hash("SHA256", $usuari_password);
	}else{
		$usuari_passHash = "";
	}
		if(empty($usuari_id)){
			if(isset($_POST["modulo"])){
				$modulos = $_POST["modulo"];
			}else{
				$modulos = "";
			}
			$rspta=$usuario->insertar($usuari_nombres,$usuari_usuario,$usuari_passHash,$usuari_email,
				$usuari_estado,$usuari_usuadigi,$modulos);
			echo $rspta ? "Usuario Registrado" : "No se pudieron registrar todos los datos del usuario";
		}else{
			if(isset($_POST["modulo"])){
				$modulos = $_POST["modulo"];
			}else{
				$modulos = "";
			}
			$rspta=$usuario->editar($usuari_id,$usuari_nombres,$usuari_usuario,$usuari_passHash,$usuari_email,$usuari_estado,$usuari_usuadigi,$modulos);
			echo $rspta ? "Usuario Actualizado" : "No se pudieron actualizar todos los datos del usuario";
		}


	break;

	case 'eliminar':
		//Eliminamos los privilegios de modulo del usuario
		require_once("../modelos/Privil_Modulo.php");
		$privil_Modulo = new Privil_Modulo();
		$rspta1 = $privil_Modulo->eliminar($usuari_id);

		//Eliminamos los privilegios de cat del usuario
		require_once("../modelos/Priv_Cat.php");
		$priv_cat = new Priv_Cat();
		$rspta2 = $priv_cat->eliminar($usuari_id);

		//Eliminamos los privilegios de programas del usuario
		require_once("../modelos/Priv_Progra.php");
		$priv_progra = new Priv_Progra();
		$rspta3 = $priv_progra->eliminar($usuari_id);

		$rspta4=$usuario->eliminar($usuari_id);
		echo $rspta4 ? "Usuario Eliminado" : "Usuario no se pudo eliminar";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($usuari_id);
		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$usuario->listar();
		$data = Array();
		


		while ($reg=$rspta->fetch_object()){
			if($reg->USUARI_ESTADO == 1){
				$Estado = "Activo";
			}else{
				$Estado = "Desactivo";
			}
			$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->USUARI_ID.')"><i class="fa fa-pencil"></i></button>'.' &nbsp; &nbsp;<button class="btn btn-danger" onclick="eliminar('.$reg->USUARI_ID.')"><i class="fa fa-trash"></i></button>',
				"1"=>$reg->USUARI_NOMBRES,
				"2"=>$reg->USUARI_USUARIO,
				"3"=>$reg->USUARI_EMAIL,
				"4"=>$Estado
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
			echo '<li> <input type="checkbox"'.$sw.' id="modulo" name="modulo[]" value="'.$reg->MODULO_ID.'">'.$reg->MODULO_NOMBRE.'</li>';
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

	case 'email_existe':
		$usuari_email=$_GET['usuari_email'];
		$usuari_id = $_GET['usuari_id'];
		$rspta = $usuario->email_existe($usuari_email);
		$cantid = 0;
		$menos = 0;
		while ($reg = $rspta->fetch_object()) {	
			if($reg->USUARI_ID == $usuari_id){
				$menos++;
			}
			$cantid++;
		}
		$canti2 = $cantid-$menos;
		echo $canti2;	
	break;

	case 'usuari_existe':
		$usuari_usuario=$_GET['usuari_usuario'];
		$usuari_id = $_GET['usuari_id'];
		$rspta = $usuario->usuari_existe($usuari_usuario);
		$cantid = 0;
		$menos = 0;
		while ($reg = $rspta->fetch_object()) {	
			if($reg->USUARI_ID == $usuari_id){
				$menos++;
			}
			$cantid++;
		}
		$canti2 = $cantid-$menos;
		echo $canti2;	
	break;

	case 'recuperar':
		$email=$_GET['email'];
		
	    $rspta = $usuario->email_existe($email);
	    $fetch=$rspta->fetch_object();
		if(isset($fetch)){
			
			$usuari_usuario = $fetch->USUARI_USUARIO;
			$usuari_id = $fetch->USUARI_ID;

			$string_aleato = $usuario->string_aleato(10);
			$url_secreta = hash('SHA256',$string_aleato.$usuari_usuario);
			require_once("../modelos/Recuperar.php");
			$recuperar = new Recuperar();
			$peticion_generada = $recuperar->generar_peticion($usuari_id,$url_secreta);
			echo $url_secreta;
			/*$asunto = "Recuperación de contraseña";
			

			$exito = mail($email,$asunto,$url_secreta);

			if($exito){
				echo "email enviado";
			}else{
				echo "email fallido";
			}*/	
		}else{
			echo "El email no está registrado en el sistema";
		}

	break;
}


?>