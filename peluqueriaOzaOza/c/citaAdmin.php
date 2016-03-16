<?PHP
	// Importamos los archivos php que contienen los metodos necesarios.
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	// Recogemos toda la información del formulario. 
	// En caso de que no este definido algun parametro, se le asigna el valor ''.
	$horaS = isset ( $_POST ["reserva"] ) ? $_POST ["reserva"] : '';
	$fechaMal = isset ( $_POST ["select"] ) ? $_POST ["select"] : '';
	$boton = isset ( $_POST ["boton"] ) ? $_POST ["boton"] : '';
	$eliminar = isset ( $_POST ["eliminar"] ) ? $_POST ["eliminar"] : '';
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	
	// Declaracion de variables.
	if ($fechaMal != "") {
		$_SESSION ["fechaMal"] = $fechaMal;
	}
	$fechaActual = isset ( $_SESSION ["fechaMal"] ) ? $_SESSION ["fechaMal"] : date("Y/m/d");
	$hora = "";
	$tabla = "";
	$fecha = "";
	
	// Formateamos la fecha con el formato dd/mm/aaaa.
	if ($fechaActual != '') {
		list ($anio, $mes, $dia) = split ('[/.-]', $fechaActual);
		$fecha = $dia . "/" . $mes . "/" . $anio;
	}
	
	// Generamos la tabla que se va a imprimir por pantalla.
	$tabla = "<div class='divTabla'>
				<table class='tabla'>
					<th>Hora</th>
					<th>$fecha</th>
					<th>Servicio</th><th></th>";
	for($i = 8; $i < 17; $i ++) {
		$hora = $i . ":00";
		$tabla .= "<tr>";
		$resultado = getCita($fecha, $hora);
		if ($resultado->num_rows == 0) {
			$tabla .= "<td>" . $hora . "</td>
					<td>
						<input type='text' name='" . $hora . "'>
					</td>
					<td>
						<select name='" . $i . "'>
							<option>Corte</option>
							<option>Peinado</option>
							<option>Tinte</option>
							<option>Mechas</option>	
						</select>
					</td><td><input class='radio' type='radio' id='s' name='reserva' value='" . $hora  . "#" . $i . "'></td>";
		} else {
			while ($fila = $resultado->fetch_assoc()) {
				$tabla .= "<td>
							" . $hora . "
						</td>
						<td>
							" . $fila['usuario'] . "
						</td>
						<td>
							" . $fila['motivo'] . "
						</td>
						<td>
							<button value='$fecha#$hora' name='eliminar'>Eliminar</button>
						</td>";
			}
		}
		$tabla .= "</tr>";
	}
	$tabla .= "</table></div>";
	
	// Funcionalidad de los botones.
	// Boton atras, redirecciona al panel de control.
	if($atras != ""){
		header('Location: panelControl.php');
	}
	// Boton eliminar llama al metodo unsetCita.
	// Elimina la cita que coincida con la fecha y hora pasadas por parametros.
	if($eliminar != ""){
		$consulta = split("#", $eliminar);
		unsetCita($consulta[0],$consulta[1]);
	}
	// Boton reservar llama a la funcion setCita.
	// Realiza la reserva con los datos pasados por parametros.
	if ($horaS != '' && $boton == "Reservar") {
		$horaC = split("#", $horaS);
		$motivo = isset ( $_POST [$horaC[1]] ) ? $_POST [$horaC[1]] : '';
		$user = isset ( $_POST [$horaC[0]] ) ? $_POST [$horaC[0]] : '';
		setCita ($user, $fecha, $horaC[0], $motivo );		
	}
	
	// Declaracion del array que se pasara como parámetro para mostrar en la plantilla HTML.
	$array = array (
			"{usuario}" => $usuario,
			"{tabla}" => $tabla 
	);
	
	// Se llama a la plantilla y se imprime por pantalla.
	echo getTemplateReContraTocho ( "citaAdmin", $array );
?>