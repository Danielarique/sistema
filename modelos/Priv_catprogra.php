<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Priv_catprogra
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA INSERTAR REGISTROS
	public function insertar($progra_codigo,$progra_nombre,$progra_email,$progra_usuadigi)
	{

		$sql="INSERT INTO programa (PROGRA_CODIGO, PROGRA_NOMBRE, PROGRA_EMAIL, PROGRA_USUADIGI, PROGRA_FECHDIGI,
				 		           PROGRA_HORADIGI)
		           VALUES('$progra_codigo','$progra_nombre','$progra_email','$progra_usuadigi',CURTIME(),CURDATE())";
		           		
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA EDITAR REGISTROS
	public function editar($progra_id,$progra_codigo,$progra_nombre,$progra_email,$progra_usuadigi)
	{
		$sql="UPDATE programa SET PROGRA_CODIGO='$progra_codigo',PROGRA_NOMBRE='$progra_nombre',
								 PROGRA_EMAIL='$progra_email',PROGRA_USUADIGI='$progra_usuadigi',
								 PROGRA_FECHDIGI=CURTIME(),PROGRA_HORADIGI=CURDATE()
							WHERE PROGRA_ID='$progra_id'";
		return ejecutarConsulta($sql);

	}

	//SE IMPLEMENTA METODO PARA ELIMINAR REGISTROS 
	public function eliminar($progra_id)
	{
		$sql="DELETE FROM programa WHERE PROGRA_ID='$progra_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR LOS DATOS DE UN REGISTRO 
	public function mostrar($progra_id)
	{
		$sql="SELECT PROGRA_ID,PROGRA_CODIGO, PROGRA_NOMBRE, PROGRA_EMAIL, PROGRA_USUADIGI, PROGRA_FECHDIGI, PROGRA_HORADIGI
		      FROM programa WHERE PROGRA_ID='$progra_id'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS
	public function listarUsua(){
		$sql="SELECT USUARI_ID, USUARI_NOMBRES, USUARI_USUARIO
		      FROM usuario ORDER BY USUARI_NOMBRES";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA LISTAR LOS REGISTROS Y MOSTRARLOS EN UN SELECT
	public function select(){
		$sql="SELECT PROGRA_ID,PROGRA_CODIGO, PROGRA_NOMBRE, PROGRA_EMAIL, PROGRA_USUADIGI, PROGRA_FECHDIGI, PROGRA_HORADIGI
		      FROM programa";
		return ejecutarConsulta($sql);
	}
}


?>