var tabla;


//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	listar();
	
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
					url: '../ajax/priv_catprogra.php?op=listarUsua',
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

function mostrarCat(usuari_id){
	window.open("./priv_cat.php?usuari_id="+usuari_id, "Privilegios Cats" , "width=700,height=500,top=120px,left=300px,scrollbars=NO,Location=NO,titlebar=Privilegios Cats");
}

function mostrarProgra(usuari_id){
	window.open("./priv_progra.php?usuari_id="+usuari_id, "Privilegios Programas" , "width=700,height=500,top=120px,left=300px,scrollbars=NO,Location=NO,titlebar=Privilegios Programas");
}



init();