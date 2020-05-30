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
  <title>Polar Montajes: Contacto</title>
</head>

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
  	<li><a href="../operarios/FacturasPorOperario.php">Facturas</a></li>
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
	
<body> 
	<?php
include_once ("../cabecera.php");
?>
<main>
		<header>
			<h2>¡Contáctanos!</h2>
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
	
	
	</div>

   <div>


<div class ="text" style = "margin-top: 30px; margin-left:60px;">
	<div>
		
	<br style="margin-left: 100px">Para contactar con <strong><em>Polar Montajes</em></strong> dispone de diferentes posibilidades: </br>
	<br />
	<br />
	<fieldset>
		<br />
		<br />
		<div>
	 <div class="img" >
<img src="../imagenes/11.png" align="left" width="80" height="70">
		
		<br> 657756874 --- 623490812 </br>
	
		</div>
		<br />
		<br />
		<br />
			<div>
	 <div class="img" >
<img src="../imagenes/instagram.jpg" align="left" width="80" height="70">

		@PolarMontajes
	
		</div>
		<br />
		<br />
		<br />
	 <div class="img" >
<img src="../imagenes/facebook.jpg" align="left" width="80" height="60">
	<div class="text1" style="margin-left:100px;">
		<br />
	      @PolarMontajes
	</div>
		</div>
		<br />
		<br />
		<br />
	 <div class="img" >
<img src="../imagenes/gmail.jpg" align="left" width="80" height="60">
	<div class="text1" style="margin-left:100px;">
		<br>
		polarmontajes@gmail.com
	</div>
		</div>
		<br />
		<br />
		<br />
	</fieldset>
	
	</div>

</div>
</div>	
</div>
</div>
<br />
<br />
	<footer>
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
	
</main>
</body>
</html>