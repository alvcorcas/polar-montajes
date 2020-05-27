<?php
session_start();
$version = 6;
include_once ("../gestionBD.php");
include_once ("gestionUsuario.php");

if (isset($_POST['submit'])) {
	$nif = $_POST['nif'];
	$pass = $_POST['pass'];

	$conexion = crearConexionBD();
	$num_usuarios = consultarUsuario($conexion, $nif, $pass);
	

	if ($num_usuarios == 0)
		$login = "error";
	else {
		$_SESSION['login'] = $nif;
		$_SESSION['perfil'] = obtenerPerfil($conexion, $nif);
		Header("Location: ../principal/index.php");
	}
	cerrarConexionBD($conexion);
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/login.css?v=<?= $version ?>" />

		<title>Polar Montajes: Login</title>
	</head>

	<body>

		<?php
		include_once ("../cabecera.php");
		?>
		<main>
			<header>
				<h2>Inicio de Sesión</h2>
				<hr	 />
			</header>

			<nav>

				<?php
	if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error: El usuario o la contraseña es invalido/a.";
		echo "</div>";
	}
				?>
				<!-- The HTML login form -->
				<br>
				</br>
				<div class="login">
					<fieldset>
						<legend>
							Inicio de Sesión
						</legend>
						<br>

						<form action="login.php" method="post">
							<div  style="margin-right:100px;">
								<label for="nif">DNI: </label>
								<input type="text" name="nif" id="nif" style="margin-left:65px;"/>
							</div>
							<br />
							<div style="margin-right:100px;">
								<label for="pass">Contraseña: </label>
								<input type="password" name="pass" id="pass" style="margin-left:20px;"/>
							</div>
							<br>
							<input type="submit" name="submit" value="submit"  style="margin-left:2px;"/>
						</form>

						<p style="margin-right:25px;">
							¿No estás registrado? <a href="formularioAltaUsuario.php">¡Registrate!</a>
						</p>
					</fieldset>
				</div>
		</main>

	</body>
</html>