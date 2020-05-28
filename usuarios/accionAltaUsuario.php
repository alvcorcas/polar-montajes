<?php

session_start();

// include_once ("funciones.php");
require_once ("../gestionBD.php");
require_once ("gestionUsuario.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	$nuevoUsuario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else
	Header("Location: formularioAltaUsuario.php");

$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
  <title>Inicio de Sesión: Alta de Usuario realizada con éxito</title>
</head>

<body>
	
<?php
include_once ("../cabecera.php");
	?>
	
<main>
				<?php if (alta_usuario($conexion, $nuevoUsuario)) { 
				
		?>
		<div id="div_exito">
		  <h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
		  <h2>El nuevo usuario ha sido dado de alta con éxito con los siguientes datos:</h2>
		<ul>
			<li><?php echo "NIF: " . $nuevoUsuario["nif"]; ?></li>
			<li><?php echo " Nombre: " . $nuevoUsuario["nombre"]; ?></li>
			<li><?php echo " Apellidos: " . $nuevoUsuario["apellidos"]; ?></li>
			<li><?php echo " e-mail: " . $nuevoUsuario["email"]; ?></li>
			<li><?php echo " Perfil: " . $nuevoUsuario["perfil"]; ?></li>
			li><?php echo " Telefono: " . $nuevoUsuario["telefono"]; ?></li>
			<?php if ($nuevoUsuario["perfil"] == 'Cliente') {?>
			<li><?php echo " Codigo Postal: " . $nuevoUsuario["codigoPostal"]; ?></li>
			<li><?php echo " Dirección: " . $nuevoUsuario["direccion"]; ?></li>
			<?php } ?>
			
				
				</ul>		
			<div id="div_volver">	
			   Pulsa <a href="login.php">aquí</a> para volver al inicio de sesión.
			</div>
		</div>
		<?php } else { ?>
				<h1>El usuario ya existe en la base de datos</h1>
				<ul>
			<li><?php echo "NIF: " . $nuevoUsuario["nif"]; ?></li>
			<li><?php echo " Nombre: " . $nuevoUsuario["nombre"]; ?></li>
			<li><?php echo " Apellidos: " . $nuevoUsuario["apellidos"]; ?></li>
			<li><?php echo " e-mail: " . $nuevoUsuario["email"]; ?></li>
			<li><?php echo " Perfil: " . $nuevoUsuario["perfil"]; ?></li>
			<li><?php echo " Telefono: " . $nuevoUsuario["telefono"]; ?></li>
			<?php if ($nuevoUsuario["perfil"] == 'Cliente') {?>
			<li><?php echo " Codigo Postal: " . $nuevoUsuario["codigoPostal"]; ?></li>
			<li><?php echo " Dirección: " . $nuevoUsuario["direccion"]; ?></li>
			<?php } ?>
				</ul>	
				<div >	
					Pulsa <a href="formularioAltaUsuario.php">aquí</a> para volver al formulario.
				</div>
		<?php } ?>

	
	</main>
	</body>
</html>
<?php

cerrarConexionBD($conexion);
?>