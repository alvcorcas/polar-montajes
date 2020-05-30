<header>
		<a href="../principal/index.php"><img src="../imagenes/Logo.png" alt="Instalaciones Eléctricas" ></a> <h1>Instalaciones Eléctricas</h1>
		<br />
		<br />
		<br />
		<?php echo $_SESSION['login']; ?>
	 <hr width=30% size=3 style="margin-right: 274px;"> 	
</header>

<ul>
  <li><a href= "../principal/index.php">Polar Montajes:</a></li>
  <li><a href= "../principal/servicios.php">Servicio</a></li>
  <li><a href="../operarios/consultaTrabajadores.php">Trabajadores</a></li>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Cliente'){?>
  	<li><a href="../clientes/facturasPorCliente.php">Mis facturas</a></li>
  	<?php } ?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../facturas/consultaFacturas.php">Facturas</a></li>
  	<?php } ?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../clientes/consultaClientes.php">Clientes</a></li>
  	<?php } ?>
  	<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../pedidos/consultaPedidos.php">Pedidos</a></li>
  	<?php } ?>
  <li><a href="contacto.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="../usuarios/login.php">Login</a></li>
  <li><a href="../usuarios/logout.php">Logout</a></li>
	</ul>