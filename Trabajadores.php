<?php
	

	session_start();
	$version = 5;
    require_once("gestionBD.php");
    require_once("gestionTrabajadores.php");
    require_once("Paginacion.php");
	
		if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"];
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]: (isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);

	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]: (isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);

	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 8;
	
		unset($_SESSION["paginacion"]);

	
		$conexion = crearConexionBD();
		$query = "SELECT * FROM OPERARIO";
		
		$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0) $total_paginas++;
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;
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
  <link rel="stylesheet" type="text/css" href="css/Proyecto.css?v=<?= $version ?>" />
<script src="js/boton.js?v=<?= $version ?>"></script>
   
  <title>Polar Montajes: Trabajadores</title>
</head>

<body> 
	<div>
	<div>
		<div>
	<?php
include_once ("cabecera.php");
?>

<main>
	</div>
<div>
	<br />
	<br />
	<br />
		<ul>
  <li><a href= "Principal.php">Polar Montajes:</a></li>
  <li><a href= "Servicios.php">Servicio</a></li>
  <li><a href="Trabajadores.php">Trabajadores</a></li>
  <li><a href= "Ayuda.php">Ayuda</a></li>
  <li><a href="Contacto.php">Contact</a></li>
  <li><a href="About.php">About</a></li>
	</ul>
	</div>
	<header>
			<h2>¡Estos son los diferentes servicios que ofrecemos!</h2>
			<hr	 />
			</header>
	

	 


	<?php

		foreach($filas as $fila) {

	?>



	<article class="libro">

		<form method="post" action="controladorTrabajador.php">

			<div class="fila_libro">

				<div class="datos_libro">

					<input id="DNI" name="DNI"

						type="hidden" value="<?php echo $fila["DNI"]; ?>"/>

					<input id="NOMBRE" name="NOMBRE"

						type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

					<input id="APELLIDOS" name="APELLIDOS"

						type="hidden" value="<?php echo $fila["APELLIDOS"]; ?>"/>
						
					<input id="CORREO" name="CORREO"

						type="hidden" value="<?php echo $fila["CORREO"]; ?>"/>
						
					<input id="TELEFONO" name="TELEFONO"

						type="hidden" value="<?php echo $fila["TELEFONO"]; ?>"/>

					

				<?php

					if (isset($operario) and ($operario["DNI"] == $fila["DNI"])) { ?>

						<!-- Editando título -->


						<h4><?php echo $fila["NOMBRE"] . " " . $fila["APELLIDOS"]. " " . $fila["DNI"]. " " . $fila["CORREO"]. " " . $fila["TELEFONO"]; ?></h4>

				<?php }	else { ?>
					
					  
 					 <button type="button" class="collapsible"><?php echo $fila["NOMBRE"] . "  " . $fila["APELLIDOS"];?></button>
 						 <div class="content">
  						<p><strong><em>DNI:</em></strong> <?php echo $fila["DNI"];?> </p>
  						 	<p><strong><em>Correo:</em></strong><?php echo $fila["CORREO"];?> </p>
  						 	<p><strong><em>Teléfono:</em></strong><?php echo $fila["TELEFONO"]; ?></p>
  						 	
  						 	<div id="botones_fila" >

				<?php if (isset($operario) and ($operario["DNI"] == $fila["DNI"])) { ?>

						<button id="grabar" name="grabar" type="submit" class="editar_fila">

							<img src="imagenes/pngocean_opt.png" class="editar_fila" alt="Guardar modificación">

						</button>

				<?php } else { ?>

						<button id="editar" name="editar" type="submit" class="editar_fila">

							<img src="imagenes/pngocean_opt.png" class="editar_fila" alt="Editar libro">

						</button>

				<?php } ?>

					<button id="borrar" name="borrar" type="submit" class="editar_fila">

						<img src="imagenes/borrar.png" class="editar_fila" alt="Borrar libro">

					</button>
  						 	</div>
  							</div>
  						

				<?php } ?>

				</div>
			</div>

		</form>

	</article>



	<?php } ?>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>


	<div>
	<footer>
		<div class="footer2">
		Universidad De Sevilla
		<div class="footer">
		 Derechos Reservados| Miguel Ángel Nieva Arjona y Álvaro Cortés Casado
		</div>
		</div>
	</footer>
	</div>
</main>
</body>
</html>