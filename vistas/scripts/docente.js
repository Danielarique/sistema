var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		
		if($("#docent_documento").val()==""){
			bootbox.alert('Debe diligenciar campo Documento');
			return false;
		}else if($("#docent_lugarexp").val()==""){
			bootbox.alert('Debe diligenciar campo Lugar de Expedición');
			return false;
		}else if($("#docent_nombre").val()==""){
			bootbox.alert('Debe diligenciar campo Nombre');
			return false;
		}else if($("#docent_perfil").val()==""){
			bootbox.alert('Debe diligenciar campo Perfil');
			return false;
		}else if($("#docent_residencia").val()==""){
			bootbox.alert('Debe diligenciar campo Residencia');
			return false;
		}else if($("#docent_celular").val()==""){
			bootbox.alert('Debe diligenciar campo Celular');
			return false;
		}else if($("#docent_emailpers").val()=="" && $("#docent_emailinst").val()==""){
			bootbox.alert('Debe diligenciar al menos un Campo de correo (Personal o  Institucional)');
			return false;
		}else if($("#docent_planta").val()==""){
			bootbox.alert('Debe diligenciar campo Es de planta?');
			return false;
		}else if($("#docent_grupos").val()==""){
			bootbox.alert('Debe diligenciar campo Grupos');
			return false;
		}

		guardaryeditar(e);
		
	});
	
}

//FUNCION PARA LIMPIAR CAMPOS
function limpiar()
{
	$("#docent_id").val("");
	$("#docent_documento").val("");
	$("#docent_lugaexp").val("");
	$("#docent_nombre").val("");
	$("#docent_fechaing").val("");
	$("#docent_perfil").val("");
	$("#docent_residencia").val("");
	$("#docent_telefono").val("");
	$("#docent_celular").val("");
	$("#docent_emailinst").val("");
	$("#docent_emailpers").val("");
	$("#docent_planta").val("");
	$("#docent_grupos").val("");
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
					url: '../ajax/docente.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
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
		url: "../ajax/docente.php?op=guardaryeditar",
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

function mostrar(docent_id){
	//alert(docent_id);
	$.post("../ajax/docente.php?op=mostrar",{docent_id : docent_id}, function(data,status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#docent_id").val(data.DOCENT_ID);
		$("#docent_documento").val(data.DOCENT_DOCUMENTO);
		$("#docent_lugarexp").val(data.DOCENT_LUGAREXP);
		$("#docent_nombre").val(data.DOCENT_NOMBRE);
		$("#docent_fechaing").val(data.DOCENT_FECHAING);
		$("#docent_perfil").val(data.DOCENT_PERFIL);
		$("#docent_residencia").val(data.DOCENT_RESIDENCIA);
		$("#docent_telefono").val(data.DOCENT_TELEFONO);
		$("#docent_celular").val(data.DOCENT_CELULAR);
		$("#docent_emailinst").val(data.DOCENT_EMAILINST);
		$("#docent_emailpers").val(data.DOCENT_EMAILPERS);
		$("#docent_planta").val(data.DOCENT_PLANTA);
		$("#docent_grupos").val(data.DOCENT_GRUPOS);

	})
}

function eliminar(docent_id){
	bootbox.confirm("¿Está seguro de eliminar Docente?", function(result){
		if(result){
			alert(result);
			$.post("../ajax/docente.php?op=eliminar",{docent_id : docent_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function mostrarPer(docent_id){
	$.post("../ajax/docente.php?op=mostrarPer",{docent_id : docent_id}, function(data,status){
		//data = JSON.parse(data);
		//console.log(data);
		bootbox.alert(data);
		//bootbox.alert(data);
		//tabla.ajax.reload();
	});
}

init();