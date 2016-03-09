<?PHP
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	$nombre = isset($_POST ["nombre"]) ? $_POST ["nombre"] : '';
	$apellidos = isset($_POST ["apellidos"]) ? $_POST ["apellidos"] : '';
	$user = isset($_POST ["usuario"]) ? $_POST ["usuario"] : '';
	$pass = isset($_POST ["contrasenia"]) ? $_POST ["contrasenia"] : '';
	
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	
	if($nombre != "" && $apellidos != "" && $user != "" && $pass != ""){
		setUsuario($user, $pass, $nombre, $apellidos);
		$_SESSION ["usuario"] = $user;
		header('Location: panelControl.php');
	}
	
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	if($atras != ""){
		header('Location: panelControl.php');
	}
	
	echo getTemplate("registro");
?>