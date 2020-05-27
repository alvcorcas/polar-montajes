<?php
session_start();	
	
	if (isset($_SESSION["OPERARIO"])) {
		$operario = $_SESSION["OPERARIO"];
		unset($_SESSION["OPERARIO"]);
		
		require_once("../gestionBD.php");
		require_once("gestionTrabajador.php");
		
		$conexion = crearConexionBD();		
		$excepcion = borraroperario($conexion, $operario["DNIOPERARIO"]);
		cerrarConexionBD($conexion);
		echo var_dump($operario);
		echo var_dump($excepcion);
		echo $operario["DNIOPERARIO"];
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consultaTrabajadores.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consultaTrabajadores.php");
	}
	else Header("Location: consultaTrabajadores.php"); // Se ha tratado de acceder directamente a este PHP
?>
