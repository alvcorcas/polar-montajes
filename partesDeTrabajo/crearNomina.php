<?php
session_start();

require_once ("../gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	$formulario['HORASTRABAJADAS'] = "";
	$formulario['HORASEXTRAS'] = "";
	$formulario['PRECIOHORA'] = "";
	$formulario['MESAÑO'] = "";
	$formulario['DNIOPERARIO'] = "";

	// Guardamos los datos en la sesión
	$_SESSION['formulario'] = $formulario;
} else {
	//Si ya se ha completado el formulario
	$formulario = $_SESSION['formulario'];
	unset($_SESSION['formulario']);
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
			<h2>Creación de nómina</h2>
			<hr	 />
		</header>
		<br>
		<!-- Formulario a rellenar con el contenido de la nómina creada -->
		<form id="nuevaNómina" method="post" action="ValidacionCrearNomina.php">
			<label>Horas trabajadas por el operario: </label>
			<input type="text" name="HORASTRABAJADAS" placeholder="xx"  pattern="[0-9]+"/>
			<br>
			<br>
			<label>Horas extras trabajadas por el operario: </label>
			<input type="text" name="HORASEXTRAS" placeholder="xx"  pattern="[0-9]+"/>
			<br>
			<br>
			<label> Mes y año </label>
			<input name="MESANO" type="month" placeholder="dd/mm/aaaa" required"/>
			<label>Dinero por hora</label>
			<input type="text" name="PRECIOHORA"  placeholder="xx" pattern="[0-9]+" required /> <br><br>
			<br>
			<label>Dni del operario</label>
			<input type="text" name="DNIOPERARIO" placeholder="x"  pattern="[0-9]{8}[A-Z]{1}"/>
			<br>
			<br>
			<input type="submit" value="Submit">
		</form>
		<?php
		cerrarConexionBD($conexion);
		?>

		<br />
		<br />
		<footer >
			<a> Universidad De Sevilla</a><h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
		</footer>
	</body>
</html>