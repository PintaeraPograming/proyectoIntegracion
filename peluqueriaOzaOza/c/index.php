<?php
 	require "../m/medotos.php";
 	require "../m/metodos.php";
	session_start();
	
	unset($_SESSION["usuario"]);
	unset($_SESSION["nombre"]);
	
	$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
	$contrase�a = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : '';	
	
	if ($usuario != "" && $contrase�a != "") {
		$resultado = inicioSesion($usuario, $contrase�a);
		
		if ($resultado->num_rows > 0) {
			$_SESSION["usuario"] = $usuario;
			echo getTemplateTocho("menu", '{usuario}', $usuario);
		} else {
			echo getTemplateTocho("inicio", '{mensajito}', "Usuario o contrase�a incorrectos");
		}
	} else {
		echo getTemplateTocho("inicio", '{mensajito}', "");
	}
?>