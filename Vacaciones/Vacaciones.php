<?php
session_start();
$version = 5;
require_once ("../gestionBD.php");
require_once ("GestionVacaciones.php");
require_once ("../paginacion.php");
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
if (isset($_SESSION["paginacion"]))
	$paginacion = $_SESSION["paginacion"];
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);
if ($pagina_seleccionada < 1)
	$pagina_seleccionada = 1;
if ($pag_tam < 1)
	$pag_tam = 5;
unset($_SESSION["paginacion"]);
$conexion = crearConexionBD();
$query = "SELECT * FROM PERIODOVACACIONES";
$total_registros = total_consulta($conexion, $query);
$total_paginas = (int)($total_registros / $pag_tam);
if ($total_registros % $pag_tam > 0)
	$total_paginas++;
if ($pagina_seleccionada > $total_paginas)
	$pagina_seleccionada = $total_paginas;
// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion["PAG_NUM"] = $pagina_seleccionada;
$paginacion["PAG_TAM"] = $pag_tam;
$_SESSION["paginacion"] = $paginacion;
$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
if (isset($_SESSION['TRABAJADOR']))
	$vacaciones = $_SESSION['TRABAJADOR'];
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
				<h2>Gestion de vacaciones</h2>
				<hr	 />
			</header>
			
			<br>
			<br>
			<div style="display: flex">
				
			<br>
			<!-- Formulario a rellenar con el contenido de la factura creada -->
			<form id="nuevoServicio" method="post" action="ValidacionVacaciones.php">
				<br>
				<br>
				
				<label>Fecha de Inicio: </label>
				<input type="date" name="FECHAINICIO" placeholder="dd/mm/aaaa" value="<?php echo $formulario['FECHAINICIO']; ?>"/> <br><br>
				<br>
				<br>
				<label>Fecha de Fin: </label>
				<input type="date" name="FECHAFIN" placeholder="dd/mm/aaaa" value="<?php echo $formulario['FECHAFIN']; ?>"/>  <br><br>
				<br>
				<br>
				<label>Tipo de Vacaciones:</label>
		<label>
		<input name="TIPOVACACIONES" type="radio" value="Verano"  style="margin-left:30px;">
		Verano</label>
		<label>
		<input name="TIPOVACACIONES" type="radio" value="Navidad" >
		Navidad</label>
		<label>
		<input name="TIPOVACACIONES" type="radio" value="Asuntos Propios" >
		Asuntos propios</label>
		<br>
		<br />
				<br>
				<br>
				
				<input type="submit" value="Submit">
			</form>
			
			
			
				<div>
		<div id="enlaces" style="text-align:center;" >

			<?php
				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="Vacaciones.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>
		<div style="text-align:center;">
			<form method="get" action="Vacaciones.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>
	</div>
	</nav>
	
	<br><br />


	
		<table class="table table-condensed" style="border-collapse:collapse; text-align: center; width: 660px; margin-left: 100px" >
			<thead>
        <tr>
         
	    <th>Fecha de Inicio</th>
	    <th>Fecha Fin</th>
	    <th>Tipo de Vacaciones</th>
	    <th>DNI del Operario</th>
	    
        </tr>
    </thead>
    <tbody>
	<?php
		foreach($filas as $fila) {
	?>
		<?php
	$fechaInicio = $fila["FECHAINICIO"];
	$fechaFin = $fila["FECHAFIN"];
	$fechaActual = date('d-m-Y');
				?>	
					<tr class=
					<?php if ($fechaFin < $fechaActual ) { ?>
						"fila1" 
					<?php } else { ?>
						"fila"
					<?php } ?>
					data-toggle="collapse" data-target="#demo1" class="accordion-toggle" id="div2">        
	 <article class="cliente">

		<form method="post" action="ControladorVacaciones.php">

			<div class="fila_cliente">

				<div class="datos_cliente">

					<input id="DNIOPERARIO" name="DNIOPERARIO"

						type="hidden" value="<?php echo $fila["DNIOPERARIO"]; ?>"/>
						
						<div><b>
							<?php
					if (isset($vacaciones) and ($vacaciones["DNIOPERARIO"] == $fila["DNIOPERARIO"])) { ?>
						<td><input id="FECHAINICIO" name="FECHAINICIO" type="text" value="<?php echo $fechaInicio; ?>"/>	</td>
						<td><input id="FECHAFIN" name="FECHAFIN" type="text" value="<?php echo $fechaFin; ?>"/>	</td>
						<td><input id="TIPOVACACIONES" name="TIPOVACACIONES" type="text" value="<?php echo $fila["TIPOVACACIONES"]; ?>"/>	</td>
						<td><input id="DNIOPERARIO" name="DNIOPERARIO" type="text" value="<?php echo $fila["DNIOPERARIO"]; ?>"/>	</td>
						<?php }	else { ?>
							<td><?php echo $fechaInicio; ?></td>
							<td><?php echo $fechaFin; ?></td>
							<td><?php echo $fila["TIPOVACACIONES"]?></td>
							<td><?php echo $fila["DNIOPERARIO"]?></td>
						
				<?php } ?>
				</b>
				
				</div>

			</div>

		</form>
	</article>
	 </tr>
	


	<?php } ?>
</tbody>
</table>
</div>
				
			
			</div>
			</div>
<?php
		cerrarConexionBD($conexion);
		?>
	</body>
</html>