<?php

	session_start();

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
    <link rel="stylesheet" type="text/css" href="css/Proyecto.css" />
	<script type="text/javascript" src="./js/boton.js"></script>
  <title>Gestión de Clientes: Lista de Clientes</title>
</head>

<body> 
	<?php
include_once ("cabecera.php");
?>
<main>
	
	<ul>
  <li><a href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
	</ul>

 <nav>

		<div id="enlaces">

			<?php

				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="ConsultaClientes.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } ?>

		</div>
		
			<form method="get" action="ConsultaClientes.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros; ?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>

	</nav>



	<?php

		foreach($filas as $fila) {

	?>



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


				<?php

					if (isset($cliente) and ($cliente["DNICLIENTE"] == $fila["DNICLIENTE"])) { ?>


						<h3><input id="DNICLIENTE" name="DNICLIENTE" type="text" value="<?php echo $fila["DNICLIENTE"]; ?>"/>	</h3>

						<h4><?php echo $fila["NOMBRE"]." ".$fila["APELLIDOS"]; ?></h4>

				<?php }	else { ?>


						<input id="DNI" name="DNI" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
						<br />

						
						<div class="fila"><b><?php echo $fila["NOMBRE"]." "; echo $fila["APELLIDOS"]." "; echo $fila["DNICLIENTE"]; ?></b></div>
					  <hr width=19%  align="left" size=3>
					</br>

				<?php } ?>

				</div>

			</div>

		</form>

	</article>



	<?php } ?>

</main>
</body>
</html>