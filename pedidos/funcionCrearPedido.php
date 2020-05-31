<?php
session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();

$consulta = "CALL insertar_pedido(:fecha, :precio, :nombreEmpresa, :dniOperario)";
$excepcion = crearPedido($conexion, $consulta);
$sh = $conexion -> prepare('SELECT sec_pedido.CURRVAL FROM dual');
$sh -> execute();
$insertId = $sh -> fetchColumn(0);
$_SESSION['idPedido'] = $insertId;
cerrarConexionBD($conexion);
echo $excepcion;

function crearPedido($conexion, $consulta) {
	try {
		$stmt = $conexion -> prepare($consulta);
		$fecha = date('d/m/Y', strtotime($_POST['fecha']));
		$stmt -> bindParam(':fecha', $fecha);
		$stmt -> bindParam(':precio', $_POST['precio']);
		$stmt -> bindParam(':nombreEmpresa', $_POST['nombreEmpresa']);
		$stmt -> bindParam(':dniOperario', $_SESSION['login']);
		$stmt -> execute();
		return "El pedido se ha insertado correctamente, proceda a añadir filas y rellenarlas";
	} catch(PDOException $e) {
		return "Compruebe que ha rellenado correctamente el pedido";
	}
}
?>