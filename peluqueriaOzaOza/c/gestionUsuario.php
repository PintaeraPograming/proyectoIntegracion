<?PHP
	// Importamos los archivos php que contienen los metodos necesarios.
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	// Recogemos toda la información del formulario.
	// En caso de que no este definido algun parametro, se le asigna el valor ''.
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	
	// Generamos la tabla que se va a imprimir por pantalla.
	$resultado = getUsuarios();
	if( $resultado->num_rows != 0){
		$tabla = "<div class='divTabla'>
					<table class='tabla'>
						<th>Usuario</th>
						<th>Contrase&ntilde;a</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Telefono</th>
						<th>Móvil</th>";
		while ($fila = $resultado->fetch_assoc()) {
			$tabla .= "<tr><td>
					<label>" . $fila['usuario'] . "</label>
				</td>
				<td>
					<label>" . $fila['contrasenia'] . "</label>
				</td>
				<td>
					<label>" . $fila['nombre'] . "</label>
				</td>
				<td>
					<label>" . $fila['apellidos'] . "</label>
				</td>
				<td>
					<label>" . $fila['telefono'] . "</label>
				</td>
				<td>
					<label>" . $fila['movil'] . "</label>
				</td></tr>";
		}
		$tabla .= "</table></div>";
	}else{
		$tabla = "No existen usuarios en la base de datos";
	}
	
	// Declaracion del array que se pasara como parámetro para mostrar en la plantilla HTML.
	$array = array (
			"{usuario}" => $usuario,
			"{usuarios}" => $tabla
	);
		
	// Funcionalidad del boton.
	// Boton atras, redirecciona al panel de control.
	if($atras != ""){
		header('Location: panelControl.php');
	}
	
	// Se llama a la plantilla y se imprime por pantalla.
	echo getTemplateReContraTocho ( "gestionUsuario", $array );
?>



