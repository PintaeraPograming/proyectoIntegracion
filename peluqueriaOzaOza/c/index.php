<?php
 	require "../m/baseDatos.php";
 	require "../m/metodos.php";
	
	unset($_SESSION["usuario"]);
	
	$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
	$contrase�a = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : '';	
	
	if ($usuario != "" && $contrase�a != "") {
		$resultado = inicioSesion($usuario, $contrase�a);
		$_SESSION["usuario"] = $usuario;
		
		if ($resultado->num_rows > 0) {
			header('Location: menu.php');
			echo getTemplateTocho("menu", '{usuario}', $usuario);
			exit();
		} else {
			echo getTemplateTocho("inicio", '{mensajito}', "Usuario o contrase�a incorrectos");
		}
	} else {
		echo getTemplateTocho("inicio", '{mensajito}', "");
	}
?>