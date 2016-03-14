<?php
	// Importamos los archivos php que contienen los metodos necesarios.
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	// Se elimina el usuaio de la session.
	unset ( $_SESSION ["usuario"] );
	
	// Recogemos toda la información del formulario.
	// En caso de que no este definido algun parametro, se le asigna el valor ''.
	$usuario = isset ( $_POST ["usuario"] ) ? $_POST ["usuario"] : '';
	$contraseña = isset ( $_POST ["contrasenia"] ) ? $_POST ["contrasenia"] : '';	
	$registro = isset ( $_POST ["registro"] ) ? $_POST ["registro"] : '';
	
	// Funcionalidad del boton.
	// Boton atras, redirecciona a la pagina del registro.
	if ($registro != "") {
		header ( 'Location: registro.php' );
	}
	
	// Se llama a la funcion inicioSession.
	// Se comprueba que el usuario y la contraseña son correctos.
	// En caso de ser admin se redirije al panel de control.
	// EN caso de ser usuario normal se redirije al menu.
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
			echo getTemplateTocho ( "inicio", '{mensaje}', "Usuario o contrase&ntilde;a incorrectos" );
		}
	} else {
		echo getTemplateTocho ( "inicio", '{mensaje}', "" );
	}
?>