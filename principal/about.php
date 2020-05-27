	<?php
	session_start();
	$version = 5;
	?>
	
	<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
	
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css?v=<?= $version ?>" />
<script src="js/boton.js?v=<?= $version ?>"></script>
   
  <title>Gestión de Clientes: Pagina Principal</title>
</head>

<body> 
	<div>
	<div>
		<div>
	<?php
include_once ("../cabecera.php");
?>

<main>
	
</div>
<div>
	<br />
	<br />
	<br />
		<ul>
  <li><a href= "index.php">Polar Montajes:</a></li>
  <li><a href= "servicios.php">Servicio</a></li>
  <li><a href="../operarios/consultaTrabajadores.php">Trabajadores</a></li>
  <li><a href= "ayuda.php">Ayuda</a></li>
  <li><a href="contacto.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
	</ul>
	</div>
	<header>
			<h2>Preguntas Frecuentes...</h2>
			<hr	 />
			</header>
			
	
<button type="button" class="collapsible">¿Cuanto suele tardar Polar Montajes en realizar una reparación?</button>
<div class="content">
  <p>Este servicio depende del tiempo que tarden nuestros profesionales en encontrar el problema. Normalmente se hace una inspección
  	detallada sobre toda la instalación, para encontrar el fallo y poder encontrar otros posibles deterioros o problemas que pudiese
  	haber en la instalación. Esta <strong>inspección</strong> suele llevarse a cabo en <strong>un día</strong> para estructuras de tamaño normal y de 
  	<strong>varios días</strong> para estructuras más grandes. La <strong><em> <a href="servicios.php">Reparación</a> </em></strong> nos suele llevar <strong>un día</strong> más, o
  	<strong>varios</strong> para estructuras grandes.</p>
</div>
<button type="button" class="collapsible">¿Cuanto suele tardar Polar Montajes en realizar un Mantenimiento?</button>
<div class="content">
  <p>Este es el servicio que menos tiempo nos conlleva realizar. En este caso, el tiempo estimado para el <strong><em> <a href="servicios.php">Mantenimiento</a> </em></strong>
  	es de <strong>un día</strong>, a lo sumo <strong>dos días</strong> para grandes estructuras. Este servicio consisté de una multitud de 
  	pruebas a los componentes para detectar fallos o en su caso, comprobar que todo va como debe y garantizar la seguridad del cliente.
  </p>
</div>
<button type="button" class="collapsible">¿Cuanto suele tardar Polar Montajes en realizar una Instalación Eléctrica?</button>
<div class="content">
  <p>La <strong><em> <a href="servicios.php">Instalación Eléctrica</a> </em></strong> es el servicio que más tiempo tardamos en realizar, pues es el más complejo y a la vez
  	que largo en cuanto al tiempo que requiere. Normalmente se tarda entre <strong><em>1 y 3 días</em></strong> en recoger todos los detalles de la instalación. Entre <strong><em>1 y 4 días</em></strong>
  	 nos lleva realizar los planos y pasos previos a la instalación. Luego, suele llevarse entre <strong><em>1 y 14 días</em></strong> la instalación y por último otro
  	 <strong><em> par de días</em></strong> en realizar todas las pruebas necesarias.</p>
</div>
<button type="button" class="collapsible">¿De qué métodos de pago dispone Polar Montajes?</button>
<div class="content">
  <p><strong><em>Polar Montajes</em></strong> dispone de <Strong>dos</Strong> métodos de pago. Para facturas de menos 500 euros, se podrá
  	abonar tanto en <Strong>metálico</Strong> como por <Strong>transferencia bancaria</Strong>. Para facturas de mas de 500 euros, solo se podrá pagar mediante <Strong>transferencia bancaria</Strong>
</p>
</div>
<button type="button" class="collapsible">¿Cuántos empleados realizan los servicios?</button>
<div class="content">
  <p><strong><em>Polar Montajes</em></strong> dispone de empleados que normalmente trabajan en grupos de dos. Para proyectos grandes, trabajan al mismo tiempo entre 4 y 6 empleados.
</p>
</div>
<button type="button" class="collapsible">¿De cuánto tiempo dispongo para pagar mi factura?</button>
<div class="content">
  <p><strong><em>Polar Montajes</em></strong>, salvo casos excepcionales como proyectos de muchos miles de euros, deja como máximo un mes
  	desde que se firma ésta para abonar la cantidad establecida.
</p>
</div>
<button type="button" class="collapsible">¿Suelen dejar satisfechos a los clientes?</button>
<div class="content">
  <p>En <strong><em>Polar Montajes</em></strong> trabajamos a diario para ofrecer el mejor servicio posible a nuestros clientes, pues es la satisfacción de éstos lo que más nos importa.
  	Accede a <a href="valoraciones.php">Valoraciones</a> para leer la opinión de clientes que ya han contratado servicios de nuestra empresa.
</p>
</div>
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