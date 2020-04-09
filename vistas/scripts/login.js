

//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	

	$("#frmAcceso").on("submit",function(e){
		
		if($("#logina").val()==""){
			bootbox.alert('Debe diligenciar campo Usuario');
			return false;
		}else if($("#clavea").val()==""){
			bootbox.alert('Debe diligenciar campo Contraseña');
			return false;
		}
		var logina = $("#logina").val();
		var clavea = $("#clavea").val();

		$.post("../ajax/usuario.php?op=verificar",
			{logina: logina, clavea: clavea},
		    function(data) {
				
				data = JSON.parse(data);
       			if(data != null){
            		$(location).attr('href', 'docente.php');
		        }else{
		           alert('Usuario y/o contraseña son incorrectos');
		      	}
			});	
	});	

}



init();