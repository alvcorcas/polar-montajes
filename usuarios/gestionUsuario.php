<?php

function alta_usuario($conexion, $usuario) {

	try {
		$consulta = "CALL insertar_usuario(:nif, :perfil, :pass)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':nif', $usuario["nif"]);
		$stmt -> bindParam(':perfil', $usuario["perfil"]);
		$stmt -> bindParam(':pass', $usuario["pass"]);
		$stmt -> execute();

		if ($usuario['perfil'] == 'Trabajador') {
			$consulta = "INSERT INTO operario(DNIOPERARIO, NOMBRE, APELLIDOS, CORREO, TELEFONO, ESGERENTE, OCULTO) 
							VALUES(:nif, :nombre, :apellidos, :email, :telefono, 0, 0)";
			$stmt = $conexion -> prepare($consulta);
			$stmt -> bindParam(':nif', $usuario["nif"]);
			$stmt -> bindParam(':nombre', $usuario["nombre"]);
			$stmt -> bindParam(':apellidos', $usuario["apellidos"]);
			$stmt -> bindParam(':email', $usuario["email"]);
			$stmt -> bindParam(':telefono', $usuario["telefono"]);
			$stmt -> execute();
		} else /* if ($usuario['perfil'] == 'Cliente')*/{
			$consulta = "INSERT INTO cliente(DNICLIENTE, NOMBRE, APELLIDOS, TELEFONO, CORREO, DIRECCION, CODIGOPOSTAL, OCULTO) 
							VALUES(:nif, :nombre, :apellidos, :telefono, :email, :direccion, :codigoPostal, 0)";
			$stmt = $conexion -> prepare($consulta);
			$stmt -> bindParam(':nif', $usuario["nif"]);
			$stmt -> bindParam(':nombre', $usuario["nombre"]);
			$stmt -> bindParam(':apellidos', $usuario["apellidos"]);
			$stmt -> bindParam(':telefono', $usuario["telefono"]);
			$stmt -> bindParam(':email', $usuario["email"]);
			$stmt -> bindParam(':direccion', $usuario["direccion"]);
			$stmt -> bindParam(':codigoPostal', $usuario["codigoPostal"]);
			$stmt -> execute();
		}

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
	$perfil = $stmt -> fetchColumn();
	if($perfil == "Trabajador"){
		$consulta = "SELECT ESGERENTE FROM operario WHERE dnioperario=:nif";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':nif', $nif);
		$stmt -> execute();
		if($stmt -> fetchColumn())
			$perfil = "Gerente";
	}
	return $perfil;
}





