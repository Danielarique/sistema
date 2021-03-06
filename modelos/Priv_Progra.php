<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Priv_Progra
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA EDITAR PERMISOS DE CATS
	public function insertar($usuari_id,$programas,$privprogra_usuadigi)
	{		

		//SE ELIMINAN TODOS LOS PERMISOS ASIGNADOS PARA VOLVERLOS A REGISTRAR
		$sqldel="DELETE FROM privilegio_progra WHERE USUARI_ID='$usuari_id'";
		ejecutarConsulta($sqldel);

		$num_elementos = 0;
		$sw=true;
		if($programas != ""){

			while($num_elementos < count($programas)){
				$sql_detalle="INSERT INTO privilegio_progra (PROGRA_ID,USUARI_ID,PRIVIL_USUADIGI,
										  PRIVIL_FECHDIGI,PRIVIL_HORADIGI)
							  VALUES('$programas[$num_elementos]','$usuari_id','$privprogra_usuadigi',
							  		CURDATE(),CURTIME())";
				ejecutarConsulta($sql_detalle) or $sw =false;

				$num_elementos = $num_elementos+1;
			}
		}
		return $sw;

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR LOS PRIVILEGIOS DEL PROGRAMA QUE TENGA EL USUARIO
	public function listarmarcados($usuari_id){
		$sql="SELECT pp.PRIVIL_ID AS PRIVIL_ID, pp.PROGRA_ID AS PROGRA_ID, pr.PROGRA_NOMBRE AS PROGRA_NOMBRE 
			  FROM privilegio_progra AS pp INNER JOIN programa pr ON(pp.PROGRA_ID=pr.PROGRA_ID)  
			  WHERE pp.USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA ELIMINAR LOS PRIVILEGIOS DEL PROGRAMA QUE TENGA EL USUARIO
	public function eliminar($usuari_id){
		$sql="DELETE FROM privilegio_progra WHERE USUARI_ID='$usuari_id'";
		return ejecutarConsulta($sql);
	}
}


?>