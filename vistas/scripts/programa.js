var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		
		if($("#progra_codigo").val()==""){
			bootbox.alert('Debe diligenciar campo Codigo');
			return false;
		}else if($("#progra_nombre").val()==""){
			bootbox.alert('Debe diligenciar campo Nombre');
			return false;
		}else if($("#progra_email").val()==""){
			bootbox.alert('Debe diligenciar campo Email');
			return false;
		}
		guardaryeditar(e);
		
	});

} 

/*VALIDACION PARA QUE EN ESTOS CAMPO SOLO SE PERMITAN DATOS NUMERICOS */
$('#progra_codigo').keyup(function(e)                                {
	if (/\D/g.test(this.value))
	{
	bootbox.alert("Solo se permiten datos númericos en este campo");
	this.value = this.value.replace(/\D/g, '');
	}
});

/*VALIDACION PARA QUE EN ESTOS CAMPO SOLO SE PERMITAN LETRAS */
$('#progra_nombre').keyup(function(e)                                {
	
	if (/[^a-zA-ZÁÉÍÓÚáéíóúñÑ ]/g.test(this.value))
	{
		bootbox.alert("Solo se permiten letras en este campo");
		this.value = this.value.replace(/[^a-zA-ZÁÉÍÓÚáéíóúñÑ ]/g, '');
	}
});

/*VALIDACION PARA QUE EN ESTOS CAMPO SOLO SE PERMITAN EMAILS CORRECTOS */
$('#progra_email').blur(function(e){  
	if(this.value != ""){
		re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
		if(!re.exec(this.value)){
			bootbox.alert("El email ingresado no tiene un formato válido");
			$('#progra_email').val("");
		}
	}                              

});


//FUNCION PARA LIMPIAR CAMPOS
function limpiar()
{
	$("#progra_id").val("");
	$("#progra_codigo").val("");
	$("#progra_nombre").val("");
	$("#progra_email").val("");
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
					url: '../ajax/programa.php?op=listar',
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
		url: "../ajax/programa.php?op=guardaryeditar",
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

function mostrar(progra_id){
	$.post("../ajax/programa.php?op=mostrar",{progra_id : progra_id}, function(data,status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#progra_id").val(data.PROGRA_ID);
		$("#progra_codigo").val(data.PROGRA_CODIGO);
		$("#progra_nombre").val(data.PROGRA_NOMBRE);
		$("#progra_email").val(data.PROGRA_EMAIL);
	})
}

function eliminar(progra_id){
	bootbox.confirm("¿Está seguro de eliminar Programa?", function(result){
		if(result){
			$.post("../ajax/programa.php?op=eliminar",{progra_id : progra_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();