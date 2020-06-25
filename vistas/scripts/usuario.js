var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		
		if($("#usuari_nombres").val()==""){
			bootbox.alert('Debe diligenciar campo Nombres');
			return false;
		}else if($("#usuari_usuario").val()==""){
			bootbox.alert('Debe diligenciar campo Usuario');
			return false;
		}else if($("#usuari_password").val()==""){
			bootbox.alert('Debe diligenciar campo Password');
			return false;
		}else if($("#usuari_email").val()==""){
			bootbox.alert('Debe diligenciar campo Email');
			return false;
		}else if($("#usuari_rol").val()==""){
			bootbox.alert('Debe diligenciar campo Rol');
			return false;
		}else if($("#usuari_estado").val()==""){
			bootbox.alert('Debe diligenciar campo Estado');
			return false;
		}	
		guardaryeditar(e);
		
		
	});
	$.post("../ajax/usuario.php?op=privil_modulo&id=", function(r){
		$("#privil_modulo").html(r);
	});
	
}

//FUNCION PARA LIMPIAR CAMPOS
function limpiar()
{
	$("#usuari_nombres").val("");
	$("#usuari_usuario").val("");
	$("#usuari_password").val("");
	$("#usuari_email").val("");
	$("#usuari_rol").val("");
	$("#usuari_estado").val("");
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
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/usuario.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 20,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden),
	    
	}).DataTable();
}

//FUNCION PARA GUARDAR Y EDITAR
function guardaryeditar(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
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

function mostrar(usuari_id){
	$.post("../ajax/usuario.php?op=mostrar",{usuari_id : usuari_id}, function(data,status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		//console.log(data);
		$("#usuari_id").val(data.USUARI_ID);
		$("#usuari_nombres").val(data.USUARI_NOMBRES);
		$("#usuari_usuario").val(data.USUARI_USUARIO);
		$("#usuari_password").val(data.USUARI_PASSWORD);
		$("#usuari_email").val(data.USUARI_EMAIL);
		$("#usuari_rol").val(data.USUARI_ROL);
		$("#usuari_estado").val(data.USUARI_ESTADO);
	});

	$.post("../ajax/usuario.php?op=privil_modulo&id="+usuari_id, function(r){
			$("#privil_modulo").html(r);
		});
}

function eliminar(usuari_id){
	bootbox.confirm("¿Está seguro de eliminar Usuario??", function(result){
		if(result){
			$.post("../ajax/usuario.php?op=eliminar",{usuari_id : usuari_id}, function(e){

				bootbox.alert(e);
				tabla.ajax.reload();
			});
			
		}
	})
}

init();