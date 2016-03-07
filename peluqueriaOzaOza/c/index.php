<?php
 	require "../m/medotos.php";
 	require "../m/metodos.php";
	session_start();
	
	unset($_SESSION["usuario"]);
	unset($_SESSION["nombre"]);
	
	$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
	$contraseña = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : '';	
	
	if ($usuario != "" && $contraseña != "") {
		$resultado = inicioSesion($usuario, $contraseña);
		
		if ($resultado->num_rows > 0) {
			$_SESSION["usuario"] = $usuario;
			echo getTemplateTocho("menu", '{usuario}', $usuario);
		} else {
			echo getTemplateTocho("inicio", '{mensajito}', "Usuario o contraseña incorrectos");
		}
	} else {
		echo getTemplateTocho("inicio", '{mensajito}', "");
	}
?>