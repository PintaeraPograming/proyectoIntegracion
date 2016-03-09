<?PHP
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	$horaS = isset ( $_POST ["reserva"] ) ? $_POST ["reserva"] : '';
	$fechaMal = isset ( $_POST ["select"] ) ? $_POST ["select"] : '';
	$boton = isset ( $_POST ["boton"] ) ? $_POST ["boton"] : '';
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	if($atras != ""){
		header('Location: panelControl.php');
	}
	
	if ($fechaMal != "") {
		$_SESSION ["fechaMal"] = $fechaMal;
	}
	
	$fechaActual = isset ( $_SESSION ["fechaMal"] ) ? $_SESSION ["fechaMal"] : date("Y/m/d");
	
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
		$resultado = getCita($fecha, $hora);
		if ($resultado->num_rows == 0) {
			$tabla .= "<td>" . $hora . "</td><td><input type='text' name='" . $hora . "'><input type='radio' id='s' name='reserva' value='" . $hora  . "#" . $i . "'></td>
							<td><select name='" . $i . "'><option>Corte</option><option>Peinado</option><option>Tinte</option><option>Blanqueamiento</option></select></td>";
		} else {
			while ($fila = $resultado->fetch_assoc()) {
				$tabla .= "<td>" . $hora . "</td><td><label>" . $fila['usuario'] . "</label></td><td>" . $fila['motivo'] . "</td>";
			}
		}
		$tabla .= "</tr>";
	}

	$tabla .= "</table></div>";
	if ($horaS != '' && $boton == "Reservar") {
		$horaC = split("#", $horaS);
		$motivo = isset ( $_POST [$horaC[1]] ) ? $_POST [$horaC[1]] : '';
		$user = isset ( $_POST [$horaC[0]] ) ? $_POST [$horaC[0]] : '';
		setCita ($user, $fecha, $horaC[0], $motivo );		
	}
	
	$array = array (
			"{usuario}" => $usuario,
			"{tabla}" => $tabla 
	);
	echo getTemplateReContraTocho ( "citaAdmin", $array );
?>