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
	public function insertar($usuari_id,$cats,$privcat_usuadigi)
	{		

		//SE ELIMINAN TODOS LOS PERMISOS ASIGNADOS PARA VOLVERLOS A REGISTRAR
		$sqldel="DELETE FROM privilegio_cat WHERE USUARI_ID='$usuari_id'";
		ejecutarConsulta($sqldel);

		$num_elementos = 0;
		$sw=true;
		if($cats != ""){
			while($num_elementos < count($cats)){
				$sql_detalle="INSERT INTO privilegio_cat (CAT_ID,USUARI_ID,PRIVIL_USUADIGI,PRIVIL_FECHDIGI,
										  PRIVIL_HORADIGI)
							  VALUES('$cats[$num_elementos]','$usuari_id','$privcat_usuadigi',CURDATE(),
							  		CURTIME())";
				ejecutarConsulta($sql_detalle) or $sw =false;

				$num_elementos = $num_elementos+1;
			}

		}
		return $sw;

	}


	//SE IMPLEMENTA METODO PARA MOSTRAR LOS PRIVILEGIOS DEL CAT QUE TENGA EL USUARIO
	public function listarmarcados($usuari_id){
		$sql="SELECT pc.PRIVIL_ID AS PRIVIL_ID, pc.CAT_ID AS CAT_ID, ca.CAT_NOMBRE AS CAT_NOMBRE
			  FROM privilegio_cat AS pc INNER JOIN cat AS ca ON(pc.CAT_ID=ca.CAT_ID)
		      WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA ELIMINAR LOS PRIVILEGIOS DEL CAT QUE TENGA EL USUARIO
	public function eliminar($usuari_id){
		$sql="DELETE FROM privilegio_cat WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}
}


?>