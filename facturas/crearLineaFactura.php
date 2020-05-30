<?php
session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();
$consulta = "CALL insertar_lineafactura(:cantidad, :descripcion, :precioUnitario, :precioTotal, :idfactura, :oid_s)";
$stmt = $conexion -> prepare($consulta);
$stmt -> bindParam(':cantidad', $_GET['cantidad']);
$stmt -> bindParam(':descripcion', $_GET['descripcion']);
$stmt -> bindParam(':precioUnitario', $_GET['precioUnitario']);
$stmt -> bindParam(':precioTotal', $_GET['precioTotal']);
$stmt -> bindParam(':idFactura', $_SESSION['factura']);
$stmt -> bindParam(':oid_s', $_GET['oid_s']);
$stmt -> execute();
cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
		<script src="js/boton.js?v=<?= $version ?>"></script>
		<title>Creación de una factura</title>
	</head>
	<body>
		
		<?php echo $_GET['cantidad'];?><br />
		<?php echo $_GET['descripcion'];?><br />
		<?php echo $_GET['precioUnitario'];?><br />
		<?php echo $_GET['precioTotal'];?><br />
		<?php echo $_GET['oid_s'];?><br />
		<?php echo $_SESSION['factura']; ?>
		
		
		
	</body>
	
</html>
		