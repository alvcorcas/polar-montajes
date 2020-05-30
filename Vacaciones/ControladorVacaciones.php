<?php
session_start();

if (isset($_REQUEST["OID_S"])) {
	$servicio["OID_S"] = $_REQUEST["OID_S"];

	if (isset($_REQUEST["editar"])) {
		$_SESSION["TRABAJADOR"] = $servicio;
		Header("Location: Vacaciones.php");
	} else if (isset($_REQUEST["grabar"])) {
		$servicio["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
		$servicio["FECHAFIN"] = $_REQUEST["FECHAFIN"];
		$servicio["TIPOVACACIONES"] = $_REQUEST["TIPOVACACIONES"];
		$servicio["DNIOPERARIO"] = $_REQUEST["DNIOPERARIO"];
		$_SESSION["TRABAJADOR"] = $servicio;
		Header("Location: modificarTRABAJADOR.php");
	} else {
		$_SESSION["TRABAJADOR"] = $servicio;
		Header("Location: borrarTRABAJADOR.php");
	}
} else
	Header("Location: Vacaciones.php");
?>

?>
