function sinEspa(valor){
	var valor2 = valor.replace(/ /g, "");
	return valor2;
}

function numerico(e){
	var key = window.Event ? e.which : e.keyCode
	return ((key >= 48 && key <= 57) || (key==8))
	//alert(input);
}




