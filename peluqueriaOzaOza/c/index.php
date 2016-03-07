<?php
 	require "../m/medotos.php";
 	require "../m/metodos.php";
	session_start();
	
	unset($_SESSION["usuario"]);
	unset($_SESSION["nombre"]);
	
	$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
	$contraseņa = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : '';	
	
	if ($usuario != "" && $contraseņa != "") {
		$resultado = inicioSesion($usuario, $contraseņa);
		
		if ($resultado->num_rows > 0) {
			$_SESSION["usuario"] = $usuario;
			echo getTemplateTocho("menu", '{usuario}', $usuario);
		} else {
			echo getTemplateTocho("inicio", '{mensajito}', "Usuario o contraseņa incorrectos");
		}
	} else {
		echo getTemplateTocho("inicio", '{mensajito}', "");
	}
?>