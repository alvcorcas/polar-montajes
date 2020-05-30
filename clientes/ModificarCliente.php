<?php

session_start();

if (isset($_SESSION["CLIENTE"])) {
	$cliente = $_SESSION["CLIENTE"];
	unset($_SESSION["CLIENTE"]);

	require_once ("../gestionBD.php");
	require_once ("gestionCliente.php");

	$conexion = crearConexionBD();
	$excepcion = modificarcliente($conexion, $cliente["DNICLIENTE"], $cliente["TELEFONO"], $cliente["CORREO"], $cliente["DIRECCION"], $cliente["CODIGOPOSTAL"]);
	cerrarConexionBD($conexion);
	if ($excepcion <> "") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "consultaClientes.php";
		Header("Location: excepcion.php");
	} else
		Header("Location: consultaClientes.php");
} else
	Header("Location: consultaClientes.php");
// Se ha tratado de acceder directamente a este PHP
?>
