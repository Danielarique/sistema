var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	mostrarform(false);
	listar();
	 $(document).ready(function () {
	 	
        $('#docent_documento').typeahead({
            source: function (busqueda, resultado) {
                $.ajax({
                    url: "../ajax/asignacion.php?op=buscDoce",
					data: 'busqueda=' + busqueda,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						resultado($.map(data, function (item) {
                    	//console.log(item);
							return item;
                        }));
                    },     	
                });
            }
        });

        $('#docent_nombre').typeahead({
            source: function (busqueda, resultado) {
                $.ajax({
                    url: "../ajax/asignacion.php?op=buscDoce",
					data: 'busqueda=' + busqueda,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
						resultado($.map(data, function (item) {
                    	//console.log(item);
							return item;
                        }));
                    },	
                });
            }
        });
    });

	$("#formulario").on("submit",function(e){
		
		if($("#cat_id").val()==""){
			bootbox.alert('Debe diligenciar campo CAT');
			return false;
		}else if($("#despla_id").val()==""){
			bootbox.alert('Debe diligenciar campo Desplazamiento');
			return false;
		}else if($("#materi_id").val()==""){
			bootbox.alert('Debe diligenciar campo Materia');
			return false;
		}else if($("#docent_documento").val()==""){
			bootbox.alert('Debe diligenciar campo Documento');
			return false;
		}else if($("#docent_nombre").val()==""){
			bootbox.alert('Debe diligenciar campo Nombre');
			return false;
		}else if($("#grupo_id").val()==""){
			bootbox.alert('Debe diligenciar campo Grupo');
			return false;
		}else if($("#semana_id").val()==""){
			bootbox.alert('Debe diligenciar campo Semana');
			return false;
		}else if($("#dia_id").val()==""){
			bootbox.alert('Debe diligenciar campo Día');
			return false;
		}else if($("#hora_id").val()==""){
			bootbox.alert('Debe diligenciar campo Hora');
			return false;
		}else if($("#asigna_lidart").val()==""){
			bootbox.alert('Debe diligenciar campo Horas lider articulación');
			return false;
		}else if($("#asigna_salon").val()==""){
			bootbox.alert('Debe diligenciar campo Salón');
			return false;
		}
		guardaryeditar(e);
		
	});
	usuari_id = $("#usuari_id").val();
	//SE CARGAN LOS ITEMS DEL SELECT CAT, CON LOS PRIVILEGIOS DE CAT QUE TIENE EL USUARIO
	$.post("../ajax/asignacion.php?op=selectCat&usuari_id="+usuari_id,function (r){
		$("#cat_id").html(r);
		$("#cat_id").selectpicker('refresh');
	});

	//SE CARGAN LOS ITEMS DEL SELECT PLAN ESTUDIOS Y SEMESTRE
	$.post("../ajax/asignacion.php?op=selectDespla&usuari_id="+usuari_id,function (m){
		$("#despla_id").html(m);
		$("#despla_id").selectpicker('refresh');
	});

	//SE CARGAN LOS ITEMS DEL SELECT PLAN ESTUDIOS Y SEMESTRE
	$.post("../ajax/asignacion.php?op=selectMateria&usuari_id="+usuari_id,function (n){
		$("#materi_id").html(n);
		$("#materi_id").selectpicker('refresh');
	});

	
}

//FUNCION PARA INSERTAR INFORMACION DE LOS INPUT DEL DOCENTE
function autoco_docente(docent)
{
	var docent_info =  docent.split("-");
	var docent_documento =  docent_info[0];
	var docent_nombre = docent_info[1];
	$("#docent_documento").val(docent_documento);
	$("#docent_nombre").val(docent_nombre);
}


//FUNCION PARA MOSTRAR CURSOS ASIGNADOS AL DOCENTE
function cursos_asigna(){
	var docent_document =  $("#docent_documento").val();
	$.post("../ajax/asignacion.php?op=cursosAsigna&docent_document="+docent_document,function (r){
		bootbox.alert("Numero de cursos asignados al docente seleccionado: "+r);
	});
}

//FUNCION PARA LIMPIAR CAMPOS
function limpiar()
{
	$("#docent_documento").val("");
	$("#docent_nombre").val("");
	$("#asigna_lidart").val("");
	$("#asigna_salon").val("");
	$("#asigna_observ").val("");
}

//FUNCION PARA MOSTRAR FORMULARIOS
function mostrarform(flag)
{
	limpiar();
	if(flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
	}else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		//$("#btnGuardar").prop("disabled",true);	
	}
}


//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}


function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/asignacion.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden),
	    "scrollY": 400,
        "scrollX": true
	}).DataTable();
}

//FUNCION PARA GUARDAR Y EDITAR
function guardaryeditar(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/asignacion.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(asigna_id){
	$.post("../ajax/asignacion.php?op=mostrar",{asigna_id : asigna_id}, function(data,status)
	{ 
		data = JSON.parse(data);
		mostrarform(true);
		$("#asigna_id").val(data.ASIGNA_ID);
		$("#cat_id").val(data.CAT_ID);
		$("#cat_id").selectpicker('refresh');
		$("#despla_id").val(data.DESPLA_ID);
		$("#despla_id").selectpicker('refresh');
		$("#docent_documento").val(data.DOCENT_DOCUMENTO);
		$("#docent_nombre").val(data.DOCENT_NOMBRE);
		$("#materi_id").val(data.MATERI_ID);
		$("#materi_id").selectpicker('refresh');
		$("#grupo_id").val(data.ASIGNA_GRUPO);
		$("#semana_id").val(data.ASIGNA_SEMANA);
		$("#dia_id").val(data.DIA_ID);
		$("#hora_id").val(data.HORA_ID);
		$("#asigna_lidart").val(data.ASIGNA_LIDART);
		$("#asigna_salon").val(data.ASIGNA_SALON);
		$("#asigna_observ").val(data.ASIGNA_OBSER);
	})
}

function eliminar(asigna_id){
	bootbox.confirm("¿Está seguro de eliminar Asignación??", function(result){
		if(result){
			$.post("../ajax/asignacion.php?op=eliminar",{asigna_id : asigna_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//FUNCION PARA MOSTRAR EL PERFIL ESTABLECIDO POR MATERIA
function mostrarPer(materi_id){
	$.post("../ajax/materia.php?op=mostrarPer",{materi_id : materi_id}, function(data,status){	
		bootbox.alert(data);
	});
}

function mostPerDoc(docent_id){
	$.post("../ajax/docente.php?op=mostrarPer",{docent_id : docent_id}, function(data,status){	
		bootbox.alert(data);
	});
}

init();