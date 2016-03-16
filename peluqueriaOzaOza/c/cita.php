<?PHP
	// Importamos los archivos php que contienen los metodos necesarios.
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	// Recogemos toda la información del formulario.
	// En caso de que no este definido algun parametro, se le asigna el valor ''.
	$horaS = isset ( $_POST ["reserva"] ) ? $_POST ["reserva"] : '';
	$fechaMal = isset ( $_POST ["select"] ) ? $_POST ["select"] : '';
	$boton = isset ( $_POST ["boton"] ) ? $_POST ["boton"] : '';
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	
	// Declaracion de variables
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
				<table class='table table-striped'>
					<th>Hora</th>
					<th>$fecha</th>
					<th>Servicio</th>";
	for($i = 8; $i < 17; $i ++) {
		$hora = $i . ":00";
		$tabla .= "<tr>";
		if (getCita ( $fecha, $hora )->num_rows == 0) {
			$tabla .= "<td>" . $hora . "</td>
					<td>
						<input type='radio' id='s' name='reserva' value='" . $hora  . "#" . $i . "'>
					</td>
					<td>
						<select name='" . $i . "'>
								<option>Corte</option>
								<option>Peinado</option>
								<option>Tinte</option>
								<option>Mechas</option>
						</select>
					</td>";
		} else {
			$tabla .= "<td class='reservado'>
						" . $hora . "
					</td>
					<td class='reservado' colspan='2'>
						Reservado
					</td>";
		}
		$tabla .= "</tr>";
	}
	$tabla .= "</table></div>";
	
	// Funcionalidad de los botones.
	// Boton atras, redirecciona al menu.
	if($atras != ""){
		header('Location: menu.php');
	}
	// Boton reservar llama a la funcion setCita.
	// Realiza la reserva con los datos pasados por parametros.
	if ($horaS != '' && $boton == "Reservar") {
		$horaC = split("#", $horaS);
		$motivo = isset ( $_POST [$horaC[1]] ) ? $_POST [$horaC[1]] : '';
		setCita ($usuario, $fecha, $horaC[0], $motivo );		
	}
	
	// Declaracion del array que se pasara como parámetro para mostrar en la plantilla HTML.
	$array = array (
			"{usuario}" => $usuario,
			"{tabla}" => $tabla 
	);
	
	// Se llama a la plantilla y se imprime por pantalla.
	echo getTemplateReContraTocho ( "cita", $array );
?>