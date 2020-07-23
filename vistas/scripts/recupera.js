

//FUNCION QUE SE EJECUTA AL INICIO
function init(){
	

	$("#frmRecuCont").on("submit",function(e){
		
		if($("#email").val()==""){
			bootbox.alert('Debe diligenciar campo Email');
			return false;
		}
		//e.preventDefault();
		email=$("#email").val();
		$.post("../ajax/usuario.php?op=recuperar&email="+email,function(data){	
				alert(data);
			/*    if(data!="null"){
					$(location).attr("href","home.php");
			    }
			    else{
					bootbox.alert("Usuario y/o Password incorrectos");
				}*/
		});
	});	

}



init();