<?php
 	require "../m/baseDatos.php";
 	require "../m/metodos.php";
	
 	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
 	
	if ($usuario == "admin") {
		echo getTemplateTocho("panelControl", '{usuario}', $usuario);
	} else {
		header('Location: index.php');
	}
?>