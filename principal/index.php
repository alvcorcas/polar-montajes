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
			<a href="../facturas/crearFactura.php">prueba</a>
			</header>

		<ul>
  <li><a href= "index.php">Polar Montajes:</a></li>
  <li><a href= "Servicios.php">Servicios</a></li>
  <li><a href="../operarios/consultaTrabajadores.php">Trabajadores</a></li>
    <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../facturas/consultaFacturas.php">Facturas</a></li>
  	<?php } ?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Cliente'){?>
  	<li><a href="../clientes/facturasPorCliente.php">Mis facturas</a></li>
  	<?php }?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../operarios/FacturasPorOperario.php"> Mis Facturas</a></li>
  	<?php }?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../clientes/ConsultaClientes.php">Clientes</a></li>
  	<?php }?>
  	<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../pedidos/consultaPedidos.php">Pedidos</a></li>
  	<?php }?>
  <li><a href="../Servicios/Servicios.php">Servicios Prestados</a></li>
  <li><a href="contacto.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="../usuarios/login.php">Login</a></li>
  <li><a href="../usuarios/logout.php">Logout</a></li>
	</ul>
	<br><br><br><br>
 	
 	<p align="center" style="border: PowderBlue 5px double; margin: 10px 305px 100px 305px;  border-top-left-radius: 20px; border-bottom-right-radius: 20px; padding: 3px 10px;; background-color: #ffffff9e; color: black; font-family: arial,helvetica; font-size: 12px; font-weight: bold;">
 						<br><em><b> ¡Bienvenidos a Polar Montajes!</b></em></br>
 					 <br>Polar Montajes es una empresa que se dedica a la instalación, mantenimiento y reparación de </br>
 					 <br> instalaciones eléctricas. La empresa fue creada en el año 1998 y surgió por la unión de dos </br>
 					 <br>amigos emprendedores, que tenian como único objetivo ganarse la vida. Ambos se dedicaban a lo mismo,</br>
 					 <br> y lanzaron este proyecto sin apenas recursos. Hoy día, Polar Montajes es reconocida a nivel autonómico </br>
 					 <br> como una de las mejores empresas en su sector, con una maquinaria y herramientas de trabajo innovadas</br>
 					 <br> y una eficacia y garantía de trabajo satisfactorio inigualable. Además, nuestra única prioridad es el </br>
 					 <br> cliente, por lo que trabajamos por y para ti. Si está interesado en conocer un poco más nuestros servicios</br>
 					 <br> y leer un poco que ofrecemos, pulsa <strong><em> <a href="Servicios.php">Aquí</a> </em>. En cambio, si está</br>
 					 <br> decidido/a en contratar uno de ellos o tienes alguna pregunta, contáctanos <strong><em> <a href="Contacto.php">aquí.</a> </em></br>
 					 <br></br>
 					 </p>
	
	<footer>
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
	
</main>
</body>
</html>