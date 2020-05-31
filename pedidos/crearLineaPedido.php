<?php
session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();
if ($_POST['fila'] == 1)
	borrarLineas($conexion);
$consulta = "CALL insertar_lineapedido(:cantidad, :precioTotal, :oid_p, :oid_prod)";
$excepcion = insertar_lineapedido($conexion, $consulta);
cerrarConexionBD($conexion);
echo $excepcion;

function insertar_lineapedido($conexion, $consulta) {
	try {
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':cantidad', $_POST['cantidad']);
		$stmt -> bindParam(':precioTotal', $_POST['precioTotal']);
		$stmt -> bindParam(':oid_p', $_SESSION['idPedido']);
		$stmt -> bindParam(':oid_prod', $_POST['oid_prod']);
		$stmt -> execute();
		return "Fila " . $_POST['fila'] . " insertada correctamente";
	} catch(PDOException $e) {
		return " Corrija el contenido de la fila " . $_POST['fila'];
	}
}

function borrarLineas($conexion) {
	$consulta = "DELETE FROM LINEAPEDIDO WHERE oid_p = :idpedido";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':idpedido', $_SESSION['idPedido']);
	$stmt -> execute();
}
?>