<?php

	session_start();
	$version = 5;
    require_once("gestionBD.php");
    require_once("gestionCliente.php");
    require_once("Paginacion.php");
	
	// if (isset($_SESSION["libro"])){
		// $libro = $_SESSION["libro"];
		// unset($_SESSION["libro"]);
	// }

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?

	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"];
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]: (isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);

	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]: (isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);

	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante

	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse

	$query = "SELECT * FROM CLIENTE"; //consulta_paginada($conexion, $query, 3, 3);

	
	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1

	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0) $total_paginas++;
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
	
    cerrarConexionBD($conexion);
?>


	<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
   <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/Proyecto.css?v=<?= $version ?>" />
<script src="js/boton.js?v=<?= $version ?>"></script>
  <title>Gestión de Clientes: Lista de Clientes</title>
</head>

<body> 
	<?php
include_once ("cabecera.php");
?>
<main>
		<header>
			<h2>Clientes</h2>
			<hr	 />
			</header>

		<ul>
  <li><a href= "Principal.php">Polar Montajes:</a></li>
  <li><a href= "Servicios.php">Servicio</a></li>
  <li><a href="Trabajadores.php">Trabajadores</a></li>
  <li><a href= "Ayuda.php">Ayuda</a></li>
  <li><a href="Contacto.php">Contact</a></li>
  <li><a href="About.php">About</a></li>
	</ul>


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

						<a href="ConsultaClientes.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>
		<div style="text-align:center;">
			<form method="get" action="ConsultaClientes.php">

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
        <tr><th>Nombre</th>
            <th>Apellidos</th>
	    <th>DNI</th>
	    <th>Correo</th>
	    <th>Telefono</th>
	    <th>Dirección</th>
	    <th>Codigo Postal</th>
	    <th> Modificar</th>
	    <th> Borrar</th>
        </tr>
    </thead>
    <tbody>
	<?php

		foreach($filas as $fila) {

	?>

<tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle" id="div2">        
	 <article class="cliente">

		<form method="post" action="controladorClientes.php">

			<div class="fila_empleado">

				<div class="datos_empleado">

					<input id="DNICLIENTE" name="DNICLIENTE"

						type="hidden" value="<?php echo $fila["DNICLIENTE"]; ?>"/>

					<input id="NOMBRE" name="NOMBRE"

						type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

					<input id="APELLIDOS" name="APELLIDOS"

						type="hidden" value="<?php echo $fila["APELLIDOS"]; ?>"/>
						
						<input id="CORREO" name="CORREO"

						type="hidden" value="<?php echo $fila["CORREO"]; ?>"/>
						
				<?php

					if (isset($cliente) and ($cliente["DNICLIENTE"] == $fila["DNICLIENTE"])) { ?>


						<h3><input id="DNICLIENTE" name="DNICLIENTE" type="text" value="<?php echo $fila["DNICLIENTE"]; ?>"/>	</h3>

						<h4><?php echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]; ?></h4>

				<?php }	else { ?>


						<input id="DNI" name="DNI" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

						
						<div class="fila"><b><td><?php echo $fila["NOMBRE"]?> </td><td><?php echo $fila["APELLIDOS"]?></td><td><?php echo $fila["DNICLIENTE"]?></td><td><?php echo $fila["CORREO"] ;?></td>
							<td><?php echo $fila["TELEFONO"]?></td><td><?php echo $fila["DIRECCION"] ;?></td> <td><?php echo $fila["CODIGOPOSTAL"]?></td>
						<td>
				<?php } ?>
				
					<div id="botones_fila">

				<?php if (isset($cliente) and ($cliente["DNICLIENTE"] == $fila["DNICLIENTE"])) { ?>

						<button id="grabar" name="grabar" type="submit" class="editar_fila">

							<img src="imagenes/pngocean_opt.png" class="editar_fila" alt="Guardar modificación">

						</button>

				<?php } else { ?>

						<button id="editar" name="editar" type="submit" class="editar_fila">

							<img src="imagenes/pngocean_opt.png" class="editar_fila" alt="Editar Cliente">

						</button>
					</td>
					<td>
				<?php } ?>
						
					<button id="borrar" name="borrar" type="submit" class="editar_fila">

						<img src="imagenes/borrar.png" class="editar_fila" alt="Borrar libro" >

					</button>
				</div>
				</td>
				</b></div>

			</div>

		</form>
	</article>
	 </tr>
	


	<?php } ?>
</tbody>
</table>
</div>
</main>
</body>
</html>