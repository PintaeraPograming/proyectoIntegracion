<?php 
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	if($atras != ""){
		header('Location: menu.php');
	}
	
	getMisCitas($usuario);
?>