<?php

session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();
$consulta = "CALL insertar_factura(:idFactura, :precioSinIva, :iva, :precioConIva, :tipoPago, :fechaVencimiento, :fechaEmision, :dniOperario, :dniCliente)";
$excepcion = crearFactura($conexion, $consulta);
cerrarConexionBD($conexion);
echo $excepcion;

function crearFactura($conexion, $consulta) {
	try {
		$stmt = $conexion -> prepare($consulta);
		$factura = $_POST['idFactura'];
		$_SESSION['factura'] = $factura;
		$stmt -> bindParam(':idFactura', $factura);
		$fechaEmision = date('d/m/Y', strtotime($_POST['fechaEmision']));
		$fechaVencimiento = date('d/m/Y', strtotime($_POST['fechaVencimiento']));
		$stmt -> bindParam(':fechaEmision', $fechaEmision);
		$stmt -> bindParam(':fechaVencimiento', $fechaVencimiento);
		$stmt -> bindParam(':tipoPago', $_POST['tipoPago']);
		$stmt -> bindParam(':precioSinIva', $_POST['precioSinIva']);
		$stmt -> bindParam(':iva', $_POST['iva']);
		$stmt -> bindParam(':precioConIva', $_POST['precioConIva']);
		$stmt -> bindParam(':dniOperario', $_SESSION['login']);
		$stmt -> bindParam(':dniCliente', $_POST['dniCliente']);
		$stmt -> execute();
		return "La factura se ha insertado correctamente, proceda a añadir filas y rellenarlas";
	} catch(PDOException $e) {
		return "Compruebe que ha rellenado correctamente la factura";
	}
}
?>
