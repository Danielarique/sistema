var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	mostrarform(false);
	listar();

	$("#usuari_email").on('blur',function(eventObject) {
		var usuari_email = $("#usuari_email").val();
		var usuari_id = $("#usuari_id").val();
		var usuari_usuario = $("#usuari_usuario").val();
		if(usuari_email != ""){

			$.post("../ajax/usuario.php?op=email_existe&usuari_email="+usuari_email+
				"&usuari_id="+usuari_id, function(data){
				if(data>=1){
					bootbox.alert("Ya existe un usuario registrado con el email "+usuari_email);
					$("#usuari_email").val("");
				}
			});
		}

	}); 

	$("#usuari_usuario").on('blur',function(event) {
		var usuari_id = $("#usuari_id").val();
		var usuari_usuario = $("#usuari_usuario").val();
		$.post("../ajax/usuario.php?op=usuari_existe&usuari_usuario="+usuari_usuario+
			"&usuari_id="+usuari_id, function(data){
			if(data>=1){
				bootbox.alert("Ya existe un usuario registrado con el usuario "+usuari_usuario);
				$("#usuari_usuario").val("");
			}
		});

	});

	$("#formulario").on("submit",function(e){
		
		if($("#usuari_nombres").val()==""){
			bootbox.alert('Debe diligenciar campo Nombres');
			return false;
		}else if($("#usuari_usuario").val()==""){
			bootbox.alert('Debe diligenciar campo Usuario');
			return false;
		}else if($("#usuari_email").val()==""){
			bootbox.alert('Debe diligenciar campo Email');
			return false;
		}else if($("#usuari_estado").val()==""){
			bootbox.alert('Debe diligenciar campo Estado');
			return false;
		}
		if($("#usuari_id").val()==""){
			if($("#usuari_password").val()==""){
				bootbox.alert('Debe diligenciar campo Password');
				return false;
			}
		}

		guardaryeditar(e);
		
		
	});
	$.post("../ajax/usuario.php?op=privil_modulo&id=", function(r){
		$("#privil_modulo").html(r);
	});
	
}

/*VALIDACION PARA QUE EN ESTOS CAMPO SOLO SE PERMITAN LETRAS */
$('#usuari_nombres').keyup(function(e)                                {
	
	if (/[^a-zA-ZÁÉÍÓÚáéíóúñÑ ]/g.test(this.value))
	{
		bootbox.alert("Solo se permiten letras en este campo");
		this.value = this.value.replace(/[^a-zA-ZÁÉÍÓÚáéíóúñÑ ]/g, '');
	}
});

/*FUNCION PARA ELIMINAR ESPACIOS EN BLANCO*/
$("#usuari_usuario").keyup(function(){              
        var ta      =   $("#usuari_usuario");
        letras      =   ta.val().replace(/ /g, "");
        ta.val(letras)
});

/*VALIDACION PARA QUE EN ESTOS CAMPO SOLO SE PERMITAN EMAILS CORRECTOS */
$('#usuari_email').blur(function(e){  
	if(this.value != ""){
		re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
		if(!re.exec(this.value)){
			bootbox.alert("El email ingresado no tiene un formato válido");
			$('#usuari_email').val("");
		}
	}                              

});

/*VALIDACION PARA QUE EN EL CAMPO PASSWORD SE INGRESEN 6 CARACTERES O MÁS */
$('#usuari_password').blur(function(e){                    
	if((this.value).length < 6  && (this.value).length != 0){
		bootbox.alert("El password debe tener mínimo 6 caracteres");
		$('#usuari_password').val("");	
	}

});
//FUNCION PARA LIMPIAR CAMPOS
function limpiar()
{
	$("#usuari_id").val("");
	$("#usuari_nombres").val("");
	$("#usuari_usuario").val("");
	$("#usuari_password").val("");
	$("#usuari_email").val("");
	$("#usuari_estado").val("");
	$("#privil_modulo").val("");
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
						//console.log(e.responseText);	
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
		$("#usuari_password").val("");
		$("#usuari_email").val(data.USUARI_EMAIL);
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

function verEsta(estado){
	if(estado == 1){
		var esta = "Activo";
	}else{
		var esta = "Desactivo";
	}
	return esta;
}

init();