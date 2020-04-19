
<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionUsuario.php");
	
	if (isset($_POST['submit'])){
		$user = $_POST['usuario'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$user,$pass);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $user;
			Header("Location: Principal.php");
		}	
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/principal.css" />
  <title>Polar Montajes: Login</title>
</head>

<body>

<?php
	include_once("Cabecera.php");
?>

<main>
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error en la contraseña o no existe el usuario.";
		echo "</div>";
	}	
	?>
	<!-- The HTML login form -->
	<br></br>	
	<form action="login.php" method="post">
		<div><label for="usuario">Usuario: </label><input type="text" name="user" id="user" /></div>
		<p></p>	
		<div><label for="pass">Contraseña: </label><input type="password" name="pass" id="pass" /></div>
		<input type="submit" name="submit" value="submit" />
	</form>
		
	<p>¿No estás registrado? <a href="FormAltaUsuario.php">¡Registrate!</a></p>
</main>
<?php
	include_once("pieproyecto.php");
?>

</body>
</html>