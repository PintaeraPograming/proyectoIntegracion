<?php
 	require "../m/baseDatos.php";
 	require "../m/metodos.php";
	
 	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
 	
	if ($usuario == "admin") {
		echo getTemplateTocho("panelControl", '{usuario}', $usuario);
	} else {
		header('Location: index.php');
	}
	
	$gesCitas = isset($_POST["gesCitas"]) ? $_POST["gesCitas"] : '';
	$usuarios = isset($_POST["usuarios"]) ? $_POST["usuarios"] : '';
	$verCitas = isset($_POST["verCitas"]) ? $_POST["verCitas"] : '';
	$salir = isset($_POST["salir"]) ? $_POST["salir"] : '';
	
	if ($gesCitas != "" && $usuarios != "" && $verCitas != "" && $salir != "") {
		//echo "<script>document.location.reload();</script>";
	
	}else{
		if($gesCitas != ""){
			header('Location: citaAdmin.php');
		}
		if($verCitas != ""){
			header('Location: misCitasAdmin.php');
		}
		if($usuarios != ""){
			header('Location: gestionUsuario.php');
		}
		if($salir != ""){
			unset($_SESSION["usuario"]);
			header('Location: index.php');
		}
	}
?>