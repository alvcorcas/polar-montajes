<?php 
	session_start();
	
	$excepcion = $_SESSION["excepcion"];
	unset($_SESSION["excepcion"]);
	
	if (isset ($_SESSION["destino"])) {
		$destino = $_SESSION["destino"];
		unset($_SESSION["destino"]);	
	} else 
		$destino = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
  <title>¡Se ha producido un problema!</title>
</head>
<body>	
	
	<h1>¡Vaya! Parece que ha ocurrido un problema. Pulse el logo para volver a la pantalla de inicio</h1>	
		
	<div class='excepcion'>	
		<?php echo "Información relativa al problema: $excepcion;" ?>
	</div>

</body>
</html>