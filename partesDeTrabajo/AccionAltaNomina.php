<?php

session_start();

// include_once ("funciones.php");
require_once ("../gestionBD.php");
// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION['formulario'])) {
	$nomina = $_SESSION['formulario'];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
	$conexion = crearConexionBD();
	$consulta = "CALL insertar_parte_trabajo(:horasTrabajadas, :horasExtras, :precioHora, :mesAno, :dniOperario)";
	$excepcion = crearNomina($conexion, $consulta, $nomina);
	cerrarConexionBD($conexion);
	if ($excepcion <> "") {
		$_SESSION['excepcion'] = $excepcion;
		header("Location: ../principal/excepcion.php");
	} else {
		header("Location: nominas.php");
	}
} else
	Header("Location: Crearnomina.php");

function crearNomina($conexion, $consulta, $nomina) {
	try {
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':horasTrabajadas', $nomina['HORASTRABAJADAS']);
		$stmt -> bindParam(':horasExtras', $nomina['HORASEXTRAS']);
		$stmt -> bindParam(':precioHora', $nomina['PRECIOHORA']);
		$stmt -> bindParam(':mesAno', $nomina['MESANO']);
		$stmt -> bindParam(':dniOperario', $nomina['DNIOPERARIO']);
		$stmt -> execute();
		return "";

	} catch(PDOException $e) {
		return $e -> getMessage(); ;
	}
}
?>
