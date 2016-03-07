<?PHP
	require "../m/medotos.php";
	require "../m/metodos.php";
	session_start();
	
	$horaS = isset($_POST["reserva"]) ? $_POST["reserva"] : '';
	$motivo = isset($_POST["motivo"]) ? $_POST["motivo"] : '';
	$fechaMal = isset($_POST["select"]) ? $_POST["select"] : '';
	
	if($fechaMal != ""){
		$_SESSION["fechaMal"] = $fechaMal;
	}
	echo "motivo $motivo";
	
	$usuario = $_SESSION["usuario"];
	$hora = "";
	$tabla = "";
	$fecha = "";
	
	
	if($_SESSION["fechaMal"] != ''){
		list($anio, $mes, $dia) = split('[/.-]', $_SESSION["fechaMal"]);
		$fecha = $dia . "/" . $mes . "/" . $anio;
	}else{
		$fecha = "29/02/2016";
	}
		$tabla = "<div class='divTabla'><table class='tabla'><th>Hora</th><th>$fecha</th><th>Motivo</th>";
		for($i = 8; $i < 17; $i ++){
			$hora = $i . ":00";
			$tabla .=  "<tr>";
			if (getCita($fecha, $hora)->num_rows == 0){
				$tabla .= "<td>" . $hora . "</td><td><input type='radio' id='si' name='reserva' value='" . $hora . "'></td>
						<td><select name='motivo'><option>Corte</option><option>Peinado</option><option>Tinte</option><option>Blanqueamiento</option></select></td>";
			}else{
				$tabla .= "<td>" . $hora . "</td><td><label>Reservado</label></td><td>Reservado</td>";
			}
			$tabla .= "</tr>";
		}
		$tabla .= "</table></div>";
		if($horaS != ''){
			setCita($usuario, $fecha, $horaS, $motivo);
			echo "<script>alert('Se ha reservado con exito!')</script>";
		}

		
	$array = array (
			"{usuario}" => $usuario,
			"{tabla}" => $tabla,
	);
	echo getTemplateReContraTocho("cita", $array);
?>