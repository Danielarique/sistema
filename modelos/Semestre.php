<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Semestre
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA LISTAR LOS REGISTROS Y MOSTRARLOS EN UN SELECT
	public function selectSemestre(){
		echo $sql="SELECT SEMEST_ID,SEMEST_NOMBRE
		      FROM semestre";
		return ejecutarConsulta($sql);
	}
}


?>