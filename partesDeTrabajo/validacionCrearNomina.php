<?php
session_start();
require_once ("../gestionBD.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if ($_SERVER["POST_METHOD"] == "POST") {
	// Recogemos los datos del formulario
	$nuevanomina["HORASTRABAJADAS"] = $_POST["HORASTRABAJADAS"];
	$nuevanomina["HORASEXTRAS"] = $_POST["HORASEXTRAS"];
	$nuevanomina["PRECIOHORA"] = $_POST["PRECIOHORA"];
	$nuevanomina["MESANO"] = $_POST["MESANO"] . "-01";
	$nuevanomina["DNIOPERARIO"] = $_POST["DNIOPERARIO"];
	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['formulario'] = $nuevanomina;
	// Si se ha llegado a esta página sin haber rellenado el formulario, se redirige al usuario al formulario
} else {
	Header("Location: crearnomina.php");
}

// Validamos el formulario en servidor
$conexion = crearConexionBD();
$errores = validarDatosnomina($nuevanomina);
cerrarConexionBD($conexion);

// Si se han detectado errores
if (count($errores) > 0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	Header('Location: Crearnomina.php');
} else
	// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
	Header('Location: AccionAltanomina.php');


function validarDatosnomina($nuevanomina) {

	if ($nuevanomina['HORASTRABAJADAS'] == '') {
		$errores[] = '<p>El ID no puede estar vacio</p>';
	}

	if ($nuevanomina['HORASEXTRAS'] == '') {
		$errores[] = '<p>El Tiempo empleado no puede estar vacio</p>';
	}


	if ($nuevanomina['PRECIOHORA'] == '') {
		$errores[] = '<p>EstA fecha de inicio no es válida</p>';
	}
	
	if ($nuevanomina['MESANO'] == '') {
		$errores[] = '<p>La tercera empresa no puede estar vacio</p>';
	}
	
	if ($nuevanomina['DNIOPERARIO'] == '') {
		$errores[] = '<p>El DNI del cliente no puede estar vacio</p>';
	}
}
	?>