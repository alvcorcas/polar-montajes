<?php
session_start();

require_once ("../gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	$formulario['FECHAINICIO'] = "";
	$formulario['FECHAFIN'] = "";
	$formulario['TIPOVACACIONES'] = "Verano";
	$formulario['DNIOPERARIO'] = "";
	
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
			<form id="nuevoServicio" method="post" action="ValidacionVacaciones.php">
				<label>Fecha de Inicio: </label>
				<input type="date" name="FECHAINICIO" placeholder="dd/mm/aaaa" value="<?php echo $formulario['FECHAINICIO']; ?>"/> <br><br>
				<label>Fecha de Fin: </label>
				<input type="date" name="FECHAFIN" placeholder="dd/mm/aaaa" value="<?php echo $formulario['FECHAFIN']; ?>"/>  <br><br>
				<label>Tipo de Vacaciones:</label>
		<label>
		<input name="TIPOVACACIONES" type="radio" value="Verano" <?php
		if ($formulario['TIPOVACACIONES'] == 'Verano')
			echo ' checked ';
		?> style="margin-left:30px;">
		verano</label>
		<label>
		<input name="TIPOVACACIONES" type="radio" value="Navidad" <?php
		if ($formulario['TIPOVACACIONES'] == 'Navidad')
			echo ' checked ';
		?>>
		Navidad</label>
		<label>
		<input name="TIPOVACACIONES" type="radio" value="Asuntos Propios" <?php
		if ($formulario['TIPOVACACIONES'] == 'Asuntos Propios')
			echo ' checked ';
		?>>
		Asuntos Propios</label>
		<br>
		<br />
				
				
				<label>DNI del operario: </label>
				<input type="text" name="DNIOPERARIO" placeholder="xxxxxxxxL" value="<?php echo $formulario['DNIOPERARIO']; ?>" pattern="^[0-9]{8}[A-Z]"/><br><br>
				
				
				<input type="submit" value="Submit">
			</form>
<?php
		cerrarConexionBD($conexion);
		?>
	</body>
</html>