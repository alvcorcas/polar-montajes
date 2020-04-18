<?php
	session_start();
	
	
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: form_alta_usuario.php");	
		
		// Función para formatear una fecha al formato de Oracle
	function getFechaFormateada($fecha){
		$fechaNacimiento = date('d/m/Y', strtotime($fecha));
		return $fechaNacimiento;
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/principal.css" />
  <title>Inicio de Sesión: Alta de Usuario realizada con éxito</title>
</head>

<body>
	
<?php
		include_once("Cabecera.php");
	?>
	
<main>
		<div id="div_exito">
		  <h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
			<div id="div_volver">	
			   Pulsa <a href="form_alta_usuario.php">aquí</a> para volver al formulario de altas de usuarios.
			</div>
		</div>
		
	<h2>El nuevo usuario ha sido dado de alta con éxito con los siguientes datos:</h2>
		<ul>
			<li><?php echo "NIF: " . $nuevoUsuario["nif"]; ?></li>
			<li><?php echo "Nombre: " . $nuevoUsuario["nombre"]; ?></li>
			<li><?php echo "Apellidos: " . $nuevoUsuario["apellidos"]; ?></li>
			<li><?php echo "e-mail: " . $nuevoUsuario["email"]; ?></li>
			<li><?php echo "Perfil: " . $nuevoUsuario["perfil"]; ?></li>
			<li><?php echo "Provincia: " . $nuevoUsuario["provincia"]; ?></li>
			<li><?php echo "Dirección: " . $nuevoUsuario["calle"]; ?></li>
			<ul>
				
				</ul>		
	</main>
	</body>
</html>