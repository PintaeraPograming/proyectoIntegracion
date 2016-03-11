<?php 

	// Obtiene el contenido de una plantilla html.
	// Devuelve una string.
	function getTemplate($pagina) {
		return file_get_contents ('../v/'. $pagina . '.html');
	}
	
	// Obtiene el contenido de una plantilla html.
	// Sustituye un parametro concreto por una string pasada por parametro.
	// Devuelve una string.
	function getTemplateTocho($pagina, $remplazar, $mensaje) {
		return str_replace($remplazar, $mensaje, getTemplate($pagina));
	}
	
	// Obtiene el contenido de una plantilla html.
	// Sustituye multiples parametros por una string para cada uno.
	// Devuelve una string.
	function getTemplateReContraTocho($pagina, $array){
		$html = getTemplate($pagina);
		foreach($array as $remplazar=>$mensaje){
			$html = str_replace($remplazar, $mensaje, $html);
		}
		return $html;
	}

?>