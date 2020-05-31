<?php
session_start();

require_once ("../gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	$formulario['OID_S'] = "";
	$formulario['TIEMPOEMPLEADO'] = "";
	$formulario['FECHAINICIO'] = "";
	$formulario['FECHAFIN'] = "";
	$formulario['TIPOSERVICIO'] = "Instalación Eléctrica";
	$formulario['TERCERAEMPRESA'] = "";
	$formulario['DNICLIENTE'] = "";
	
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
		<title>Creación de un Servicio</title>
	</head>

	<body>
		<?php
		include_once ("../cabecera.php");
		?>
		<?php
			if (isset($errores) && count($errores) > 0) {
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach ($errores as $error) {
				echo $error;
			}
			echo "</div>";
		}
		?>
			<header>
				<h2>Servicios Prestados</h2>
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
			<form id="nuevoServicio" method="post" action="ValidacionCrearServicio.php">
				<label>ID del Servicio: </label>
				<input type="text" name="OID_S" placeholder="xx" value="<?php echo $formulario['OID_S']; ?>" pattern="[0-9]+"/><br><br>
				<label>Fecha de emision: </label>
				<input type="date" name="FECHAINICIO" placeholder="dd/mm/aaaa" value="<?php echo $formulario['FECHAINICIO']; ?>"/> <br><br>
				<label>Fecha de vencimiento: </label>
				<input type="date" name="FECHAFIN" placeholder="dd/mm/aaaa" value="<?php echo $formulario['FECHAFIN']; ?>"/>  <br><br>
				<label>Tipo de Servicio:</label>
		<label>
		<input name="TIPOSERVICIO" type="radio" value="Nuevas Instalaciones" <?php
		if ($formulario['TIPOSERVICIO'] == 'Nuevas Instalaciones')
			echo ' checked ';
		?> style="margin-left:30px;">
		Nueva Instalación</label>
		<label>
		<input name="TIPOSERVICIO" type="radio" value="Mantenimiento" <?php
		if ($formulario['TIPOSERVICIO'] == 'Mantenimiento')
			echo ' checked ';
		?>>
		Mantenimiento</label>
		<label>
		<input name="TIPOSERVICIO" type="radio" value="Reparacion" <?php
		if ($formulario['TIPOSERVICIO'] == 'Reparacion')
			echo ' checked ';
		?>>
		Reparación</label>
		<br>
		<br />
				
				<label>Tiempo empleado (horas): </label>
				<input type="text" name="TIEMPOEMPLEADO" placeholder="xxx"  value="<?php echo $formulario['TIEMPOEMPLEADO']; ?>" pattern="[0-9]+"/><br><br>
				<label>DNI del cliente: </label>
				<input type="text" name="DNICLIENTE" placeholder="xxxxxxxxL" value="<?php echo $formulario['DNICLIENTE']; ?>" pattern="^[0-9]{8}[A-Z]"/><br><br>
				<label>Tercera Empresa: </label>
				<input type="text" name="TERCERAEMPRESA" placeholder="x" value="<?php echo $formulario['TERCERAEMPRESA']; ?>" pattern="[0-1]{1}"/><br><br>
				
				<input type="submit" value="Submit">
			</form>
<?php
		cerrarConexionBD($conexion);
		?>
		
		<br />
		<br />
		<footer >
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
	</body>
</html>