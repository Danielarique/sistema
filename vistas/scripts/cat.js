var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		
		if($("#cat_codigo").val()==""){
			bootbox.alert('Debe diligenciar campo Codigo');
			return false;
		}else if($("#cat_codigogci").val()==""){
			bootbox.alert('Debe diligenciar campo Codigo GCI');
			return false;
		}else if($("#cat_nombre").val()==""){
			bootbox.alert('Debe diligenciar campo Nombre');
			return false;
		}else if($("#cat_email").val()==""){
			bootbox.alert('Debe diligenciar campo Email');
			return false;
		}
		guardaryeditar(e);
		
	});
	
}

//FUNCION PARA LIMPIAR CAMPOS
function limpiar()
{
	$("#cat_codigo").val("");
	$("#cat_codigogci").val("");
	$("#cat_nombre").val("");
	$("#cat_email").val("");
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
					url: '../ajax/cat.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
					//	console.log(e.responseText);	
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
		url: "../ajax/cat.php?op=guardaryeditar",
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

function mostrar(cat_id){
	$.post("../ajax/cat.php?op=mostrar",{cat_id : cat_id}, function(data,status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#cat_id").val(data.CAT_ID);
		$("#cat_codigo").val(data.CAT_CODIGO);
		$("#cat_codigogci").val(data.CAT_CODIGOGCI);
		$("#cat_nombre").val(data.CAT_NOMBRE);
		$("#cat_email").val(data.CAT_EMAIL);
	})
}

function eliminar(cat_id){
	bootbox.confirm("¿Está seguro de eliminar Cat??", function(result){
		if(result){
			$.post("../ajax/cat.php?op=eliminar",{cat_id : cat_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();