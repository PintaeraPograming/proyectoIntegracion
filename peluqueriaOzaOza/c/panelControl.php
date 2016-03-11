<?php
	// Importamos los archivos php que contienen los metodos necesarios.
 	require "../m/baseDatos.php";
 	require "../m/metodos.php";
	
 	// Recogemos toda la información del formulario.
 	// En caso de que no este definido algun parametro, se le asigna el valor ''.
 	$gesCitas = isset($_POST["gesCitas"]) ? $_POST["gesCitas"] : '';
 	$usuarios = isset($_POST["usuarios"]) ? $_POST["usuarios"] : '';
 	$verCitas = isset($_POST["verCitas"]) ? $_POST["verCitas"] : '';
 	$salir = isset($_POST["salir"]) ? $_POST["salir"] : '';
 	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
 	
 	// Se comprueba que el usuario que accede al panel de control es admin
 	// En caso afirmativo se llama a la plantilla y se imprime por pantalla.
 	// En caso contrario se redirije a la pagina de inicio
	if ($usuario == "admin") {
		echo getTemplateTocho("panelControl", '{usuario}', $usuario);
	} else {
		header('Location: index.php');
	}
	
	// Se realizan las redirecciones.
	// Redirecciona a la pagina de gestion de citas.
	if($gesCitas != ""){
		header('Location: citaAdmin.php');
	}
	// Redirecciona a la pagina de citas del administrador.
	if($verCitas != ""){
		header('Location: misCitasAdmin.php');
	}
	// Redirecciona a la pagina de gestion de usuario.
	if($usuarios != ""){
		header('Location: gestionUsuario.php');
	}
	// Redirecciona a la pagina de inicio.
	if($salir != ""){
		unset($_SESSION["usuario"]);
		header('Location: index.php');
	}
?>