<!DOCTYPE html>
<html lang="en">
<head>
	<title>Asignación Académica</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../public/img/icono.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="../public/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="../public/css/font-awesome.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../public/css/util.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../public/css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../public/css/icon-font.min.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../public/img/fondo2.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Iniciar Sesión
				</span>
				<form class="login100-form -form p-b-33 p-t-5" name="frmAcceso" id="frmAcceso" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="logina" id="logina" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="clavea" id="clavea" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
				<!--	<div align="center" style="margin-top: 20px">
					<a href="recupera.php">Olvidé mi contraseña</a><br>	
					</div> -->

					<div class="container-login100-form-btn m-t-32">
						<button type="submit" class="login100-form-btn">
							Entrar
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	
	<script src="../public/js/jquery-3.1.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../public/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../public/js/bootbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="scripts/login.js"></script>
<!--===============================================================================================-->


</body>
</html>