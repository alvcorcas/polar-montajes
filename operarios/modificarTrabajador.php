<?php
session_start();

if (isset($_SESSION["OPERARIO"])) {
	$operario = $_SESSION["OPERARIO"];
	unset($_SESSION["OPERARIO"]);

	require_once ("../gestionBD.php");
	require_once ("gestionTrabajador.php");

	$conexion = crearConexionBD();
	$excepcion = modificaroperario($conexion, $operario["DNIOPERARIO"], $operario["CORREO"], $operario["TELEFONO"]);
	cerrarConexionBD($conexion);
	echo var_dump($operario);
	if ($excepcion <> "") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "Trabajadores.php";
		Header("Location: ../excepcion.php");
	} else
		Header("Location: consultaTrabajadores.php");
} else
	Header("Location: consultaTrabajadores.php");
// Se ha tratado de acceder directamente a este PHP
?>
