<?php

session_start();

// include_once ("funciones.php");
require_once ("../gestionBD.php");
require_once ("GestionServicio.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	$nuevoServicio = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
} else
	Header("Location: CrearServicio.php");

$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
  <title>Nuevo servicio creado con éxito</title>
</head>

<body>
	
<?php
include_once ("../cabecera.php");
	?>
	
<main>
	
	<?php if (alta_servicio($conexion, $nuevoServicio)) {
			?>
		<div id="div_exito">
		  
		  <h2>El nuevo servicio ha sido dado de alta con éxito con los siguientes datos:</h2>
		<ul>
			
			<br ><?php echo " TIEMPOEMPLEADO: " . $nuevoServicio["TIEMPOEMPLEADO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " FECHAINICIO: " . $nuevoServicio["FECHAINICIO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " FECHAFIN: " . $nuevoServicio["FECHAFIN"]; ?></br>
			<br>
			<br>
			<br ><?php echo " TIPOSERVICIO: " . $nuevoServicio["TIPOSERVICIO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " TERCERAEMPRESA: " . $nuevoServicio["TERCERAEMPRESA"]; ?></br>
			<br>
			<br>
			<br ><?php echo " DNICLIENTE: " . $nuevoServicio["DNICLIENTE"]; ?></br>
			<br>
			<br>
				</ul>		
			<div id="div_volver">	
			   Pulsa <a href="Servicios.php">aquí</a> para volver a servicios.
			</div>
		</div>
		<?php } else { ?>
				<h1>El servicio ya existe en la base de datos</h1>
				<ul>
			
			<br ><?php echo " TIEMPOEMPLEADO: " . $nuevoServicio["TIEMPOEMPLEADO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " FECHAINICIO: " . $nuevoServicio["FECHAINICIO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " FECHAFIN: " . $nuevoServicio["FECHAFIN"]; ?></br>
			<br>
			<br>
			<br ><?php echo " TIPOSERVICIO: " . $nuevoServicio["TIPOSERVICIO"]; ?></br>
			<br>
			<br>
			<br ><?php echo " TERCERAEMPRESA: " . $nuevoServicio["TERCERAEMPRESA"]; ?></br>
			<br>
			<br>
			<br ><?php echo " DNICLIENTE: " . $nuevoServicio["DNICLIENTE"]; ?></br>
			
				</ul>	
				<div >	
					Pulsa <a href="CrearServicio.php">aquí</a> para volver al formulario.
				</div>
		<?php } ?>

	
	</main>
	</body>
</html>
<?php

cerrarConexionBD($conexion);
?>
		