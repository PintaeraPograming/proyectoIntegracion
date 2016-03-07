<?PHP
	require "../m/medotos.php";
	require "../m/metodos.php";
	session_start ();
	
	$horaS = isset ( $_POST ["reserva"] ) ? $_POST ["reserva"] : '';
	$fechaMal = isset ( $_POST ["select"] ) ? $_POST ["select"] : '';
	$boton = isset ( $_POST ["boton"] ) ? $_POST ["boton"] : '';

	if ($fechaMal != "") {
		$_SESSION ["fechaMal"] = $fechaMal;
	}
	
	$fechaActual = isset ( $_SESSION ["fechaMal"] ) ? $_SESSION ["fechaMal"] : date("d/m/Y");
	
	$usuario = $_SESSION ["usuario"];
	$hora = "";
	$tabla = "";
	$fecha = "";
	
	if ($fechaActual != '') {
		list ($anio, $mes, $dia) = split ('[/.-]', $fechaActual);
		$fecha = $dia . "/" . $mes . "/" . $anio;
	}
	$tabla = "<div class='divTabla'><table class='tabla'><th>Hora</th><th>$fecha</th><th>Motivo</th>";
	for($i = 8; $i < 17; $i ++) {
		$hora = $i . ":00";
		$tabla .= "<tr>";
		if (getCita ( $fecha, $hora )->num_rows == 0) {
			$tabla .= "<td>" . $hora . "</td><td><input type='radio' id='s' name='reserva' value='" . $hora  . "#" . $i . "'></td>
							<td><select name='" . $i . "'><option>Corte</option><option>Peinado</option><option>Tinte</option><option>Blanqueamiento</option></select></td>";
		} else {
			$tabla .= "<td>" . $hora . "</td><td><label>Reservado</label></td><td>Reservado</td>";
		}
		$tabla .= "</tr>";
	}
	$tabla .= "</table></div>";
	if ($horaS != '' && $boton == "Reservar") {
		$horaC = split("#", $horaS);
		$motivo = isset ( $_POST [$horaC[1]] ) ? $_POST [$horaC[1]] : '';
		setCita ($usuario, $fecha, $horaC[0], $motivo );
		echo "<script>alert('Se ha reservado con exito!')</script>";
	}
	
	$array = array (
			"{usuario}" => $usuario,
			"{tabla}" => $tabla 
	);
	echo getTemplateReContraTocho ( "cita", $array );
?>