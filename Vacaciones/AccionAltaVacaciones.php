<?php

session_start();

// include_once ("funciones.php");
require_once ("../gestionBD.php");
require_once ("GestionVacaciones.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	$vacaciones = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else
	Header("Location: Vacaciones.php");

$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
  <title>Nuevas Vacaciones creadas con éxito</title>
</head>

<body>
	
<?php
include_once ("../Cabecera.php");
	?>
	
<main>
	
	<?php if (alta_periodo($conexion, $vacaciones)) {
			?>
		<div id="div_exito">
		  
		  <h2>El periodo de vacaciones ha sido escogido con éxito </h2>
<ul>
			
			<br ><?php echo " FECHAINICIO: " . $vacaciones["FECHAINICIO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " FECHAFIN: " . $vacaciones["FECHAFIN"]; ?></br>
			<br>
			<br>
			<br ><?php echo " TIPOVACACIONES: " . $vacaciones["TIPOVACACIONES"]; ?></br>
			<br>
			<br>
			<br ><?php echo " DNIOPERARIO: " . $vacaciones["DNIOPERARIO"]; ?></br>
			<br>
			<br>
				</ul>		
		
			<div id="div_volver">	
			   Pulsa <a href="Vacaciones.php">aquí</a> para volver a servicios.
			</div>
		</div>
		<?php } else { ?>
				<h1>Este periodo de vacaciones ya esta cogido por otro empleado</h1>
				<ul>
			
			<br ><?php echo " FECHAINICIO: " . $vacaciones["FECHAINICIO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " FECHAFIN: " . $vacaciones["FECHAFIN"]; ?></br>
			<br>
			<br>
			<br ><?php echo " TIPOVACACIONES: " . $vacaciones["TIPOVACACIONES"]; ?></br>
			<br>
			<br>
			<br ><?php echo " DNIOPERARIO: " . $vacaciones["DNIOPERARIO"]; ?></br>
			<br>
			<br>
				</ul>	
				<div >	
					Pulsa <a href="Vacaciones.php">aquí</a> para volver a elegir otro periodo.
				</div>
		<?php } ?>

	
	</main>
	</body>
</html>
<?php

cerrarConexionBD($conexion);
?>
	