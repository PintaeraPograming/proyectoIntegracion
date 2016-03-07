<?PHP
	require "../m/medotos.php";
	require "../m/metodos.php";
	session_start();
	
	$usuario = $_SESSION["usuario"];
	
	
	$nuevaCita = isset($_POST["nuevaCita"]) ? $_POST["nuevaCita"] : '';
	$misCitas = isset($_POST["misCitas"]) ? $_POST["misCitas"] : '';
	$salir = isset($_POST["salir"]) ? $_POST["salir"] : '';
	
	if ($nuevaCita != "" && $misCitas != "" && $salir != "") {
		
		echo getTemplateTocho("menu", '{usuario}', $usuario);
	}else{
		if($nuevaCita != ""){
			echo getTemplateTocho("cita", '{usuario}', $usuario);
		}
		if($misCitas != ""){
			getMisCitas($usuario);
		}
		if($salir != ""){
			unset($_SESSION["usuario"]);
			echo getTemplateTocho("inicio", '{mensajito}', "");
		}
	}
	
	
?>