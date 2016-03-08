<?php 
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	
	getMisCitas($usuario);
?>