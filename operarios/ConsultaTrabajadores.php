<?php

session_start();
$version = 6;
require_once ("../gestionBD.php");
require_once ("gestionTrabajador.php");



$conexion = crearConexionBD();
$query = "SELECT * FROM OPERARIO";
$stmt = $conexion -> prepare($query);
$stmt -> execute();
$filas = $stmt;



if (isset($_SESSION['OPERARIO'])) {
	$operario = $_SESSION['OPERARIO'];
};

cerrarConexionBD($conexion);
?>
	
	<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
	
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css?v=<?= $version ?>" />
<script src="js/boton.js?v=<?= $version ?>"></script>
   
  <title>Polar Montajes: Trabajadores</title>
</head>

<body> 
	<div>
	<div>
		<div>
	<?php
	include_once ("../Cabecera.php");
?>

<main>
	</div>
<div>
	<br />
	<br />
	<br />

	<br><br><br>
	</div>
	<header>
			<h2>¡Estos son los profesionales que forman Polar Montajes!</h2>
			<hr	 />
			</header>
	<?php
		//Para cada operario en la consulta
		foreach($filas as $fila) {
	?>

			<tr class="fila" data-toggle="collapse" data-target="#demo1" class="accordion-toggle" id="div2">  
  						<article class="libro">

		<form method="post" action="controladorTrabajadores.php">

			<div class="fila_libro">

				<div class="datos_libro">

					<input id="DNIOPERARIO" name="DNIOPERARIO"

						type="hidden" value="<?php echo $fila["DNIOPERARIO"]; ?>"/>

 					 <button type="button" class="collapsible" style=
 					 <?php if ($fila['OCULTO'] == 1) { ?>
 					 		"background-color: grey;"
 					 	<?php } else { ?>
 					 		"background-color: lightyellow; color: black;" 		
 					 	<?php } ?>">
 					 	
 					 	<?php echo $fila["NOMBRE"] . "  " . $fila["APELLIDOS"]; ?></button>
 						 <div class="content">
  						<p><strong><em>DNI:</em></strong> <?php echo $fila["DNIOPERARIO"]; ?> </p>
  						<?php if (isset($operario) and ($operario["DNIOPERARIO"] == $fila["DNIOPERARIO"])) {?>
							  <input id="CORREO" name="CORREO" type="text" value="<?php echo $fila["CORREO"]; ?>"/>
							  <br />
							  <input id="TELEFONO" name="TELEFONO" type="text" value="<?php echo $fila["TELEFONO"]; ?>"/>
						  <?php } else { ?>
  						 	<p><strong><em>Correo:</em></strong><?php echo $fila["CORREO"]; ?> </p>
  						 	<p><strong><em>Teléfono:</em></strong><?php echo $fila["TELEFONO"]; ?></p>
  						 <?php } ?>
  						 
  						 <?php if(isset($_SESSION['login']) and $_SESSION['perfil'] <> "Cliente") { ?>
  						 	<div id="botones_fila" >

				<?php if (isset($operario) and ($operario["DNIOPERARIO"] == $fila["DNIOPERARIO"])) { ?>

						<button id="grabar" name="grabar" type="submit" class="editar_fila">

							<img src="../imagenes/pngocean_opt.png" class="editar_fila" alt="Guardar modificación">

						</button>

				<?php } else { ?>

						<button id="editar" name="editar" type="submit" class="editar_fila">

							<img src="../imagenes/pngocean_opt.png" class="editar_fila" alt="Editar operario">

						</button>

				<?php } ?>

					<button id="borrar" name="borrar" type="submit" class="editar_fila">

						<img src="../imagenes/borrar.png" class="editar_fila" alt="Borrar operario">

					</button>
  						 	</div>
  						</td>
				<?php } ?>
				</b>

				

				</div>
			</div>

		</form>

	</article>



	<?php } ?>

<script>
	var coll = document.getElementsByClassName("collapsible");
	var i;

	for ( i = 0; i < coll.length; i++) {
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