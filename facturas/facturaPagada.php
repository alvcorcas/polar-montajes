<?php
session_start();

if (isset($_SESSION["FACTURA"])) {
	$FACTURA = $_SESSION["FACTURA"];
	unset($_SESSION["FACTURA"]);

	require_once ("../gestionBD.php");
	require_once ("gestionFactura.php");

	$conexion = crearConexionBD();
	$excepcion = borrarfactura($conexion, $FACTURA["IDFACTURA"]);
	cerrarConexionBD($conexion);
	echo var_dump($FACTURA);
	echo var_dump($excepcion);
	echo $FACTURA["FACTURA"];
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
