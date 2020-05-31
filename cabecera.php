<?php
$sesionIniciada = isset($_SESSION["login"]);
if ($sesionIniciada)
	$perfilUsuario = $_SESSION["perfil"];
?>

<header>
	<a href="../principal/index.php"><img src="../imagenes/Logo.png" alt="Instalaciones Eléctricas" ></a><h1>Instalaciones Eléctricas</h1>
	<br />
	<br />
	<br />
	<br />
	<hr width=30% size=3 style="margin-right: 274px;">
</header>

<ul>
	<!-- Referencias a los documentos más importantes que componen el sitio web -->
	<li>
		<a href= "../principal/servicios.php">Servicio</a>
	</li>

	<li>
		<a href="../operarios/consultaTrabajadores.php">Trabajadores</a>
	</li>

	<!-- Consultas de facturas:
	- Los operarios podrán ver las facturas que hayan emitido ellos mismos
	- Los clientes podrán ver las facturas a su cargo
	- Los gerentes tendrán acceso a todas las facturas de la página web
	-->

	<?php if ($sesionIniciada and $perfilUsuario == "Cliente") {
	?>

	<li>
		<a href="../clientes/facturasPorCliente.php">Mis facturas</a>
	</li>

	<?php } else if ($sesionIniciada and $perfilUsuario == "Trabajador") { ?>

	<li>
		<a href="../operarios/FacturasPorOperario.php">Facturas</a>
	</li>

	<?php } else if($sesionIniciada and $perfilUsuario == "Gerente") { ?>

	<li>
		<a href="../facturas/consultaFacturas.php">Facturas</a>
	</li>

	<?php  } ?>

	<!-- El personal de la empresa podrá consutar todos los clientes que estén almacenados en la base de datos -->

	<?php if ($sesionIniciada and ($perfilUsuario == "Trabajador" or $perfilUsuario == "Gerente")) {
	?>

	<li>
		<a href="../clientes/consultaClientes.php">Clientes</a>
	</li>

	<!-- De igual manera también podrá consutar todos los pedidos que se hayan realizado -->

	<li>
		<a href="../pedidos/consultaPedidos.php">Pedidos</a>
	</li>

	
	<li>
		<a href="../Servicios/Servicios.php">Servicios Prestados</a>
	</li>

	<li>
		<a href="../Vacaciones/Vacaciones.php">Vacaciones</a>
	</li>

	<?php } ?>

	<li>
		<a href="../principal/contacto.php">Contact</a>
	</li>

	<li>
		<a href="../principal/about.php">About</a>
	</li>

	<?php if($sesionIniciada) {
	?>
	<li>
		<a href="../usuarios/logout.php">Logout</a>
	</li>
	<?php } else { ?>

	<li>
		<a href="../usuarios/login.php">Login</a>
	</li>

	<?php  } ?>
</ul>