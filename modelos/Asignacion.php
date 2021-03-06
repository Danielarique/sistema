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
	    
		$asigna_id = ejecutarConsulta_retornarID($sql);

		/* SE REALIZA INSERCION EN TABLA DE AUDITORIA*/
		$sql_aud = "INSERT INTO aud_asignacion (ASIGNA_ID, CAT_ID, DESPLA_ID, MATERI_ID, DOCENT_ID, ASIGNA_GRUPO, ASIGNA_SEMANA,
												DIA_ID, HORA_ID, ASIGNA_SALON, ASIGNA_LIDART, ASIGNA_OBSER, ASIGNA_USUADIGI, 
												ASIGNA_FECHDIGI, ASIGNA_HORADIGI, AUDIT_OPERACION)
	           		VALUES('$asigna_id','$cat_id','$despla_id','$materi_id','$docent_id','$grupo_id','$semana_id','$dia_id',
	           		 		'$hora_id','$asigna_salon','$asigna_lidart','$asigna_observ','$asigna_usuadigi',CURDATE(),CURTIME(), 
	           		 		'I')";
	    return ejecutarConsulta($sql_aud);
	
		
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
		ejecutarConsulta($sql);

		/* SE REALIZA INSERCION EN TABLA DE AUDITORIA*/
		$sql_aud = "INSERT INTO aud_asignacion (ASIGNA_ID, CAT_ID, DESPLA_ID, MATERI_ID, DOCENT_ID, ASIGNA_GRUPO, ASIGNA_SEMANA,
												DIA_ID, HORA_ID, ASIGNA_SALON, ASIGNA_LIDART, ASIGNA_OBSER, ASIGNA_USUADIGI, 
												ASIGNA_FECHDIGI, ASIGNA_HORADIGI, AUDIT_OPERACION)
	           		VALUES('$asigna_id','$cat_id','$despla_id','$materi_id','$docent_id','$grupo_id','$semana_id','$dia_id',
	           		 		'$hora_id','$asigna_salon','$asigna_lidart','$asigna_observ','$asigna_usuadigi',CURDATE(),CURTIME(), 
	           		 		'U')";
	    return ejecutarConsulta($sql_aud);


	}

	//SE IMPLEMENTA METODO PARA ELIMINAR REGISTROS 
	public function eliminar($asigna_id,$asigna_usuadigi)
	{

		$sql_asigna="SELECT CAT_ID, DESPLA_ID,  MATERI_ID, DOCENT_ID, ASIGNA_GRUPO, ASIGNA_SEMANA, DIA_ID,  HORA_ID,  
		   			 ASIGNA_SALON,ASIGNA_LIDART, ASIGNA_OBSER
			  FROM   asignacion 
			WHERE    ASIGNA_ID='$asigna_id'";
		$result_asigna= ejecutarConsultaSimpleFila($sql_asigna);
 	
        $cat_id= $result_asigna['CAT_ID'];
 		$despla_id= $result_asigna['DESPLA_ID'];
 		$materi_id= $result_asigna['MATERI_ID'];
 		$docent_id= $result_asigna['DOCENT_ID'];
 		$asigna_grupo= $result_asigna['ASIGNA_GRUPO'];
 		$asigna_semana= $result_asigna['ASIGNA_SEMANA'];
 		$dia_id= $result_asigna['DIA_ID'];
 		$hora_id= $result_asigna['HORA_ID'];
 		$asigna_salon= $result_asigna['ASIGNA_SALON'];
 		$asigna_lidart= $result_asigna['ASIGNA_LIDART'];
 		$asigna_observ= $result_asigna['ASIGNA_OBSER'];
        
		$sql="DELETE FROM asignacion WHERE ASIGNA_ID='$asigna_id'";
		ejecutarConsulta($sql);

		/* SE REALIZA INSERCION EN TABLA DE AUDITORIA*/
		$sql_aud = "INSERT INTO aud_asignacion (ASIGNA_ID, CAT_ID, DESPLA_ID, MATERI_ID, DOCENT_ID, ASIGNA_GRUPO, ASIGNA_SEMANA,
												DIA_ID, HORA_ID, ASIGNA_SALON, ASIGNA_LIDART, ASIGNA_OBSER, ASIGNA_USUADIGI, 
												ASIGNA_FECHDIGI, ASIGNA_HORADIGI, AUDIT_OPERACION)
	           		VALUES('$asigna_id','$cat_id','$despla_id','$materi_id','$docent_id','$asigna_grupo','$asigna_semana','$dia_id',
	           		 		'$hora_id','$asigna_salon','$asigna_lidart','$asigna_observ','$asigna_usuadigi',CURDATE(),CURTIME(), 
	           		 		'D')";
	    return ejecutarConsulta($sql_aud);


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
		$sql="SELECT a.ASIGNA_ID AS ASIGNA_ID,c.CAT_ID AS CAT_ID,c.CAT_CODIGO AS CAT_CODIGO,c.CAT_NOMBRE AS CAT_NOMBRE,
					 pr.PROGRA_ID AS PROGRA_ID,pr.PROGRA_CODIGO AS PROGRA_CODIGO,pr.PROGRA_NOMBRE AS PROGRA_NOMBRE,ma.MATERI_SEMESTRE AS MATERI_SEMESTRE,
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

	//FUNCION PARA MOSTRAR LOS CURSOS ASIGNADOS DEL DOCENTE INGRESADO (PRIMERA VALIDACION)
	public function cursosAsigna($docent_document){
		$sql="SELECT a.ASIGNA_ID AS ASIGNA_ID, doc.DOCENT_DOCUMENTO AS DOCENT_DOCUMENTO, doc.DOCENT_NOMBRE AS  DOCENT_NOMBRE
			 FROM asignacion AS a
			 INNER JOIN docentes AS doc ON(a.DOCENT_ID=doc.DOCENT_ID)
			 WHERE doc.DOCENT_DOCUMENTO = '$docent_document'";
		return ejecutarConsulta($sql);
	}

	//FUNCION PARA CONSULTAR LOS CURSOS ASIGNADOS EL DOCENTE EN LA SEMANA,DIA Y HORA INGRESADA (SEGUNDA VALIDACION)
	public function cruceHorari($docent_document,$semana_id,$dia_id,$hora_id){
		$sql="SELECT a.ASIGNA_ID AS ASIGNA_ID, d.DOCENT_DOCUMENTO
			  FROM asignacion AS a
			  INNER JOIN dia AS di ON a.DIA_ID=di.DIA_ID
			  INNER JOIN hora AS ho ON a.HORA_ID=ho.HORA_ID
			  INNER JOIN docentes AS d ON a.DOCENT_ID=d.DOCENT_ID
			  WHERE a.ASIGNA_SEMANA='$semana_id' AND di.DIA_ID='$dia_id' AND ho.HORA_ID='$hora_id' 
			  AND d.DOCENT_DOCUMENTO='$docent_document'";
		return ejecutarConsulta($sql);
	}

	//FUNCION PARA CONSULTAR LOS CURSOS REGISTRADOS EN LA SEMANA, DIA, HORA, GRUPO, POROGRAMA, SEMESTRE 
	public function cruceMateri($materi_id,$semana_id,$dia_id,$hora_id,$grupo_id,$cat_id){
		$sql_materi="SELECT PROGRA_ID, MATERI_PLANEST, MATERI_SEMESTRE 
					FROM materia 
					WHERE MATERI_ID='$materi_id'";
                 		
 		$result_materias= ejecutarConsulta($sql_materi);
 		
        foreach ($result_materias as $res) {
                $progra_id= $res['PROGRA_ID'];
         		$materi_planes= $res['MATERI_PLANEST'];
         		$materi_semest= $res['MATERI_SEMESTRE'];
        }

		$sql="SELECT ASIGNA_ID,CAT_ID, ASIGNA_GRUPO, ASIGNA_SEMANA, DIA_ID, HORA_ID
			FROM asignacion
			WHERE asignacion.MATERI_ID IN (
			SELECT materia.MATERI_ID
			FROM materia
			WHERE materia.PROGRA_ID='$progra_id' AND materia.MATERI_PLANEST='$materi_planes' 
			AND materia.MATERI_SEMESTRE='$materi_semest') AND CAT_ID='$cat_id' AND ASIGNA_GRUPO='$grupo_id' 
			AND ASIGNA_SEMANA='$semana_id' AND DIA_ID='$dia_id' AND HORA_ID='$hora_id'";
			
		return ejecutarConsulta($sql);
	}

	//FUNCION PARA CONSULTAR SI LA MATERIA YA FUE ASIGNADA EN EL MISMO CAT Y GRUPO
	public function doblemateri($materi_id,$grupo_id,$cat_id){
		$sql="SELECT ASIGNA_ID 
			  FROM asignacion 
			  WHERE MATERI_ID='$materi_id' AND CAT_ID='$cat_id' AND ASIGNA_GRUPO='$grupo_id'"; 		

		return ejecutarConsulta($sql);
	}


}


?>