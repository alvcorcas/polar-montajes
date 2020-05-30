<?php
session_start();
require_once ("../gestionBD.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	// Recogemos los datos del formulario
	$nuevoServicio["OID_S"] = $_REQUEST["OID_S"];
	$nuevoServicio["TIEMPOEMPLEADO"] = $_REQUEST["TIEMPOEMPLEADO"];
	$nuevoServicio["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
	$nuevoServicio["FECHAFIN"] = $_REQUEST["FECHAFIN"];
	$nuevoServicio["TERCERAEMPRESA"] = $_REQUEST["TERCERAEMPRESA"];
	$nuevoServicio["TIPOSERVICIO"] = $_REQUEST["TIPOSERVICIO"];
	$nuevoServicio["DNICLIENTE"] = $_REQUEST["DNICLIENTE"];

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['formulario'] = $nuevoServicio;
	// Si se ha llegado a esta página sin haber rellenado el formulario, se redirige al usuario al formulario
} else {
	Header("Location:CrearServicio.php");
}

// Validamos el formulario en servidor
$conexion = crearConexionBD();
$errores = validarDatosServicio($nuevoServicio);
cerrarConexionBD($conexion);

// Si se han detectado errores
if (count($errores) > 0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	Header('Location: CrearServicio.php');
} else
	// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
	Header('Location: AccionAltaServicio.php');


function validarDatosServicio($nuevoServicio) {

	if ($nuevoServicio['OID_S'] == '') {
		$errores[] = '<p>El ID no puede estar vacio</p>';
	}

	if ($nuevoServicio['TIEMPOEMPLEADO'] == '') {
		$errores[] = '<p>El Tiempo empleado no puede estar vacio</p>';
	}


	if ($nuevoServicio['FECHAINICIO'] == '') {
		$errores[] = '<p>EstA fecha de inicio no es válida</p>';
	}
	
	

	if ($nuevoServicio['FECHAFIN'] == '') {
		$errores[] = '<p>Esta fecha de vencimiento no es válida</p>';
	}
	


	if ($nuevoServicio['TIPOSERVICIO'] == '') {
		$errores[] = '<p>El tipo de servicio no puede estar vacio</p>';
	}
	
	if ($nuevoServicio['TERCERAEMPRESA'] == '') {
		$errores[] = '<p>La tercera empresa no puede estar vacio</p>';
	}
	
	if ($nuevoServicio['DNICLIENTE'] == '') {
		$errores[] = '<p>El DNI del cliente no puede estar vacio</p>';
	}
}
	?>