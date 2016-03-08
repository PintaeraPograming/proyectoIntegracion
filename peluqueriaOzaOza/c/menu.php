<?PHP
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	
	echo getTemplateTocho("menu", '{usuario}', $usuario);
	
	$nuevaCita = isset($_POST["nuevaCita"]) ? $_POST["nuevaCita"] : '';
	$misCitas = isset($_POST["misCitas"]) ? $_POST["misCitas"] : '';
	$salir = isset($_POST["salir"]) ? $_POST["salir"] : '';
	
	if ($nuevaCita != "" && $misCitas != "" && $salir != "") {
		//echo "<script>document.location.reload();</script>";
		
	}else{
		if($nuevaCita != ""){
			header('Location: cita.php');
			//echo getTemplateTocho("cita", '{usuario}', $usuario);
		}
		if($misCitas != ""){
			header('Location: misCitas.php');
		}
		if($salir != ""){
			unset($_SESSION["usuario"]);
			header('Location: index.php');
			//echo getTemplateTocho("inicio", '{mensajito}', "");
		}
	}
	
	
?>