<?php

session_start();
$version = 5;
require_once ("../gestionBD.php");
require_once ("GestionServicio.php");
require_once ("../paginacion.php");



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
$query = "SELECT * FROM SERVICIO";

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
	$servicio = $_SESSION['TRABAJADOR'];

cerrarConexionBD($conexion);
?>


	<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
   <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css?v=<?= $version ?>" />
<script src="js/boton.js?v=<?= $version ?>"></script>
  <title>Servicios de Polar Montajes</title>
</head>

<body> 
	<?php
	include_once ("../cabecera.php");
?>
<main>
		<header>
			<h2>Servicios hasta la fecha de hoy</h2>
			<hr	 />
			</header>

	

 <nav>
 	<br />
 	<br />

	<div>
		<div id="enlaces" style="text-align:center;" >

			<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="Servicios.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>
		<div style="text-align:center;">
			<form method="get" action="Servicios.php">

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
	
	<br><br /><br />


	<div >
		<table class="table table-condensed" style="border-collapse:collapse; text-align: center;">
			<thead>
        <tr><th>ID</th>
            <th>Tiempo Empleado (horas)</th>
	    <th>Fecha de Inicio</th>
	    <th>Fecha Fin</th>
	    <th>Servicio Prestado</th>
	    <th>Tercera Empresa</th>
	    <th>DNI del Cliente</th>
	    
        </tr>
    </thead>
    <tbody>
	<?php

		foreach($filas as $fila) {

	?>
	
	
					
					
					<tr class=
					<?php if ($fila['FECHAFIN'] != null) { ?>
						"fila1" 
					<?php } else { ?>
						"fila"
					<?php } ?>
					data-toggle="collapse" data-target="#demo1" class="accordion-toggle" id="div2">        
	 <article class="cliente">

		<form method="post" action="ControladorServicios.php">

			<div class="fila_cliente">

				<div class="datos_cliente">

					<input id="OID_S" name="OID_S"

						type="hidden" value="<?php echo $fila["OID_S"]; ?>"/>
						
						<div><b>
							<td><?php echo $fila["OID_S"]?> </td>
							<td><?php echo $fila["TIEMPOEMPLEADO"]?></td>
							<td><?php echo $fila["FECHAINICIO"]?></td>
							<?php

					if (isset($servicio) and ($servicio["OID_S"] == $fila["OID_S"])) { ?>
						
						<td><input id="FECHAFIN" name="FECHAFIN" type="text" value="<?php echo $fila["FECHAFIN"]; ?>"/>	</td>
						<td><input id="TIPOSERVICIO" name="TIPOSERVICIO" type="text" value="<?php echo $fila["TIPOSERVICIO"]; ?>"/>	</td>
						<td><input id="TERCERAEMPRESA" name="TERCERAEMPRESA" type="text" value="<?php if($fila["TERCERAEMPRESA"] == 1){ ?>
		     Sí;
		<?php } else { ?>
			 No;
		<?php } ?>"/></td>
						<td><input id="DNICLIENTE" name="DNICLIENTE" type="text" value="<?php echo $fila["DNICLIENTE"]; ?>"/>	</td>
						<?php }	else { ?>
							<td><?php echo $fila["FECHAFIN"]; ?></td>
							<td><?php echo $fila["TIPOSERVICIO"]?></td>
							<td><?php if($fila["TERCERAEMPRESA"] == 1){ ?>
		     Sí
		<?php } else { ?>
			 No
		<?php } ?></td>
							<td><?php echo $fila["DNICLIENTE"]?></td>
						
				<?php } ?>
				</b>
				
				</div>

			</div>
</div>
		</form>
		
		
		
		
		
	</article>
	 </tr>
	


	<?php } ?>
	
	
</tbody>
</table>
<br />
<br />
<form action="CrearServicio.php" style="margin-left: 46%;">
    <input type="submit" value="Crear nuevo servicio" />
	</form>

<br />
		<br />
		<footer >
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
</main>
</body>
</html>