<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Recuperar
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	
	public function generar_peticion($usuari_id,$url_secreta)
	{
		$sql="INSERT INTO recuperacion (USUARI_ID,RECUPE_URL, RECUPE_FECHDIGI, RECUPE_HORADIGI)
		           VALUES('$usuari_id','$url_secreta',CURDATE(),CURTIME())";
	
		return ejecutarConsulta($sql);
	}


	

}


?>