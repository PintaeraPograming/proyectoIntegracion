<?PHP
	require "../m/medotos.php";
	require "../m/metodos.php";
	session_start();
	
	$usuario = $_SESSION["usuario"];
	getMisCitas($usuario);
?>