<?php
session_start();

if (isset($_POST["OID_P"])) {
	$pedido = $_POST["OID_P"];
	require_once ("../gestionBD.php");
	require_once ("gestionPedido.php");
	$conexion = crearConexionBD();
	$excepcion = pagarpedido($conexion, $pedido);
	cerrarConexionBD($conexion);
	if ($excepcion <> "") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "../pedidos/consultaPedidos.php";
		Header("Location: ../principal/excepcion.php");
	} else
		Header("Location: ../pedidos/consultaPedidos.php");
} else
	Header("Location: ../principal/index.php");
// Se ha tratado de acceder directamente a este PHP
?>
