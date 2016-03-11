<?PHP
	// Importamos los archivos php que contienen los metodos necesarios.
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	// Recogemos toda la información del formulario.
	// En caso de que no este definido algun parametro, se le asigna el valor ''.
	$nuevaCita = isset($_POST["nuevaCita"]) ? $_POST["nuevaCita"] : '';
	$misCitas = isset($_POST["misCitas"]) ? $_POST["misCitas"] : '';
	$salir = isset($_POST["salir"]) ? $_POST["salir"] : '';
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
		
	// Se realizan las redirecciones.
	// Redirecciona a la pagina de citas.
	if($nuevaCita != ""){
		header('Location: cita.php');
	}
	// Redirecciona a la paginas de listar citas.
	if($misCitas != ""){
		header('Location: misCitas.php');
	}
	// Redirecciona al inicio.
	if($salir != ""){
		unset($_SESSION["usuario"]);
		header('Location: index.php');
	}
	
	// Se llama a la plantilla y se imprime por pantalla.
	echo getTemplateTocho("menu", '{usuario}', $usuario);
?>