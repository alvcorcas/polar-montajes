<?php
session_start();

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
	$nuevoUsuario["provincia"] = $_REQUEST["provincia"];
	$nuevoUsuario["calle"] = $_REQUEST["calle"];





// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['formulario'] = $nuevoUsuario;
	
	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($nuevoUsuario);
	
	$_SESSION['errores'] = $errores;
	print_r($errores);
	
	// Si se han detectado errores
	if (count($errores) > 0){
		// Guardo en la sesión los mensajes de error
		$_SESSION['errores'] = $errores;
		// Redirigimos al usuario al formulario
		Header("Location:form_alta_usuario.php");

	// Si NO se han detectado errores
		// Redirigimos al usuario a la página de éxito

	}else{
		
		Header('Location: accion_alta_usuario.php');
		
	}
	
	// Si se ha llegado a esta página sin haber rellenado el formulario, se redirige al usuario al formulario
}else{
	Header("Location:form_alta_usuario.php");
}	

// Formatear la fecha
function getFechaFormateada($fecha){
	$fechaNacimiento = date('d/m/Y', strtotime($fecha));
	
	return $fechaNacimiento;
}

function validarDatosUsuario($nuevoUsuario){
	// Validación del NIF (opcional)
	
	if($nuevoUsuario['nif'] == ''){
		$errores[] ='<p>El nif no puede estar vacio';
	}
	
	
	// Validación del Nombre 
	if($nuevoUsuario['nombre'] == ''){
		$errores[] ='<p>El nombre no puede estar vacio</p>';
	}
	
	// Validación del email
	
	if($nuevoUsuario['email'] == ''){
		$errores[] ='<p>El email no puede estar vacio';
	}
	
	// Validación del perfil (opcional)
	
	if($nuevoUsuario['perfil'] == ''){
		$errores[] ='<p>El perfil no puede estar vacio';
	}
	
	// Validación de la contraseña 
	if($nuevoUsuario['pass'] == ''  || strlen($nuevoUsuario["pass"] < 8)){
		$errores[] ='<p>La contraseña no es valida : debe tener al menos 8 caracteres</p>';
	}else if(!preg_match("/[a-z] + /", $nuevoUsuario["pass"]) || 
		!preg_match("/[A-Z] + /", $nuevoUsuario["pass"])||
		!preg_match("/[0-9] + /", $nuevoUsuario["pass"])){
			$errores[] = "<p>Contraseña no válida: debe contener mayusculas, minusculas y digitos</p>";
		}else if($nuevoUsuario["pass"] != $nuevoUsuario["confirmpass"]){
			$errores[] = "<p> La confirmacion de contraseña no coincide con la contraseña</p>";
		}
	
	// Validación de la dirección (opcional)
		
		if($nuevoUsuario['calle'] == ''){
		$errores[] ='<p>La direccion no puede estar vacia';
	}
				
	return $errores;
}
/////////////////// FIN DE EJERCICIO 2
?>