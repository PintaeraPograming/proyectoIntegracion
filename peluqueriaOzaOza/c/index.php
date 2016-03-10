<?php
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	unset ( $_SESSION ["usuario"] );
	
	$usuario = isset ( $_POST ["usuario"] ) ? $_POST ["usuario"] : '';
	$contraseña = isset ( $_POST ["contrasenia"] ) ? $_POST ["contrasenia"] : '';
		
	$registro = isset ( $_POST ["registro"] ) ? $_POST ["registro"] : '';
	if ($registro != "") {
		header ( 'Location: registro.php' );
	}
	
	if ($usuario != "" && $contraseña != "") {
		$resultado = inicioSesion ($usuario, md5($contraseña));
		$_SESSION ["usuario"] = $usuario;
		
		if ($resultado->num_rows > 0) {
			if ($usuario == "admin") {
				header ( 'Location: panelControl.php' );
			} else {
				header ( 'Location: menu.php' );
				echo getTemplateTocho ( "menu", '{usuario}', $usuario );
			}
		} else {
			echo getTemplateTocho ( "inicio", '{mensajito}', "Usuario o contraseña incorrectos" );
		}
	} else {
		echo getTemplateTocho ( "inicio", '{mensajito}', "" );
	}
?>