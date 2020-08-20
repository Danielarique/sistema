<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Materia
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA INSERTAR REGISTROS
	public function insertar($materi_codigo,$materi_nombre,$progra_id,$materi_planest,$materi_semestre,$materi_horascur,$materi_horasart,$materi_horaslidart,$materi_horasprac,$materi_perfilest,$materi_actacurr,$materi_usuadigi)
	{

		$sql="INSERT INTO materia (MATERI_CODIGO, MATERI_NOMBRE, PROGRA_ID, MATERI_PLANEST, MATERI_SEMESTRE,
				 		           MATERI_HORASCUR, MATERI_HORASART, MATERI_HORASLIDART, MATERI_HORASPRAC, MATERI_PERFILEST, 
				 		           MATERI_ACTACURR, MATERI_USUADIGI, MATERI_FECHDIGI, MATERI_HORADIGI)
		           VALUES('$materi_codigo','$materi_nombre','$progra_id','$materi_planest','$materi_semestre',
		           '$materi_horascur','$materi_horasart','$materi_horaslidart','$materi_horasprac','$materi_perfilest',
		           '$materi_actacurr','$materi_usuadigi',CURDATE(),CURTIME())";
		           		
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA EDITAR REGISTROS
	public function editar($materi_id,$materi_codigo,$materi_nombre,$progra_id,$materi_planest,$materi_semestre,$materi_horascur,$materi_horasart,$materi_horaslidart,$materi_horasprac,$materi_perfilest,$materi_actacurr,
		$materi_usuadigi)
	{
		$sql="UPDATE materia SET MATERI_CODIGO='$materi_codigo',MATERI_NOMBRE='$materi_nombre',PROGRA_ID='$progra_id',
								 MATERI_PLANEST='$materi_planest',MATERI_SEMESTRE='$materi_semestre',
								 MATERI_HORASCUR='$materi_horascur',
								 MATERI_HORASART='$materi_horasart',MATERI_HORASLIDART='$materi_horaslidart',
								 MATERI_HORASPRAC='$materi_horasprac',MATERI_PERFILEST='$materi_perfilest',
								 MATERI_ACTACURR='$materi_actacurr',MATERI_USUADIGI='$materi_usuadigi',
								 MATERI_FECHDIGI=CURDATE(),MATERI_HORADIGI=CURTIME()
							WHERE MATERI_ID='$materi_id'";
		return ejecutarConsulta($sql);

	}

	//SE IMPLEMENTA METODO PARA ELIMINAR REGISTROS 
	public function eliminar($materi_id)
	{
		$sql="DELETE FROM materia WHERE MATERI_ID='$materi_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR LOS DATOS DE UN REGISTRO 
	public function mostrar($materi_id)
	{
		$sql="SELECT M.MATERI_ID,M.MATERI_CODIGO, M.MATERI_NOMBRE,  P.PROGRA_ID AS PROGRA_ID, P.PROGRA_CODIGO AS 
		PROGRA_CODIGO, M.MATERI_PLANEST, M.MATERI_SEMESTRE,M.MATERI_HORASCUR, M.MATERI_HORASART, M.MATERI_HORASLIDART, 
			M.MATERI_HORASPRAC, M.MATERI_PERFILEST,M.MATERI_ACTACURR, M.MATERI_USUADIGI,M.MATERI_FECHDIGI, M.MATERI_HORADIGI
		      FROM materia  AS M LEFT JOIN programa AS P ON (M.PROGRA_ID=P.PROGRA_ID) 
		      LEFT JOIN semestre AS S ON(M.MATERI_PLANEST=S.SEMEST_ID)
		      WHERE MATERI_ID='$materi_id'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS
	public function listar(){
		$sql="SELECT M.MATERI_ID,M.MATERI_CODIGO, M.MATERI_NOMBRE, P.PROGRA_CODIGO AS PROGRA_CODIGO, M.MATERI_PLANEST,
					S.SEMEST_NOMBRE AS PLANEST, SE.SEMEST_NOMBRE AS SEMESTRE,M.MATERI_SEMESTRE,M.MATERI_HORASCUR,
					M.MATERI_HORASART, M.MATERI_HORASLIDART, M.MATERI_HORASPRAC,SUBSTRING(M.MATERI_PERFILEST,1,30) 
					AS MATERI_PERFILEST,M.MATERI_ACTACURR,M.MATERI_USUADIGI, M.MATERI_FECHDIGI, M.MATERI_HORADIGI
		      FROM materia  AS M LEFT JOIN programa AS P ON (M.PROGRA_ID=P.PROGRA_ID)
		      LEFT JOIN semestre AS S ON(M.MATERI_PLANEST=S.SEMEST_ID)
		      LEFT JOIN semestre AS SE ON(M.MATERI_SEMESTRE=SE.SEMEST_ID)" ;
		return ejecutarConsulta($sql);
	}

	public function mostrarPer($materi_id){
		$sql="SELECT MATERI_PERFILEST FROM materia  WHERE MATERI_ID='$materi_id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//FUNCION PARA LISTAR MATERIAS SEGUN LOS PERMISOS DE PROGRAMA QUE TENGA EL USUARIO
	public function listmate($usuari_id){
		$sql="SELECT ma.MATERI_ID AS MATERI_ID, ma.MATERI_CODIGO AS MATERI_CODIGO,ma.MATERI_NOMBRE AS MATERI_NOMBRE,
			 pr.PROGRA_CODIGO AS PROGRA_CODIGO
			 FROM privilegio_progra AS pp
			 INNER JOIN programa AS pr ON(pp.PROGRA_ID=pr.PROGRA_ID)
			 INNER JOIN materia AS ma ON(pr.PROGRA_ID=ma.PROGRA_ID) 
			 WHERE pp.USUARI_ID='$usuari_id'
			 ORDER BY pr.PROGRA_CODIGO,ma.MATERI_SEMESTRE";
		return ejecutarConsulta($sql);
	}


}


?>