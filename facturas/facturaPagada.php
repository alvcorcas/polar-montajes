<?php
session_start();

if (isset($_SESSION["factura"])) {
	$FACTURA = $_SESSION["factura"];
	unset($_SESSION["factura"]);

	require_once ("../gestionBD.php");
	require_once ("gestionFactura.php");

	$conexion = crearConexionBD();
	$excepcion = pagarfactura($conexion, $FACTURA);
	cerrarConexionBD($conexion);
	if ($excepcion <> "") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "consultaFacturas.php";
		Header("Location: excepcion.php");
	} else
		Header("Location: consultaFacturas.php");
} else
	Header("Location: consultaFacturas.php");
// Se ha tratado de acceder directamente a este PHP
?>
