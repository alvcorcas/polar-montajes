<?php
session_start();

if (isset($_REQUEST["DNIOPERARIO"])) {
	$operario["DNIOPERARIO"] = $_REQUEST["DNIOPERARIO"];

	if (isset($_REQUEST["editar"])) {
		$_SESSION["OPERARIO"] = $operario;
		Header("Location: consultaTrabajadores.php");
	} else if (isset($_REQUEST["grabar"])){
		$operario["CORREO"] = $_REQUEST["CORREO"];
		$operario["TELEFONO"] = $_REQUEST["TELEFONO"];
		$_SESSION["OPERARIO"] = $operario;
		Header("Location: modificarTrabajador.php");
	}else {
		$_SESSION["OPERARIO"] = $operario;
		Header("Location: borrarTrabajador.php");
	}
} else
	Header("Location: consultaTrabajadores.php");
?>

