<?php
session_start();

if (isset($_REQUEST["DNI"])) {
	$operario["DNIOPERARIO"] = $_REQUEST["DNIOPERARIO"];
	$operario["NOMBRE"] = $_REQUEST["NOMBRE"];
	$operario["APELLIDOS"] = $_REQUEST["APELLIDOS"];
	$operario["TELEFONO"] = $_REQUEST["TELEFONO"];
	$operario["CORREO"] = $_REQUEST["CORREO"];
	$_SESSION["OPERARIO"] = $operario;

	if (isset($_REQUEST["editar"]))
		Header("Location: Trabajadores.php");
	else if (isset($_REQUEST["grabar"]))
		Header("Location: ModificarCliente.php");
	else/* if (isset($_REQUEST["borrar"])) */
		Header("Location: borrarCliente.php");
} else
	Header("Location: Trabajadores.php");
?>

