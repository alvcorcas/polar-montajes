<?php
session_start();	
	
	if (isset($_SESSION["CLIENTE"])) {
		$cliente = $_SESSION["CLIENTE"];
		unset($_SESSION["CLIENTE"]);
		
		require_once("../gestionBD.php");
		require_once("GestionCliente.php");
		
		$conexion = crearConexionBD();		
		$excepcion = borrarcliente($conexion,$cliente["DNICLIENTE"]);
		cerrarConexionBD($conexion);
		echo var_dump($cliente);
		echo var_dump($excepcion);
		echo $cliente["DNICLIENTE"];
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consultaClientes.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consultaClientes.php");
	}
	else Header("Location: consultaClientes.php"); // Se ha tratado de acceder directamente a este PHP
?>
