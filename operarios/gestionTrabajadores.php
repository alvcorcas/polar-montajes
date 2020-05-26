<?php

function consultarTrabajador($conexion) {
 	$consulta = "SELECT * FROM OPERARIO";
	return $conexion->query($consulta);
}

function borrarcliente($conexion,$nif) {
	try {
		$stmt=$conexion->prepare('CALL borrar_operario(:nif)');
		$stmt->bindParam(':nif',$nif);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificarcliente($conexion,$nif,$email) {
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_EMAIL(:nif,:email)');
		$stmt->bindParam(':nif',$nif);
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?> 
