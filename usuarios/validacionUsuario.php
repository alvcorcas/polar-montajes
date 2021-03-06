<?php
session_start();
require_once ("../gestionBD.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	// Recogemos los datos del formulario
	$nuevoUsuario["nif"] = $_REQUEST["nif"];
	$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
	$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
	$nuevoUsuario["email"] = $_REQUEST["email"];
	$nuevoUsuario["perfil"] = $_REQUEST["perfil"];
	$nuevoUsuario["pass"] = $_REQUEST["pass"];
	$nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];
	$nuevoUsuario["telefono"] = $_REQUEST["telefono"];
	$nuevoUsuario["direccion"] = $_REQUEST["direccion"];
	$nuevoUsuario["codigoPostal"] = $_REQUEST["codigoPostal"];

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['formulario'] = $nuevoUsuario;
	// Si se ha llegado a esta página sin haber rellenado el formulario, se redirige al usuario al formulario
} else {
	Header("Location:formularioAltaUsuario.php");
}

// Validamos el formulario en servidor
$conexion = crearConexionBD();
$errores = validarDatosUsuario($nuevoUsuario);
cerrarConexionBD($conexion);

// Si se han detectado errores
if (count($errores) > 0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	Header('Location: formularioAltaUsuario.php');
} else
	// Si todo va bien, vamos a la página de acción (inserción del usuario en la base de datos)
	Header('Location: accionAltaUsuario.php');


function validarDatosUsuario($nuevoUsuario) {
	// Validación del NIF (opcional)

	if ($nuevoUsuario['nif'] == '') {
		$errores[] = '<p>El nif no puede estar vacio</p>';
	}

	// Validación del Nombre
	if ($nuevoUsuario['nombre'] == '') {
		$errores[] = '<p>El nombre no puede estar vacio</p>';
	}

	// Validación del email

	if (!filter_var($nuevoUsuario['email'], FILTER_VALIDATE_EMAIL)) {
		$errores[] = '<p>Este email no es valido</p>';
	}
	
	// Validación del email

	if ($nuevoUsuario['telefono'] == '') {
		$errores[] = '<p>Este email no es valido</p>';
	}
	

	// Validación del perfil (opcional)

	if ($nuevoUsuario['perfil'] == '') {
		$errores[] = '<p>El perfil no puede estar vacio</p>';
	}

	// Validación de la contraseña
	if (!isset($nuevoUsuario["pass"]) || strlen($nuevoUsuario["pass"]) < 8) {
		$errores[] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
	} else if (!preg_match("/[a-z]+/", $nuevoUsuario["pass"]) || !preg_match("/[A-Z]+/", $nuevoUsuario["pass"]) || !preg_match("/[0-9]+/", $nuevoUsuario["pass"])) {
		$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
	} else if ($nuevoUsuario["pass"] != $nuevoUsuario["confirmpass"]) {
		$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
	}

	
	// Validación de la direccion
	if ($nuevoUsuario['perfil'] == 'Cliente' and $nuevoUsuario['direccion'] == '') {
		$errores[] = '<p>La direccion no puede estar vacia si eres ciente</p>';
	}
	
	// Validación del codigoPostal
	if ($nuevoUsuario['perfil'] == 'Cliente' and $nuevoUsuario['codigoPostal'] == '') {
		$errores[] = '<p>El codigo postal no puede estar vacio si eres cliente</p>';
	}

	return $errores;
}

/////////////////// FIN DE EJERCICIO 2
?>