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
		<h2>Añade un Servicio</h2>
		<hr	 />
		</header>

		<br>
		<!-- Formulario a rellenar con el contenido de la factura creada -->
		<form id="nuevoServicio" method="post" action="ValidacionCrearServicio.php">
		<label>Fecha de emision: </label>
		<input type="date" name="FECHAINICIO" placeholder="dd/mm/aaaa" /> <br><br>
		<label>Fecha de vencimiento: </label>
		<input type="date" name="FECHAFIN" placeholder="dd/mm/aaaa" />  <br><br>
		<label>Tipo de Servicio:</label>
		<label>
		<input name="TIPOSERVICIO" type="radio" value="Nuevas Instalaciones"  style="margin-left:30px;">
		Nueva Instalación</label>
		<label>
		<input name="TIPOSERVICIO" type="radio" value="Mantenimiento" >
		Mantenimiento</label>
		<label>
		<input name="TIPOSERVICIO" type="radio" value="Reparacion" checked="true">
		Reparación</label>
		<br>
		<br />

		<label>Tiempo empleado (horas): </label>
		<input type="text" name="TIEMPOEMPLEADO" placeholder="xxx"  pattern="[0-9]+"/><br><br>
		<label>DNI del cliente: </label>
		<input type="text" name="DNICLIENTE" placeholder="xxxxxxxxL"  pattern="^[0-9]{8}[A-Z]"/><br><br>
		<label>Tercera Empresa: </label>
		<input type="text" name="TERCERAEMPRESA" placeholder="[0/1]" pattern="[0-1]{1}"/><br><br>

		<input type="submit" value="Crear servicio">
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