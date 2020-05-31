<?php
session_start();

if (isset($_POST["IDFACTURA"])) {
	$factura = $_POST["IDFACTURA"];
	require_once ("../gestionBD.php");
	require_once ("gestionFactura.php");

	$conexion = crearConexionBD();
	$excepcion = pagarfactura($conexion, $factura);
	cerrarConexionBD($conexion);
	if ($excepcion <> "") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "../clientes/facturasPorCliente.php";
		Header("Location: excepcion.php");
	} else
		Header("Location: ../clientes/facturasPorCliente.php");
} else
	Header("Location: ../clientes/facturasPorCliente.php");
// Se ha tratado de acceder directamente a este PHP
?>
