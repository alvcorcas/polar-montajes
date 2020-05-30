<?php
session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();
$consulta = "CALL insertar_lineafactura(:cantidad, :descripcion, :precioUnitario, :precioTotal, :idfactura, :oid_s)";
$excepcion = insertar_lineafactura($conexion, $consulta);
cerrarConexionBD($conexion);
$_SESSION["excepcion"] = $excepcion;
echo $excepcion;

function insertar_lineafactura($conexion, $consulta) {
	try {
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':cantidad', $_POST['cantidad']);
		$stmt -> bindParam(':descripcion', $_POST['descripcion']);
		$stmt -> bindParam(':precioUnitario', $_POST['precioUnitario']);
		$stmt -> bindParam(':precioTotal', $_POST['precioTotal']);
		$stmt -> bindParam(':idFactura', $_SESSION['factura']);
		$stmt -> bindParam(':oid_s', $_POST['oid_s']);
		$stmt -> execute();
		return "Insertada correctamente";
	} catch(PDOException $e) {
		return "Compruebe que ha rellenado correctamente";
	}
}
?>