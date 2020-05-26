<?php
	session_start();
	
	?>
	
	<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/Proyecto.css" />
	<script type="text/javascript" src="./js/boton.js"></script>
  <title>Gestión de Clientes: Pagina Principal</title>
</head>

<body> 
	<?php
include_once ("cabecera.php");
?>
<main>
		<header>
			<h2>¡Bienvenido/a a Polar Montajes!</h2>
			<hr	 />
			</header>

		<ul>
  <li><a href= "Principal.php">Polar Montajes:</a></li>
  <li><a href= "Servicios.php">Servicio</a></li>
  <li><a href="operarios/Trabajadores.php">Trabajadores</a></li>
  <li><a href= "FacturaPorCliente.php">Ayuda</a></li>
  <li><a href="Contacto.php">Contact</a></li>
  <li><a href="About.php">About</a></li>
	</ul>
	
	<a href="clientes/FacturaPorCliente.php" >Prueba</a>
	
	<footer>
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
	
</main>
</body>
</html>