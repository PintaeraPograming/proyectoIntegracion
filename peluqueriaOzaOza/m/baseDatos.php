<?PHP
	// Carga la session.
	session_start ();
	
	// Establece la conexion con la base de datos
	// Control de error en caso de que ocurra un error
	// Devuelve un objeto mysqli
	function conectar(){
		$mysqli = new mysqli ( "localhost", "root", "root", "peluqueria");
		if ($mysqli->connect_errno) {
			echo "Fallo la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		return $mysqli;
	}
	
	// Hace una consulta a la base de datos.
	// Busca una coincidencia con un usuario y contraseña concretos.
	// Devuelve el usuario en caso de que exista y un cero en caso contrario.
	function inicioSesion($usuario, $contraseña) {
		return conectar ()->query( "SELECT * FROM usuarios WHERE usuario LIKE '$usuario' AND contrasenia LIKE '$contraseña'");
	}
	
	// Hace una consulta a la base de datos.
	// Busca una coincidencia con una fecha y horas concretss.
	// Devuelve la fecha en caso de que exista y un cero en caso contrario.
	function getCita($fecha, $hora){
		return conectar()->query("SELECT * FROM citas WHERE fecha LIKE '$fecha' AND hora LIKE '$hora'");
	}
	
	// Hace una consulta a la base de datos.
	// Devuelve la hora, fecha, usuario y motivo de las citas de todos los usuarios.
	function getCitas(){
	
		return conectar()->query( "SELECT hora, fecha, usuario, motivo FROM citas");
	}
		
	// Hace una consulta a la base de datos.
	// Busca una coincidencia con un usuario.
	// Devuelve la hora, fecha, usuario y motivo de las citas de un usuario.
	function getMisCitas($usuario){
		
		return conectar()->query( "SELECT hora, fecha, usuario, motivo FROM citas WHERE usuario LIKE '$usuario'");	
	}
		
	// Hace una consulta a la base de datos.
	// Busca todos los usuarios.
	// Devuelve todos los usuarios en caso de que existan y un cero en caso contrario.
	function getUsuarios(){
	
		return conectar()->query( "SELECT * FROM usuarios");
	}
	
	// Realiza un insert en la base de datos
	// En la tabla usuarios
	// No devuelve nada
	function setUsuario($usuario, $contraseña, $nombre, $apellidos, $telefono, $movil){
		
		$resultado = conectar()->query( "SELECT * FROM usuarios WHERE usuario LIKE '$usuario'");
		if($resultado->num_rows == 0){
			conectar()->query("INSERT INTO usuarios (usuario, contrasenia, nombre, apellidos, telefono, movil) VALUES ('" . $usuario . "','" . $contraseña . "','" . $nombre . "','" . $apellidos ."','" . $telefono . "','" . $movil ."')");
			echo "<script>alert('¡Te has registrado con &eacute;xito!');document.location.reload();";	
		}else{
			echo "<script>alert('¡Ya existe ese nombre de usuario!');</script>";
		}
	}
	
	
	// Realiza un insert en la base de datos
	// En la tabla citas
	// No devuelve nada
	function setCita($usuario, $fecha, $hora, $motivo){
			
		$resultado = conectar()->query( "SELECT * FROM citas WHERE fecha LIKE '$fecha' AND hora LIKE '$hora'");
			
		if($resultado->num_rows == 0){
			conectar()->query("INSERT INTO citas (usuario, fecha, hora, motivo) VALUES ('" . $usuario . "','" . $fecha . "','" . $hora . "','" . $motivo ."')");
			echo "<script>alert('¡Se ha hecho la reserva con éxito!');document.location.reload();</script>";
		}
	}
	
	// Realiza un delete en la base de datos
	// En la tabla citas
	// No devuelve nada
	function unsetCita($fecha, $hora){
		
		$resultado = conectar()->query( "SELECT * FROM citas WHERE fecha LIKE '$fecha' AND hora LIKE '$hora'");
		if($resultado->num_rows == 1){
			conectar()->query("DELETE FROM citas WHERE fecha = '$fecha' AND hora = '$hora'");
			echo "<script>alert('¡Se ha eliminado la cita!');document.location.reload();</script>";
		}
	}
	
	// Funcion super compleja construida con algoritmos sovieticos de la nasa rusa
	// Llama a la funcion date
	// Devuelve una string con la fecha y hora del dia de hoy
	function fecha($cadena){
		return date($cadena);
	}
?>













