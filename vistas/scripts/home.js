

//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	var usuari_id = $("#usuari_id").val();
	
	$.post("../ajax/priv_cat.php?op=priv_cat2&usuari_id="+usuari_id, function(r){
		$("#privil_cat").html(r);
	});

	$.post("../ajax/priv_progra.php?op=priv_progra2&usuari_id="+usuari_id, function(r){
		$("#privil_progra").html(r);
	});
	
}



init();