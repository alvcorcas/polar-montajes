<?php

function consultarClientes($conexion) {
	$consulta = "SELECT * FROM CLIENTE";
	return $conexion -> query($consulta);
}

function borrarcliente($conexion, $DNIcliente) {
	try {
		$stmt = $conexion -> prepare('CALL borrar_cliente(:nif)');
		$stmt -> bindParam(':nif', $DNIcliente);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function modificarcliente($conexion, $nif, $telefono, $correo, $direccion, $codigopostal) {
	try {
		$stmt = $conexion -> prepare('CALL modificar_cliente(:nif, :telefono, :correo, :direccion, :codigopostal)');
		$stmt -> bindParam(':nif', $nif);
		$stmt -> bindParam(':telefono', $telefono);
		$stmt -> bindParam(':correo', $correo);
		$stmt -> bindParam(':direccion', $direccion);
		$stmt -> bindParam(':codigopostal', $codigopostal);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}
?>
