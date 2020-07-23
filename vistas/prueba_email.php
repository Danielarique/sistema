<?php 
$destinatario = 'danielarique9609@gmail.com';
$asunto = "prueba de email";
$mensaje = "Hola Esto es una prueba";

$exito = mail($destinatario,$asunto,$mensaje);

if($exito){
	echo "email enviado";
}else{
	echo "email fallido";
}
?>