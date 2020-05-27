<?php

function consultarTrabajador($conexion) {
 	$consulta = "SELECT * FROM OPERARIO";
	return $conexion->query($consulta);
}

function borraroperario($conexion,$nif) {
	try {
		$stmt=$conexion->prepare('CALL borrar_operario(:nif)');
		$stmt->bindParam(':nif',$nif);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificaroperario($conexion, $nif, $correo, $telefono) {
	try {
		$stmt=$conexion->prepare('CALL modificar_operario(:nif, :correo, :telefono)');
		$stmt->bindParam(':nif',$nif);
		$stmt->bindParam(':correo',$correo);
		$stmt->bindParam(':telefono',$telefono);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?> 
