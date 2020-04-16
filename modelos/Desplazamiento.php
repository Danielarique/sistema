<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Desplaza
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS EN LA VENTANA DE PRIVILEGIOS
	public function listDesp(){
		$sql="SELECT DESPLA_ID,DESPLA_ORIGEN, DESPLA_DESTINO
		      FROM desplazamiento";
		return ejecutarConsulta($sql);
	}
}


?>