<?php 
	// Importamos los archivos php que contienen los metodos necesarios.
	require "../m/baseDatos.php";
	require "../m/metodos.php";
	
	// Recogemos toda la informaci�n del formulario.
	// En caso de que no este definido algun parametro, se le asigna el valor ''.
	$usuario = isset($_SESSION ["usuario"]) ? $_SESSION ["usuario"] : '';
	$atras = isset($_POST["atras"]) ? $_POST["atras"] : '';
	
	// Funcionalidad del boton.
	// Boton atras, redirecciona al panel de control.
	if($atras != ""){
		header('Location: panelControl.php');
	}
	
	// Generamos la tabla que se va a imprimir por pantalla.
	$resultado = getCitas();
	if( $resultado->num_rows != 0){
			
		$misCitas = "<table>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Cliente</th>
						<th>Motivo</th>";
	
		while ($fila = $resultado->fetch_assoc()) {
			$misCitas .= "<tr><td>" . $fila['hora'] . "</td>";
			$misCitas .= "<td>" . $fila['fecha'] . "</td>";
			$misCitas .= "<td>" . $fila['usuario'] . "</td>";
			$misCitas .= "<td>" . $fila['motivo'] . "</td></tr>";
		}
			
		$misCitas .= "</table>";
	}else{
		$misCitas = "No hay citas que mostrar";
	}
	
	// Declaracion del array que se pasara como par�metro para mostrar en la plantilla HTML.
	$array = array (
			"{usuario}" => $usuario,
			"{misCitas}" => $misCitas,
	);
	// Se llama a la plantilla y se imprime por pantalla.
	echo getTemplateReContraTocho("misCitasAdmin", $array);
?>