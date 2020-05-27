<?php
session_start();

require_once ("../gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	// Inicializamos la variable con los datos del formulario asignando valores por defecto a los elementos
	$formulario['nif'] = "";
	$formulario['nombre'] = "";
	$formulario['apellidos'] = "";
	$formulario['perfil'] = "Trabajador";
	$formulario['email'] = "";
	$formulario['pass'] = "";
	$formulario['calle'] = "";
	$formulario['provincia'] = "";
	$formulario['municipio'] = "";
	// Guardamos los datos en la sesión
	$_SESSION['formulario'] = $formulario;
} else {
	//Si ya se ha completado el formulario
	$formulario = $_SESSION['formulario'];
}

if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/login.css" />
		<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
		<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>-->
		<script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
		<title>Polar Montajes: Alta de Usuarios</title>
	</head>

	<body>
		<!-- <script>
			// Inicialización de elementos y eventos cuando el documento se carga completamente
			$(document).ready(function() {
				$("#altaUsuario").on("submit", function() {
					return validateForm();
				});

				$("#pass").on("keyup", function() {
					// Calculo el color
					passwordColor();
				});
			});
		</script> -->

		<?php
		include_once ("../cabecera.php");
		?>

		<?php
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores) > 0) {
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach ($errores as $error) {
				echo $error;
			}
			echo "</div>";
		}
		?>
		<header>
		<h2>Formulario de Alta de Usuario</h2>
		<hr	 />
		</header>

		<form id="altaUsuario" method="post" action="validacionUsuario.php"> <!-- novalidate="novalidate" -->
		<p>
		<i>Los campos obligatorios están marcados con </i><em>*</em>
		</p>

		<h3>Datos personales</h3>
		<hr width=27%  align="left" size=3 >
		<label for="nif">NIF:<em>*</em></label>
		<input id="nif" name="nif" type="text" placeholder="12345678X" value="<?php echo $formulario['nif']; ?>"pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" style="margin-left:120px;" required>
		<br>
		<br />
		<label for="nombre">Nombre:<em>*</em></label>
		<input id="nombre" name="nombre" type="text"  value="<?php echo $formulario['nombre']; ?>" required style="margin-left:93px;">
		<br>
		<br />
		<label for="apellidos">Apellidos:</label>
		<input id="apellidos" name="apellidos" type="text" value="<?php echo $formulario['apellidos']; ?>"style="margin-left:91px;">
		<br>
		<br />
		<label>Perfil:</label>
		<label>
		<input name="perfil" type="radio" value="Trabajador" <?php
		if ($formulario['perfil'] == 'Trabajador')
			echo ' checked ';
		?> style="margin-left:120px;">
		Trabajador</label>
		<label>
		<input name="perfil" type="radio" value="Cliente" <?php
		if ($formulario['perfil'] == 'Cliente')
			echo ' checked ';
		?>>
		Cliente</label>
		<br>
		<br />
		<label for="email">Email:<em>*</em></label>
		<input id="email" name="email"  type="email" placeholder="usuario@dominio.extension"  value="<?php echo $formulario['email']; ?>" required style="margin-left:107px";><br>
		<hr	 />

		<h3>Datos de usuario</h3>
		<hr width=27%  align="left" size=3 >
		<label for="pass">Password:<em>*</em></label>
		<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required style="margin-left:81px";>
		<br />
		<br>
		<label for="confirmpass">Confirmar Password: </label>
		<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" style="margin-left:19px";>
		<br>
		<hr	 />

		<h3>Dirección</h3>
		<hr width=27%  align="left" size=3 >

		<div><label for="calle">Calle/Avda.:<em>*</em></label>
		<input id="calle" name="calle" type="text" value="<?php echo $formulario['calle']; ?>" required style="margin-left:67px";>
		</div>
		<br />
		<div><label for="provincia">Provincia:<em>*</em></label>
		<input id="provincia" name="provincia" type="text" value="<?php echo $formulario['provincia']; ?>" style="margin-left:81px"; required >
		</div>
		<br />
		<div><label for="municipio">Municipio:<em>*</em></label>
		<input id="municipio" name="municipio" type="text" required value="<?php echo $formulario['municipio']; ?>" style="margin-left:76px";>
		</div>
		<hr	 />
		<div><input type="submit" value="Enviar" /></div>
		</form>
		<?php
		cerrarConexionBD($conexion);
		?>
	</body>
</html>