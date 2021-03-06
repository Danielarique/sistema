<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Privil_Modulo
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS
	public function listar(){
		$sql="SELECT m.MODULO_NOMBRE AS MODULO_NOMBRE, pm.PRIVIL_ID AS PRIVIL_ID
			  FROM privil_modulo AS pm INNER JOIN modulo AS m ON(pm.MODULO_ID=m.MODULO_ID)";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA ELIMINAR TODOS LOS PRIVILEGIOS DE MODULO DEL USUARIO 
	public function eliminar($usuari_id){
		$sql="DELETE FROM privil_modulo WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}

}


?>