<?php
 	require "../m/baseDatos.php";
 	require "../m/metodos.php";
	
	unset($_SESSION["usuario"]);
	
	$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
	$contraseña = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : '';	
	
	if ($usuario != "" && $contraseña != "") {
		$resultado = inicioSesion($usuario, $contraseña);
		$_SESSION["usuario"] = $usuario;
		
		if ($resultado->num_rows > 0) {
			header('Location: menu.php');
			echo getTemplateTocho("menu", '{usuario}', $usuario);
			exit();
		} else {
			echo getTemplateTocho("inicio", '{mensajito}', "Usuario o contraseña incorrectos");
		}
	} else {
		echo getTemplateTocho("inicio", '{mensajito}', "");
	}
?>