

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
		e.preventDefault();
	logina=$("#logina").val();
	clavea=$("#clavea").val();
 
	$.post("../ajax/usuario.php?op=verificar",
		{"logina":logina,"clavea":clavea},
		function(data){	
			
		    if(data!="null"){
			$(location).attr("href","usuario.php");
		    }
		    else{
			bootbox.alert("Usuario y/o Password incorrectos");
			}
		});
	});	

}



init();