<?php
session_start();
require_once ("../gestionBD.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	// Recogemos los datos del formulario
	$vacaciones["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
	$vacaciones["FECHAFIN"] = $_REQUEST["FECHAFIN"];
	$vacaciones["TIPOVACACIONES"] = $_REQUEST["TIPOVACACIONES"];
	$vacaciones["DNIOPERARIO"] = $_SESSION['login'];

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['formulario'] = $vacaciones;
	// Si se ha llegado a esta página sin haber rellenado el formulario, se redirige al usuario al formulario
} else {
	Header("Location:Vacaciones.php");
}

// Validamos el formulario en servidor
$conexion = crearConexionBD();
$errores = validarDatosServicio($vacaciones);
cerrarConexionBD($conexion);

// Si se han detectado errores
if (count($errores) > 0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	Header('Location: Vacaciones.php');
} else
	// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
	Header('Location: AccionAltaVacaciones.php');


function validarDatosServicio($vacaciones) {


	if ($vacaciones['FECHAINICIO'] == '') {
		$errores[] = '<p>Esta fecha de inicio no puede estar vacia</p>';
	}

	if ($vacaciones['FECHAFIN'] == '') {
		$errores[] = '<p>Esta fecha de fin no puede estar vacia</p>';
	}
	
	if ($vacaciones['TIPOVACACIONES'] == '') {
		$errores[] = '<p>El tipo de vacaciones no puede estar vacia</p>';
	}
	
}
	?>