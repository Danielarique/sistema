<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Priv_Cat
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA EDITAR PERMISOS DE CATS
	public function insertar($usuari_id,$cats)
	{		

		//SE ELIMINAN TODOS LOS PERMISOS ASIGNADOS PARA VOLVERLOS A REGISTRAR
		$sqldel="DELETE FROM privilegio_cat WHERE USUARI_ID='$usuari_id'";
		ejecutarConsulta($sqldel);

		$num_elementos = 0;
		$sw=true;

		while($num_elementos < count($cats)){
			$sql_detalle="INSERT INTO privilegio_cat (CAT_CODIGO,USUARI_ID)
						  VALUES('$cats[$num_elementos]','$usuari_id')";
			ejecutarConsulta($sql_detalle) or $sw =false;

			$num_elementos = $num_elementos+1;
		}
		return $sw;

	}


	//SE IMPLEMENTA METODO PARA MOSTRAR LOS PRIVILEGIOS DEL CAT QUE TENGA EL USUARIO
	public function listarmarcados($usuari_id){
		$sql="SELECT PRIVIL_ID, CAT_CODIGO FROM privilegio_cat  WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}
}


?>