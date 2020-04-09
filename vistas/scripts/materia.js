var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		
		if($("#materi_codigo").val()==""){
			bootbox.alert('Debe diligenciar campo Codigo');
			return false;
		}else if($("#materi_nombre").val()==""){
			bootbox.alert('Debe diligenciar campo Nombre');
			return false;
		}else if($("#progra_id").val()==""){
			bootbox.alert('Debe diligenciar campo Programa');
			return false;
		}else if($("#materi_planest").val()==""){
			bootbox.alert('Debe diligenciar campo Plan Estudio');
			return false;
		}
		guardaryeditar(e);
		
	});

	//SE CARGAN LOS ITEMS DEL SELECT PROGRAMA
	$.post("../ajax/materia.php?op=selectPrograma",function (r){
		$("#progra_id").html(r);
		$("#progra_id").selectpicker('refresh');
	})

	//SE CARGAN LOS ITEMS DEL SELECT PLAN ESTUDIOS Y SEMESTRE
	$.post("../ajax/materia.php?op=selectSemestre",function (m){
		$("#materi_planest").html(m);
		$("#materi_planest").selectpicker('refresh');
		$("#materi_semestre").html(m);
		$("#materi_semestre").selectpicker('refresh');
	})

	
}

//FUNCION PARA LIMPIAR CAMPOS
function limpiar()
{
	$("#materi_codigo").val("");
	$("#materi_nombre").val("");
	$("#progra_id").val("");
	$("#materi_planest").val("");
	$("#materi_semestre").val("");
	$("#materi_semes").val("");
	$("#materi_horascur").val("");
	$("#materi_horasart").val("");
	$("#materi_horaslidart").val("");
	$("#materi_horaprac").val("");
	$("#materi_perfilest").val("");
	$("#materi_actacurr").val("");
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
					url: '../ajax/materia.php?op=listar',
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
		url: "../ajax/materia.php?op=guardaryeditar",
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

function mostrar(materi_id){
	$.post("../ajax/materia.php?op=mostrar",{materi_id : materi_id}, function(data,status)
	{
		data = JSON.parse(data);
		mostrarform(true);
		$("#materi_id").val(data.MATERI_ID);
		$("#materi_codigo").val(data.MATERI_CODIGO);
		$("#materi_nombre").val(data.MATERI_NOMBRE);
		$("#progra_id").val(data.PROGRA_ID);
		$("#progra_id").selectpicker('refresh');
		$("#materi_planest").val(data.MATERI_PLANEST);
		$("#materi_planest").selectpicker('refresh');
		$("#materi_semestre").val(data.MATERI_SEMESTRE);
		$("#materi_semestre").selectpicker('refresh');
		$("#materi_semes").val(data.MATERI__SEMES);
		$("#materi_horascur").val(data.MATERI_HORASCUR);
		$("#materi_horasart").val(data.MATERI_HORASART);
		$("#materi_horaslidart").val(data.MATERI_HORASLIDART);
		$("#materi_horasprac").val(data.MATERI_HORASPRAC);
		$("#materi_perfilest").val(data.MATERI_PERFILEST);
		$("#materi_actacurr").val(data.MATERI_ACTACURR);
	})
}

function eliminar(materi_id){
	bootbox.confirm("¿Está seguro de eliminar Materia??", function(result){
		if(result){
			$.post("../ajax/materia.php?op=eliminar",{materi_id : materi_id}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function mostrarPer(materi_id){
	$.post("../ajax/materia.php?op=mostrarPer",{materi_id : materi_id}, function(data,status){
		//data = JSON.parse(data);
		//console.log(data);
		bootbox.alert(data);
		//bootbox.alert(data);
		//tabla.ajax.reload();
	});
}

init();