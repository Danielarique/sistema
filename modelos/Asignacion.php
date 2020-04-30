<?php 
//SE INCLUYE ARCHIVO DE CONEXION A LA BD
require "../config/conexion.php";

Class Asigna
{	
	//SE CREA METODO CONSTRUCTOR
	public function _construct()
	{

	}

	//SE IMPLEMENTA METODO PARA INSERTAR REGISTROS
	public function insertar($cat_id,$despla_id,$materi_id,$docent_id,$grupo_id,$semana_id,$dia_id,$hora_id,$asigna_lidart,
				$asigna_salon,$asigna_observ,$asigna_usuadigi)
	{

		$sql="INSERT INTO asignacion (CAT_ID, DESPLA_ID, MATERI_ID, DOCENT_ID, ASIGNA_GRUPO,ASIGNA_SEMANA, DIA_ID, HORA_ID,  
						  			  ASIGNA_SALON, ASIGNA_LIDART, ASIGNA_OBSER, ASIGNA_USUADIGI, ASIGNA_FECHDIGI, ASIGNA_HORADIGI)
		           		  VALUES('$cat_id','$despla_id','$materi_id','$docent_id','$grupo_id','$semana_id','$dia_id','$hora_id',
		           		  		'$asigna_salon','$asigna_lidart','$asigna_observ','$asigna_usuadigi',CURDATE(),CURTIME())";
		           		
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA EDITAR REGISTROS
	public function editar($asigna_id,$cat_id,$despla_id,$materi_id,$docent_id,$grupo_id,$semana_id,$dia_id,$hora_id,$asigna_lidart,
				$asigna_salon,$asigna_observ,$asigna_usuadigi)
	{
		$sql="UPDATE asignacion SET CAT_ID='$cat_id',DESPLA_ID='$despla_id',MATERI_ID='$materi_id',
								 DOCENT_ID='$docent_id',ASIGNA_GRUPO='$grupo_id',
								 ASIGNA_SEMANA='$semana_id',
								 DIA_ID='$dia_id',HORA_ID='$hora_id',
								 ASIGNA_SALON='$asigna_salon',ASIGNA_LIDART='$asigna_lidart',
								 ASIGNA_OBSER='$asigna_observ',ASIGNA_USUADIGI='$asigna_usuadigi',
								 ASIGNA_FECHDIGI=CURDATE(),ASIGNA_HORADIGI=CURTIME()
							WHERE ASIGNA_ID='$asigna_id'";
		return ejecutarConsulta($sql);

	}

	//SE IMPLEMENTA METODO PARA ELIMINAR REGISTROS 
	public function eliminar($asigna_id)
	{
		$sql="DELETE FROM asignacion WHERE ASIGNA_ID='$asigna_id'";
		return ejecutarConsulta($sql);
	}

	//SE IMPLEMENTA METODO PARA MOSTRAR LOS DATOS DE UN REGISTRO 
	public function mostrar($asigna_id)
	{
		$sql="SELECT a.ASIGNA_ID AS ASIGNA_ID,a.CAT_ID AS CAT_ID,a.ASIGNA_GRUPO AS ASIGNA_GRUPO, a.MATERI_ID AS MATERI_ID,
		   			 a.ASIGNA_SEMANA AS ASIGNA_SEMANA,a.DIA_ID AS DIA_ID, a.HORA_ID AS HORA_ID,  
		   			 doc.DOCENT_DOCUMENTO AS DOCENT_DOCUMENTO, doc.DOCENT_NOMBRE AS DOCENT_NOMBRE, a.DESPLA_ID AS DESPLA_ID, 
		   			 a.ASIGNA_SALON AS ASIGNA_SALON,a.ASIGNA_LIDART AS ASIGNA_LIDART, a.ASIGNA_OBSER AS ASIGNA_OBSER
			  FROM   asignacion AS a
		 INNER JOIN  docentes AS doc ON(a.DOCENT_ID=doc.DOCENT_ID)
			WHERE    ASIGNA_ID='$asigna_id'";
		return ejecutarConsultaSimpleFila($sql);

	}

	//SE IMPLEMENTA METODO PARA MOSTRAR TODOS LOS REGISTROS
	public function listar(){
		$sql="SELECT a.ASIGNA_ID AS ASIGNA_ID,c.CAT_CODIGO AS CAT_CODIGO,c.CAT_NOMBRE AS CAT_NOMBRE,
					 pr.PROGRA_CODIGO AS PROGRA_CODIGO,pr.PROGRA_NOMBRE AS PROGRA_NOMBRE,ma.MATERI_SEMESTRE AS MATERI_SEMESTRE,
					 a.ASIGNA_GRUPO AS ASIGNA_GRUPO,a.MATERI_ID AS MATERI_ID,ma.MATERI_CODIGO AS MATERI_CODIGO,ma.MATERI_NOMBRE AS MATERI_NOMBRE,
					 SUBSTRING(ma.MATERI_PERFILEST,1,50) AS MATERI_PERFILEST,ma.MATERI_PERFILEST AS MATERI_PERFILEST2,a.ASIGNA_SEMANA AS ASIGNA_SEMANA, 
					 di.DIA_NOMBRE AS DIA_NOMBRE, ho.HORA_HORA AS HORA_HORA, ma.MATERI_HORASCUR AS MATERI_HORASCUR, 
					 ma.MATERI_HORASART AS MATERI_HORASART, ma.MATERI_HORASPRAC AS MATERI_HORASPRAC,
					 ma.MATERI_HORASLIDART AS MATERI_HORASLIDART,doc.DOCENT_ID AS DOCENT_ID, doc.DOCENT_DOCUMENTO AS DOCENT_DOCUMENTO, 
					 doc.DOCENT_NOMBRE AS DOCENT_NOMBRE, SUBSTRING(doc.DOCENT_PERFIL,1,50) AS DOCENT_PERFIL,
					 doc.DOCENT_RESIDENCIA AS DOCENT_RESIDENCIA, doc.DOCENT_TELEFONO AS DOCENT_TELEFONO, 
					 doc.DOCENT_CELULAR AS DOCENT_CELULAR,doc.DOCENT_EMAILINST AS DOCENT_EMAILINST, 
					 doc.DOCENT_EMAILPERS AS DOCENT_EMAILPERS, doc.DOCENT_PLANTA AS DOCENT_PLANTA, 
					 de.DESPLA_ORIGEN AS DESPLA_ORIGEN, de.DESPLA_DESTINO AS DESPLA_DESTINO, a.ASIGNA_SALON AS ASIGNA_SALON, 
					 a.ASIGNA_OBSER AS ASIGNA_OBSER
				FROM asignacion AS a
		  INNER JOIN cat AS c ON(a.CAT_ID=c.CAT_ID)
		  INNER JOIN materia ma ON(a.MATERI_ID=ma.MATERI_ID)
		  INNER JOIN docentes AS doc ON(a.DOCENT_ID=doc.DOCENT_ID)
		  INNER JOIN desplazamiento AS de ON(a.DESPLA_ID=de.DESPLA_ID)
		  INNER JOIN programa AS pr ON(ma.PROGRA_ID=pr.PROGRA_ID)
		  INNER JOIN dia AS di ON(a.DIA_ID=di.DIA_ID)
		  INNER JOIN hora AS ho ON(a.HORA_ID=ho.HORA_ID)" ;
		return ejecutarConsulta($sql);
	}

	public function mostrarPer($materi_id){
		$sql="SELECT MATERI_PERFILEST
		      FROM materia  WHERE MATERI_ID='$materi_id'";
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

	//FUNCION PARA MOSTRAR LOS CURSOS ASIGNADOS DEL DOCENTE INGRESADO
	public function cursosAsigna($docent_document){
		$sql="SELECT a.ASIGNA_ID AS ASIGNA_ID, doc.DOCENT_DOCUMENTO AS DOCENT_DOCUMENTO, doc.DOCENT_NOMBRE AS  DOCENT_NOMBRE
			 FROM asignacion AS a
			 INNER JOIN docentes AS doc ON(a.DOCENT_ID=doc.DOCENT_ID)
			 WHERE doc.DOCENT_DOCUMENTO = '$docent_document'";
		return ejecutarConsulta($sql);
	}


}


?>