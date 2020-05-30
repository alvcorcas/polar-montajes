<?php

session_start();
$version = 1225;
require_once ("../gestionBD.php");
require_once ("gestionFactura.php");
require_once ("../paginacion.php");

// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
// ¿Hay una sesión activa?

if (isset($_SESSION["paginacion"]))
	$paginacion = $_SESSION["paginacion"];
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);

$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

if ($pagina_seleccionada < 1)
	$pagina_seleccionada = 1;
if ($pag_tam < 1)
	$pag_tam = 5;

// Antes de seguir, borramos las variables de sección para no confundirnos más adelante

unset($_SESSION["paginacion"]);

$conexion = crearConexionBD();

// La consulta que ha de paginarse

$query = "SELECT * FROM FACTURA";
//consulta_paginada($conexion, $query, 3, 3);

// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1

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

if (isset($_SESSION['FACTURA']))
	$factura = $_SESSION['FACTURA'];

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
  	<li><a href="../clientes/facturasPorCliente.php">Mis facturas</a></li>
  	<?php } ?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../facturas/consultaFacturas.php">Facturas</a></li>
  	<?php } ?>
  <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../clientes/consultaClientes.php">Clientes</a></li>
  	<?php } ?>
  	<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){?>
  	<li><a href="../pedidos/consultaPedidos.php">Pedidos</a></li>
  	<?php } ?>
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

						<a href="consultafacturas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>
		<div style="text-align:center;">
			<form method="get" action="consultaFacturas.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			A continuación se muestran

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
	    <th> Pagada</th>
        </tr>
    </thead>
    <tbody>
	<?php

		foreach($filas as $fila) {

	?>
				
						<tr class=
							<?php if($fila['PAGADA'] == 1) { ?>
								"fila1"
							<?php } else { ?>
								"fila"
							<?php } ?>

 data-toggle="collapse" data-target="#demo1" class="accordion-toggle" id="div2">        
	 <article class="cliente">

		<form method="post" action="controladorFactura.php">

			<div class="fila_empleado">

				<div class="datos_empleado">

					<input id="IDFACTURA" name="IDFACTURA"

						type="hidden" value="<?php echo $fila["IDFACTURA"]; ?>"/>

					
						
						<?php
					
					if (isset($factura) and ($factura["IDFACTURA"] == $fila["IDFACTURA"])) { ?>


						<h3><input id="IDFACTURA" name="IDFACTURA" type="text" value="<?php echo $fila["IDFACTURA"]; ?>"/>	</h3>

				<?php }	else { ?>


						<input id="IDFACTURA" name="IDFACTURA" type="hidden" value="<?php echo $fila["IDFACTURA"]; ?>"/>

						
						<div>
							<b>
								<td><?php echo $fila["IDFACTURA"]?> </td>
								<td><?php echo $fila["FECHAEMISION"]?></td>
								<td><?php echo $fila["FECHAVENCIMIENTO"]?></td>
								<td><?php echo $fila["TIPOPAGO"]; ?></td>
								<td><?php echo $fila["PRECIOSINIVA"]?></td>
								<td><?php echo $fila["IVA"]; ?></td> 
								<td><?php echo $fila["PRECIOCONIVA"]?></td> 
								<td><?php echo $fila["DNIOPERARIO"]?></td>
								<td><?php echo $fila["DNICLIENTE"]?></td>
						<td>
				<?php } ?>
				
				
					<div id="botones_fila">

				<?php if (isset($factura) and ($factura["IDFACTURA"] == $fila["IDFACTURA"])) { ?>

						<button id="grabar" name="grabar" type="submit" class="editar_fila">

							<img src="../imagenes/pngocean_opt.png" class="editar_fila" alt="Guardar modificación">

						</button>

				<?php } else { ?>

						<button id="editar" name="editar" type="submit" class="editar_fila">

							<img src="../imagenes/pngocean_opt.png" class="editar_fila" alt="Editar Cliente">

						</button>
					
				<?php } ?>
						</td>
					<td>
					<button id="borrar" name="borrar" type="submit" class="editar_fila">

						<img src="../imagenes/borrar.png" class="editar_fila" alt="Borrar libro" >

					</button>
				</div>
				</td>
				
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


<a href="./crearFactura.php">En construccion</a>

</main>
</body>
</html>