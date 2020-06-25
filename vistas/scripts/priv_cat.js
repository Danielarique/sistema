var tabla;
//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	listar();
	$("#listCats").on("submit",function(e){
		guardar(e);		
	});	
}

function listar()
{	
	usuari_id = $("#usuari_id").val();
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            	
		        ],
		"ajax":
				{
					url: '../ajax/priv_cat.php?op=priv_cat&usuari_id='+usuari_id,
					type : "get",
					dataType : "json",						
					error: function(e){
						//console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 30,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden),
	    
	}).DataTable();
}

//FUNCION PARA GUARDAR Y EDITAR
function guardar(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#listCats")[0]);
	$.ajax({
		url: "../ajax/priv_cat.php?op=guardar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);        
	          tabla.ajax.reload();
	    }

	});
}

init();