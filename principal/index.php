<?php
	session_start();
	
	?>
	
	<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
	<script type="text/javascript" src="./js/boton.js"></script>
  <title>Gestión de Clientes: Pagina Principal</title>
</head>

<body> 
	<?php
include_once ("../cabecera.php");
?>
<main>
		<header>
			<h2>¡Bienvenido/a a Polar Montajes!</h2>
			<hr	 />
			</header>

		<ul>
  <li><a href= "index.php">Polar Montajes:</a></li>
  <li><a href= "servicios.php">Servicio</a></li>
  <li><a href="../operarios/consultaTrabajadores.php">Trabajadores</a></li>
  <li><a href= "ayuda.php">Ayuda</a></li>
  <li><a href="contacto.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
	</ul>
	
	<a href="clientes/facturasPorCliente.php" >Prueba</a>
	
	<footer>
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
	
</main>
</body>
</html>