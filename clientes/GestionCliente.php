<?php

function consultarClientes($conexion) {
	$consulta = "SELECT * FROM CLIENTE";
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

function modificarcliente($conexion, $nif) {
	try {
		$stmt = $conexion -> prepare('CALL MODIFICAR_EMAIL(:nif)');
		$stmt -> bindParam(':nif', $DNIcliente);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}
?>
