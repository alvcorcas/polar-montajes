<?php
session_start();
require_once ("../gestionBD.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Recogemos los datos del formulario
	$nuevoServicio["TIEMPOEMPLEADO"] = $_POST["TIEMPOEMPLEADO"];
	$nuevoServicio["FECHAINICIO"] = $_POST["FECHAINICIO"];
	$nuevoServicio["FECHAFIN"] = $_POST["FECHAFIN"];
	$nuevoServicio["TERCERAEMPRESA"] = $_POST["TERCERAEMPRESA"];
	$nuevoServicio["TIPOSERVICIO"] = $_POST["TIPOSERVICIO"];
	$nuevoServicio["DNICLIENTE"] = $_POST["DNICLIENTE"];

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