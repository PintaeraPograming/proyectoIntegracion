<?php 
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	if($atras != ""){
		header('Location: panelControl.php');
	}
	
	$resultado = getCitas();
	
	if( $resultado->num_rows != 0){
			
		$misCitas = "<table><th>Hora</th><th>Fecha</th><th>Cliente</th><th>Motivo</th>";
			
		while ($fila = $resultado->fetch_assoc()) {
			$misCitas .= "<tr><td>" . $fila['hora'] . "</td>";
			$misCitas .= "<td>" . $fila['fecha'] . "</td>";
			$misCitas .= "<td>" . $fila['usuario'] . "</td>";
			$misCitas .= "<td>" . $fila['motivo'] . "</td></tr>";
		}
			
		$misCitas .= "</table>";
	}else{
		$misCitas = "No tienes ninguna cita";
	}
	
	$cajita = array (
			"{usuario}" => $usuario,
			"{misCitas}" => $misCitas,
	);
	
	echo getTemplateReContraTocho("misCitasAdmin", $cajita);
?>