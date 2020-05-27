<?php

function alta_usuario($conexion, $usuario) {

	try {
		$consulta = "CALL insertar_usuario(:nif, :nombre, :apellidos, :perfil, :email, :pass, :calle, :provincia, :municipio)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':nif', $usuario["nif"]);
		$stmt -> bindParam(':nombre', $usuario["nombre"]);
		$stmt -> bindParam(':apellidos', $usuario["apellidos"]);
		$stmt -> bindParam(':perfil', $usuario["perfil"]);
		$stmt -> bindParam(':email', $usuario["email"]);
		$stmt -> bindParam(':pass', $usuario["pass"]);
		$stmt -> bindParam(':calle', $usuario["calle"]);
		$stmt -> bindParam(':provincia', $usuario["provincia"]);
		$stmt -> bindParam(':municipio', $usuario["municipio"]);
		$stmt -> execute();
		
		return true;
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();
		
		return false;
	}
}

function consultarUsuario($conexion, $nif, $pass) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM usuario WHERE dniusuario=:nif AND pass=:pass";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':nif', $nif);
	$stmt -> bindParam(':pass', $pass);
	$stmt -> execute();
	return $stmt -> fetchColumn();
}

function obtenerPerfil($conexion, $nif) {
	$consulta = "SELECT PERFIL FROM usuario WHERE dniusuario=:nif";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':nif', $nif);
	$stmt -> execute();
	return $stmt -> fetchColumn();
}

