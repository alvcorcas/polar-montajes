<?php

function consultarFacturas($conexion) {
	$consulta = "SELECT * FROM FACTURA";
	return $conexion -> query($consulta);
}

function pagarFactura($conexion, $idFactura) {
	try {
		$stmt = $conexion -> prepare('CALL pagar_factura(:idFactura)');
		$stmt -> bindParam(':idFactura', $idFactura);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}


?>
