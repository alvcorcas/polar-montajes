<?php
session_start();

require_once ("../gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	// Inicializamos la variable con los datos del formulario asignando valores por defecto a los elementos
	$formulario['nif'] = "";
	// Guardamos los datos en la sesión
	$_SESSION['formulario'] = $formulario;
} else {
	//Si ya se ha completado el formulario
	$formulario = $_SESSION['formulario'];
}

if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
		<script src="js/boton.js?v=<?= $version ?>"></script>
		<title>Creación de una factura</title>
	</head>

	<body>
		<?php
		include_once ("../cabecera.php");
		?>
		<main>
			<header>
				<h2>Facturas</h2>
				<hr	 />
			</header>

			<ul>
				<li>
					<a href= "../principal/index.php">Polar Montajes:</a>
				</li>
				<li>
					<a href= "../principal/servicios.php">Servicio</a>
				</li>
				<li>
					<a href="../operarios/consultaTrabajadores.php">Trabajadores</a>
				</li>
				<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Cliente'){
				?>
				<li>
					<a href="../clientes/facturasPorCliente.php">Mis facturas</a>
				</li>
				<?php } ?>
				<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){
				?>
				<li>
					<a href="../facturas/consultaFacturas.php">Facturas</a>
				</li>
				<?php } ?>
				<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){
				?>
				<li>
					<a href="../clientes/consultaClientes.php">Clientes</a>
				</li>
				<?php } ?>
				<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){
				?>
				<li>
					<a href="../pedidos/consultaPedidos.php">Pedidos</a>
				</li>
				<?php } ?>
				<li>
					<a href="contacto.php">Contact</a>
				</li>
				<li>
					<a href="about.php">About</a>
				</li>
				<li>
					<a href="../usuarios/login.php">Login</a>
				</li>
				<li>
					<a href="../usuarios/logout.php">Logout</a>
				</li>
			</ul>
			
			<br>
			<!-- Formulario a rellenar con el contenido de la factura creada -->
			<form id="nuevaFactura" method="post" action="controladorFacturas.php">
				<label>ID de la factura: </label>
				<input type="text" name="IDFACTURA" placeholder="LLxxxx" pattern="[A-Z]{2}[0-9]{4}"/><br><br>
				<label>Fecha de emision: </label>
				<input type="date" name="FECHAEMISION" placeholder="dd/mm/aaaa"/><br><br>
				<label>Fecha de vencimiento: </label>
				<input type="date" name="FECHAVENCIMIENTO" placeholder="dd/mm/aaaa"/><br><br>
				<label>Tipo de Pago: </label>
				<input type="radio" name="transferenciaBancaria"/>
				
				
				
				
				Precio sin IVA	
				IVA	Precio Total
				DNI del Operario	
				DNI del Cliente
				
				<input type="submit" value="Submit">
			</form>

		</main>
	</body>
</html>