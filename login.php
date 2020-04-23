<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionUsuario.php");
	
	if (isset($_POST['submit'])){
		$nif= $_POST['nif'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$nif,$pass);
		cerrarConexionBD($conexion);	
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $nif;
			Header("Location: Principal.php");
		}	
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/Proyecto.css" />
  <title>Polar Montajes: Login</title>
</head>

<body>

<body> 
	<?php
include_once ("cabecera.php");
?>
<main>
		<header>
			<h2>Inicio de Sesión</h2>
			<hr	 />
			</header>

	<ul>
  <li><a href= "Principal.php">Polar Montajes:</a></li>
  <li><a href= "Servicios.php">Servicio</a></li>
  <li><a href="Trabajadores.php">Trabajadores</a></li>
  <li><a href= "Ayuda.php">Ayuda</a></li>
  <li><a href="Contacto.php">Contact</a></li>
  <li><a href="About.php">About</a></li>
	</ul>

 <nav>

	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Error: El usuario o la contraseña es invalido/a.";
		echo "</div>";
	}	
	?>
	<!-- The HTML login form -->
	<br></br>	
	<form action="login.php" method="post">
		<div><label for="nif">DNI: </label><input type="text" name="nif" id="nif" /></div>
		<p></p>	
		<div><label for="pass">Contraseña: </label><input type="password" name="pass" id="pass" /></div>
		<input type="submit" name="submit" value="submit" />
	</form>
		
	<p>¿No estás registrado? <a href="FormAltaUsuario.php">¡Registrate!</a></p>
</main>


</body>
</html>