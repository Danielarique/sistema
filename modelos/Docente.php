<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Docente
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA INSERTAR REGISTROS
	public function insertar($docent_documento,$docent_lugarexp,$docent_nombre,$docent_fechaing,$docent_perfil,$docent_residencia,$docent_telefono,$docent_celular,$docent_emailinst,$docent_emailpers,$docent_planta,$docent_grupos,$docent_usuadigi)
	{

		$sql="INSERT INTO docentes (DOCENT_DOCUMENTO, DOCENT_LUGAREXP, DOCENT_NOMBRE, DOCENT_FECHAING, DOCENT_PERFIL,
		                            DOCENT_RESIDENCIA,DOCENT_TELEFONO, DOCENT_CELULAR, DOCENT_EMAILINST, DOCENT_EMAILPERS,
		                            DOCENT_PLANTA, DOCENT_GRUPOS,DOCENT_USUADIGI, DOCENT_FECHDIGI,DOCENT_HORADIGI)
		           VALUES('$docent_documento','$docent_lugarexp','$docent_nombre','$docent_fechaing','$docent_perfil','$docent_residencia','$docent_telefono', '$docent_celular','$docent_emailinst','$docent_emailpers','$docent_planta','$docent_grupos','$docent_usuadigi',CURDATE(),CURTIME())";
		           		
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA EDITAR REGISTROS
	public function editar($docent_id,$docent_documento,$docent_lugarexp,$docent_nombre,$docent_fechaing,$docent_perfil,$docent_residencia,$docent_telefono, $docent_celular,$docent_emailinst,$docent_emailpers,$docent_planta,$docent_grupos,$docent_usuadigi)
	{
		$sql="UPDATE docentes SET DOCENT_DOCUMENTO='$docent_documento',DOCENT_LUGAREXP='$docent_lugarexp',
								 DOCENT_NOMBRE='$docent_nombre',DOCENT_FECHAING='$docent_fechaing',
								 DOCENT_PERFIL='$docent_perfil',DOCENT_RESIDENCIA='$docent_residencia',
								 DOCENT_TELEFONO='$docent_telefono',DOCENT_CELULAR='$docent_celular',
								 DOCENT_EMAILINST='$docent_emailinst',DOCENT_EMAILPERS='$docent_emailpers',
								 DOCENT_PLANTA='$docent_planta', DOCENT_GRUPOS='$docent_grupos',
								 DOCENT_USUADIGI='$docent_usuadigi',DOCENT_FECHDIGI=CURDATE(), DOCENT_HORADIGI=CURTIME() 
							WHERE DOCENT_ID='$docent_id'";
		return ejecutarConsulta($sql);

	}

	//SE IMPLEMENTA METODO PARA ELIMINAR REGISTROS 
	public function eliminar($docent_id)
	{
		$sql="DELETE FROM docentes WHERE DOCENT_ID='$docent_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR LOS DATOS DE UN REGISTRO 
	public function mostrar($docent_id)
	{
		$sql="SELECT DOCENT_ID,DOCENT_DOCUMENTO, DOCENT_LUGAREXP, DOCENT_NOMBRE, DOCENT_FECHAING, DOCENT_PERFIL,
					 DOCENT_RESIDENCIA,DOCENT_TELEFONO, DOCENT_CELULAR, DOCENT_EMAILINST, DOCENT_EMAILPERS, DOCENT_PLANTA,
					 DOCENT_GRUPOS
		      FROM docentes WHERE DOCENT_ID='$docent_id'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS
	public function listar(){
		$sql="SELECT DOCENT_ID,DOCENT_DOCUMENTO, DOCENT_LUGAREXP, DOCENT_NOMBRE, DOCENT_FECHAING, SUBSTRING(DOCENT_PERFIL,1,30) AS DOCENT_PERFIL, 
		             DOCENT_RESIDENCIA,DOCENT_TELEFONO, DOCENT_CELULAR, DOCENT_EMAILINST, DOCENT_EMAILPERS, DOCENT_PLANTA,
		             DOCENT_GRUPOS
		      FROM docentes";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR EL PERFIL EN ALERT
	public function mostrarPer($docent_id){
		$sql="SELECT DOCENT_PERFIL
		      FROM docentes  WHERE DOCENT_ID='$docent_id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR RESULTRADOS DEL FILTRO
	public function buscDoce($busq){
		$sql="SELECT DOCENT_ID, DOCENT_DOCUMENTO, DOCENT_NOMBRE
		      FROM docentes  WHERE DOCENT_DOCUMENTO LIKE '%$busq%' OR DOCENT_NOMBRE LIKE '%$busq%'";

		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA CONSULTAR ID DE DOCENTE CON EL DOCUMENTO
	public function infoDocent($docent_document){
		$sql="SELECT DOCENT_ID
		      FROM docentes  WHERE DOCENT_DOCUMENTO = '$docent_document'";

		return ejecutarConsulta($sql);
	}	
	
}


?>