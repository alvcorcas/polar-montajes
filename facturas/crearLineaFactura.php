<?php
session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();
if ($_POST['fila'] == 1)
	borrarLineas($conexion);
$consulta = "CALL insertar_lineafactura(:cantidad, :descripcion, :precioUnitario, :idfactura, :oid_s)";
$excepcion = insertar_lineafactura($conexion, $consulta);
cerrarConexionBD($conexion);
echo $excepcion;

function insertar_lineafactura($conexion, $consulta) {
	try {
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':cantidad', $_POST['cantidad']);
		$stmt -> bindParam(':descripcion', $_POST['descripcion']);
		$stmt -> bindParam(':precioUnitario', $_POST['precioUnitario']);
		$stmt -> bindParam(':idFactura', $_SESSION['factura']);
		$stmt -> bindParam(':oid_s', $_POST['oid_s']);
		$stmt -> execute();
		return "Fila " . $_POST['fila'] . " insertada correctamente";
	} catch(PDOException $e) {
		return " Corrija el contenido de la fila " . $_POST['fila'];
	}
}

function borrarLineas($conexion) {
	$consulta = "DELETE FROM LINEAFACTURA WHERE IDFACTURA = :idFactura";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':idFactura', $_SESSION['factura']);
	$stmt -> execute();
}
?>