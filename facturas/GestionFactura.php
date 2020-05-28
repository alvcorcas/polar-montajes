<?php

function consultarFacturas($conexion) {
	$consulta = "SELECT * FROM FACTURA";
	return $conexion -> query($consulta);
}

function borrarcliente($conexion, $nif) {
	try {
		$stmt = $conexion -> prepare('CALL pck_cliente.eliminar(:nif)');
		$stmt -> bindParam(':nif', $DNIcliente);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function modificarcliente($conexion, $nif, $email) {
	try {
		$stmt = $conexion -> prepare('CALL MODIFICAR_EMAIL(:nif,:email)');
		$stmt -> bindParam(':nif', $DNIcliente);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}
?>
