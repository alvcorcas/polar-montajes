<?php
session_start();

if (isset($_SESSION["FACTURA"])) {
	$FACTURA = $_SESSION["FACTURA"];
	unset($_SESSION["FACTURA"]);

	require_once ("../gestionBD.php");
	require_once ("gestionFACTURA.php");

	$conexion = crearConexionBD();
	$excepcion = modificarFACTURA($conexion, $FACTURA["DNIFACTURA"], $FACTURA["TELEFONO"], $FACTURA["CORREO"], $FACTURA["DIRECCION"], $FACTURA["CODIGOPOSTAL"]);
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
