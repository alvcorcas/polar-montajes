<?php

function consultarPedidos($conexion) {
 	$consulta = "SELECT * FROM PEDIDO";
	return $conexion->query($consulta);
}

function pagarpedido($conexion,$oid_p) {
	try {
		$stmt=$conexion->prepare('CALL pagar_pedido(:oid_p)');
		$stmt->bindParam(':oid_p',$oid_p);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

?> 
