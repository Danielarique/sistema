<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Cat
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA INSERTAR REGISTROS
	public function insertar($cat_codigo,$cat_codigogci,$cat_nombre,$cat_email,$cat_usuadigi)
	{

		$sql="INSERT INTO cat (CAT_CODIGO, CAT_CODIGOGCI, CAT_NOMBRE, CAT_EMAIL, CAT_USUADIGI, CAT_FECHDIGI,
				 		           CAT_HORADIGI)
		           VALUES('$cat_codigo','$cat_codigogci','$cat_nombre','$cat_email','$cat_usuadigi',CURDATE(),CURTIME())";
		           		
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA EDITAR REGISTROS
	public function editar($cat_id,$cat_codigo,$cat_codigogci,$cat_nombre,$cat_email,$cat_usuadigi)
	{
		$sql="UPDATE cat SET CAT_CODIGO='$cat_codigo',CAT_CODIGOGCI='$cat_codigogci',CAT_NOMBRE='$cat_nombre',
								 CAT_EMAIL='$cat_email',CAT_USUADIGI='$cat_usuadigi',
								 CAT_FECHDIGI=CURDATE(),CAT_HORADIGI=CURTIME()
							WHERE CAT_ID='$cat_id'";
		return ejecutarConsulta($sql);

	}

	//SE IMPLEMENTA METODO PARA ELIMINAR REGISTROS 
	public function eliminar($cat_id)
	{
		$sql="DELETE FROM cat WHERE CAT_ID='$cat_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR LOS DATOS DE UN REGISTRO 
	public function mostrar($cat_id)
	{
		$sql="SELECT CAT_ID,CAT_CODIGO, CAT_CODIGOGCI, CAT_NOMBRE, CAT_EMAIL, CAT_USUADIGI, CAT_FECHDIGI, CAT_HORADIGI
		      FROM cat WHERE CAT_ID='$cat_id'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS
	public function listar(){
		$sql="SELECT CAT_ID,CAT_CODIGO, CAT_CODIGOGCI, CAT_NOMBRE, CAT_EMAIL, CAT_USUADIGI, CAT_FECHDIGI, CAT_HORADIGI
		      FROM cat";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS EN LA VENTANA DE PRIVILEGIOS
	public function listarCat(){
		$sql="SELECT CAT_ID,CAT_CODIGO, CAT_NOMBRE
		      FROM cat";
		return ejecutarConsulta($sql);
	}
}


?>