<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Usuario
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA INSERTAR REGISTROS
	public function insertar($usuari_nombres,$usuari_usuario,$usuari_password,$usuari_email,$usuari_rol,$usuari_estado,$usuari_usuadigi,$modulos)
	{

		$sql="INSERT INTO usuario (USUARI_NOMBRES,USUARI_USUARIO, USUARI_PASSWORD, USUARI_EMAIL, USUARI_ROL, USUARI_ESTADO, USUARI_USUADIGI, USUARI_FECHDIGI, USUARI_HORADIGI)
		           VALUES('$usuari_nombres','$usuari_usuario','$usuari_password','$usuari_email','$usuari_rol','$usuari_estado',
		           '$usuari_usuadigi',CURDATE(),CURTIME())";
		           		
	//	return ejecutarConsulta($sql)
		$usuari_idnew = ejecutarConsulta_retornarID($sql);

		$num_elementos = 0;
		$sw=true;

		while($num_elementos < count($modulos)){
			$sql_detalle="INSERT INTO privil_modulo (MODULO_ID,USUARI_ID)
						  VALUES('$modulos[$num_elementos]','$usuari_idnew')";
			ejecutarConsulta($sql_detalle) or $sw =false;

			$num_elementos = $num_elementos+1;
		}
		return $sw;
	}

	//SE IMPLEMENTA METODO PARA EDITAR REGISTROS
	public function editar($usuari_id,$usuari_nombres,$usuari_usuario,$usuari_password,$usuari_email,$usuari_rol,$usuari_estado,$usuari_usuadigi,$modulos)
	{
		$sql="UPDATE usuario SET USUARI_NOMBRES='$usuari_nombres',USUARI_USUARIO='$usuari_usuario',USUARI_PASSWORD='$usuari_password',USUARI_EMAIL='$usuari_email',USUARI_ROL='$usuari_rol',USUARI_ESTADO='$usuari_estado',USUARI_USUADIGI='$usuari_usuadigi',USUARI_FECHDIGI=CURTIME(),USUARI_HORADIGI=CURDATE()
			WHERE USUARI_ID='$usuari_id'";
		ejecutarConsulta($sql);

		//SE ELIMINAN TODOS LOS PERMISOS ASIGNADOS PARA VOLVERLOS A REGISTRAR
		$sqldel="DELETE FROM privil_modulo WHERE USUARI_ID='$usuari_id'";
		ejecutarConsulta($sqldel);

		$num_elementos = 0;
		$sw=true;

		while($num_elementos < count($modulos)){
			$sql_detalle="INSERT INTO privil_modulo (MODULO_ID,USUARI_ID)
						  VALUES('$modulos[$num_elementos]','$usuari_id')";
			ejecutarConsulta($sql_detalle) or $sw =false;

			$num_elementos = $num_elementos+1;
		}
		return $sw;

	}

	//SE IMPLEMENTA METODO PARA ELIMINAR REGISTROS 
	public function eliminar($usuari_id)
	{
		$sql="DELETE FROM usuario WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR LOS DATOS DE UN REGISTRO 
	public function mostrar($usuari_id)
	{
		$sql="SELECT USUARI_ID, USUARI_NOMBRES,USUARI_USUARIO, USUARI_PASSWORD, USUARI_EMAIL, USUARI_ROL, USUARI_ESTADO
		      FROM usuario WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//SE IMPLEMENTA METODO PARA LISTAR TODOS LOS REGISTROS
	public function listar(){
		$sql="SELECT USUARI_ID,USUARI_NOMBRES,USUARI_USUARIO, USUARI_PASSWORD, USUARI_EMAIL, USUARI_ROL, USUARI_ESTADO
		      FROM usuario";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA LISTAR LOS PERMISOS DE MODULOS MARCADOS
	public function listarmarcados($usuari_id){
		$sql="SELECT PRIVIL_ID, MODULO_ID
		      FROM privil_modulo WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA VERIFICAR EL ACCESO AL SISTEMA
	public function verificar($logina,$clavea){
		$sql="SELECT USUARI_ID, USUARI_NOMBRES, USUARI_USUARIO, USUARI_EMAIL,USUARI_PASSWORD
		      FROM usuario WHERE USUARI_USUARIO='$logina' AND USUARI_PASSWORD='$clavea' AND USUARI_ESTADO='1'";
		return ejecutarConsulta($sql);

	}

}


?>