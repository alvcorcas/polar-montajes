<?php

	session_start();
	$version = 1225;
    require_once("../gestionBD.php");
    require_once("../clientes/gestionCliente.php");
    require_once("../paginacion.php");
	
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
$dni = $_SESSION['login'];
$query = "SELECT * FROM FACTURA NATURAL JOIN CLIENTE WHERE DNICLIENTE = '$dni'";

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
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css?v=<?= $version ?>" />
<script src="js/boton.js?v=<?= $version ?>"></script>
  <title>Gestión de Clientes: Lista de Facturas</title>
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
  <li><a href= "../principal/index.php">Polar Montajes:</a></li>
  <li><a href= "../principal/servicios.php">Servicio</a></li>
  <li><a href="../operarios/consultaTrabajadores.php">Trabajadores</a></li>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Cliente'){?>
  	<li><a href="facturasPorCliente.php">Mis facturas</a></li>
  	<?php }?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../facturas/Facturas.php">Facturas</a></li>
  	<?php }?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../clientes/ConsultaClientes.php">Clientes</a></li>
  	<?php }?>
  	<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../pedidos/consultaPedidos.php">Pedidos</a></li>
  	<?php }?>
  <li><a href="contacto.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="../usuarios/login.php">Login</a></li>
  <li><a href="../usuarios/logout.php">Logout</a></li>
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

						<a href="facturasPorCliente.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>
		<div style="text-align:center;">
			<form method="get" action="facturasPorCliente.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			A continuación de muestran

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			facturas de <?php echo $total_registros?> facturas que hay registradas.

			<input type="submit" value="Cambiar">

		</form>
	</div>
	</nav>
	
	<br><br /><br />


	<div >
		<table class="table table-condensed" style="border-collapse:collapse; text-align: center;">
			<thead>
        <tr><th>ID</th>
            <th>Fecha de Emisión</th>
	    <th>Fecha de Vencimiento</th>
	    <th>Tipo de Pago</th>
	    <th>Precio sin IVA</th>
	    <th>IVA</th>
	    <th>Precio Total</th>
	    <th>DNI del Operario </th>
	     <th>DNI del Cliente </th>
	    <th> Modificar</th>
	    <th> Borrar</th>
        </tr>
    </thead>
    <tbody>
	<?php

		foreach($filas as $fila) {

	?>
<?php

				
				if($fila["PAGADA"] == 1) { ?>
<tr class="fila1" data-toggle="collapse" data-target="#demo1" class="accordion-toggle" id="div2">        
	 <article class="cliente">

		<form method="post" action="controladorFactura.php">

			<div class="fila_empleado">

				<div class="datos_empleado">

					<input id="IDFACTURA" name="IDFACTURA"

						type="hidden" value="<?php echo $fila["IDFACTURA"]; ?>"/>

					<input id="FECHAEMISION" name="FECHAEMISION"

						type="hidden" value="<?php echo $fila["FECHAEMISION"]; ?>"/>

					<input id="FECHAVENCIMIENTO" name="FECHAVENCIMIENTO"

						type="hidden" value="<?php echo $fila["FECHAVENCIMIENTO"]; ?>"/>
						
						<input id="TIPOPAGO" name="TIPOPAGO"

						type="hidden" value="<?php echo $fila["TIPOPAGO"]; ?>"/>
						
						<input id="PRECIOSINIVA" name="PRECIOSINIVA"

						type="hidden" value="<?php echo $fila["PRECIOSINIVA"]; ?>"/>
						
						<input id="IVA" name="IVA"

						type="hidden" value="<?php echo $fila["IVA"]; ?>"/>
						
						<input id="PRECIOCONIVA" name="PRECIOCONIVA"

						type="hidden" value="<?php echo $fila["PRECIOCONIVA"]; ?>"/>
						
						<input id="DNIOPERARIO" name="DNIOPERARIO"

						type="hidden" value="<?php echo $fila["DNIOPERARIO"]; ?>"/>
						
						<input id="DNICLIENTE" name="DNICLIENTE"

						type="hidden" value="<?php echo $fila["DNICLIENTE"]; ?>"/>
						
						
				
					
					<?php

					if (isset($factura) and ($factura["IDFACTURA"] == $fila["IDFACTURA"])) { ?>


						<h3><input id="IDFACTURA" name="IDFACTURA" type="text" value="<?php echo $fila["IDFACTURA"]; ?>"/>	</h3>

						<h4><?php echo $fila["FECHAEMISION"]." ".$fila["FECHAVENCIMIENTO"]; ?></h4>

				<?php }	else { ?>


						<input id="DNI" name="DNI" type="hidden" value="<?php echo $fila["FECHAEMISION"]; ?>"/>

						
						<div class="fila"><b><td><?php echo $fila["IDFACTURA"]?> </td><td><?php echo $fila["FECHAEMISION"]?></td><td><?php echo $fila["FECHAVENCIMIENTO"]?></td><td><?php echo $fila["TIPOPAGO"] ;?></td>
							<td><?php echo $fila["PRECIOSINIVA"]?></td><td><?php echo $fila["IVA"] ;?></td> <td><?php echo $fila["PRECIOCONIVA"]?></td> <td><?php echo $fila["DNIOPERARIO"]?></td><td><?php echo $fila["DNICLIENTE"]?></td>
						<td>
				<?php } ?>
				
				
					<div id="botones_fila">

				<?php if (isset($factura) and ($factura["IDFACTURA"] == $fila["IDFACTURA"])) { ?>

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
				
				</b>
					<?php }	else { ?>
						<tr class="fila" data-toggle="collapse" data-target="#demo1" class="accordion-toggle" id="div2">        
	 <article class="cliente">

		<form method="post" action="controladorFactura.php">

			<div class="fila_empleado">

				<div class="datos_empleado">

					<input id="IDFACTURA" name="IDFACTURA"

						type="hidden" value="<?php echo $fila["IDFACTURA"]; ?>"/>

					<input id="FECHAEMISION" name="FECHAEMISION"

						type="hidden" value="<?php echo $fila["FECHAEMISION"]; ?>"/>

					<input id="FECHAVENCIMIENTO" name="FECHAVENCIMIENTO"

						type="hidden" value="<?php echo $fila["FECHAVENCIMIENTO"]; ?>"/>
						
						<input id="TIPOPAGO" name="TIPOPAGO"

						type="hidden" value="<?php echo $fila["TIPOPAGO"]; ?>"/>
						
						<input id="PRECIOSINIVA" name="PRECIOSINIVA"

						type="hidden" value="<?php echo $fila["PRECIOSINIVA"]; ?>"/>
						
						<input id="IVA" name="IVA"

						type="hidden" value="<?php echo $fila["IVA"]; ?>"/>
						
						<input id="PRECIOCONIVA" name="PRECIOCONIVA"

						type="hidden" value="<?php echo $fila["PRECIOCONIVA"]; ?>"/>
						
						<input id="DNIOPERARIO" name="DNIOPERARIO"

						type="hidden" value="<?php echo $fila["DNIOPERARIO"]; ?>"/>
						
						<input id="DNICLIENTE" name="DNICLIENTE"

						type="hidden" value="<?php echo $fila["DNICLIENTE"]; ?>"/>
						
						<?php
					
					if (isset($factura) and ($factura["IDFACTURA"] == $fila["IDFACTURA"])) { ?>


						<h3><input id="IDFACTURA" name="IDFACTURA" type="text" value="<?php echo $fila["IDFACTURA"]; ?>"/>	</h3>

						<h4><?php echo $fila["FECHAEMISION"]." ".$fila["FECHAVENCIMIENTO"]; ?></h4>

				<?php }	else { ?>


						<input id="DNI" name="DNI" type="hidden" value="<?php echo $fila["FECHAEMISION"]; ?>"/>

						
						<div class="fila1"><b><td><?php echo $fila["IDFACTURA"]?> </td><td><?php echo $fila["FECHAEMISION"]?></td><td><?php echo $fila["FECHAVENCIMIENTO"]?></td><td><?php echo $fila["TIPOPAGO"] ;?></td>
							<td><?php echo $fila["PRECIOSINIVA"]?></td><td><?php echo $fila["IVA"] ;?></td> <td><?php echo $fila["PRECIOCONIVA"]?></td> <td><?php echo $fila["DNIOPERARIO"]?></td><td><?php echo $fila["DNICLIENTE"]?></td>
						<td>
				<?php } ?>
				
				
					<div id="botones_fila">

				<?php if (isset($factura) and ($factura["DNICLIENTE"] == $fila["DNICLIENTE"])) { ?>

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
				
				</b>
						
					<?php } ?>	
				</div>
				
			</div>

		</form>
	</article>
	 </tr>
	


	<?php } ?>
</tbody>
</table>
</div>
<br />
		<br />
		<footer >
		<a> Universidad De Sevilla</a> <h5> Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado</h5>
	</footer>
</main>
</body>
</html>