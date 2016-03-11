<?PHP
	// Importamos los archivos php que contienen los metodos necesarios.
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	// Recogemos toda la información del formulario.
	// En caso de que no este definido algun parametro, se le asigna el valor ''.
	$nombre = isset($_POST ["nombre"]) ? $_POST ["nombre"] : '';
	$apellidos = isset($_POST ["apellidos"]) ? $_POST ["apellidos"] : '';
	$user = isset($_POST ["usuario"]) ? $_POST ["usuario"] : '';
	$pass = isset($_POST ["contrasenia"]) ? $_POST ["contrasenia"] : '';
	$telefono = isset($_POST ["telefono"]) ? $_POST ["telefono"] : '';
	$movil = isset($_POST ["movil"]) ? $_POST ["movil"] : '';
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	
	// Se llama a la funcion setUsuario.
	// Se crea un usuario nuevo con los datos pasados por parametro.
	// Se redirecciona al inicio.
	if($nombre != "" && $apellidos != "" && $user != "" && $pass != ""){
		setUsuario($user, md5($pass), $nombre, $apellidos, $telefono , $movil);
		$_SESSION ["usuario"] = $user;
		header('Location: menu.php');
	}
	
	// Funcionalidad de los botones.
	// Boton atras, redirecciona al inicio.
	if($atras != ""){
		header('Location: index.php');
	}
	
	// Se llama a la plantilla y se imprime por pantalla.
	echo getTemplate("registro");
?>