
<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
	if (isset($_POST['submit'])){
		$email= $_POST['email'];
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$email,$user,$pass);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $email;
			Header("Location: index.php");
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
	include_once("cabeceraprincipal.php");
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
		<div><label for="email">Email: </label><input type="text" name="email" id="email" /></div>
		<p></p>	
		<div><label for="email">Usuario: </label><input type="text" name="user" id="user" /></div>
		<p></p>	
		<div><label for="pass">Contraseña: </label><input type="password" name="pass" id="pass" /></div>
		<input type="submit" name="submit" value="submit" />
	</form>
		
	<p>¿No estás registrado? <a href="altaUsuario.php">¡Registrate!</a></p>
</main>
<?php
	include_once("pieproyecto.php");
?>

</body>
</html>