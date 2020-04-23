<?php

function alta_usuario($conexion,$usuario) {

	try {
		$consulta = "CALL INSERTAR_USUARIO(:nif, :nombre, :ape, :dir, :mun,:email, :pass, :perfil)";
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nif',$usuario["nif"]);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dir',$usuario["calle"]);
		$stmt->bindParam(':mun',$usuario["municipio"]);
		$stmt->bindParam(':email',$usuario["email"]);
		$stmt->bindParam(':pass',$usuario["pass"]);
		$stmt->bindParam(':perfil',$usuario["perfil"]);
		
		$stmt->execute();
		
		return true;
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e->GetMessage();
		return false;
    }
}

function consultarUsuario($conexion,$nif,$pass) {
 	$consulta = "SELECT COUNT(*) AS TOTAL FROM OPERARIO WHERE DNI=:nif AND PASSWORD=:pass";
	$stmt = $conexion->prepare($consulta);
	$stmt->bindParam(':nif',$nif);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetchColumn();
}