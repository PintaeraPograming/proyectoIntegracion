<?php
 	require "../m/baseDatos.php";
 	require "../m/metodos.php";
	
	unset($_SESSION["usuario"]);
	
	$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
	$contraseņa = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : '';	
	
	$registro = isset($_POST["registro"]) ? $_POST["registro"] : '';
	if($registro != ""){
		header('Location: registro.php');
	}
	
	if ($usuario != "" && $contraseņa != "") {
		$resultado = inicioSesion($usuario, $contraseņa);
		$_SESSION["usuario"] = $usuario;
		
		if ($usuario == "admin"){
			header('Location: panelControl.php');
		}else{
			if ($resultado->num_rows > 0) {
				header('Location: menu.php');
				echo getTemplateTocho("menu", '{usuario}', $usuario);
				exit();
			} else {
				echo getTemplateTocho("inicio", '{mensajito}', "Usuario o contraseņa incorrectos");
			}
		}
	} else {
		echo getTemplateTocho("inicio", '{mensajito}', "");
	}
?>