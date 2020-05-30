<?php
session_start();

if (isset($_REQUEST["OID_S"])) {
	$servicio["OID_S"] = $_REQUEST["OID_S"];

	if (isset($_REQUEST["editar"])) {
		$_SESSION["TRABAJADOR"] = $servicio;
		Header("Location: consultaTRABAJADORs.php");
	} else if (isset($_REQUEST["grabar"])) {
		$servicio["OID_S"] = $_REQUEST["OID_S"];
		$servicio["TIEMPOEMPLEADO"] = $_REQUEST["TIEMPOEMPLEADO"];
		$servicio["FECHAINICIO"] = $_REQUEST["FECHAINICIO"];
		$servicio["FECHAFIN"] = $_REQUEST["FECHAFIN"];
		$servicio["TIPOSERVICIO"] = $_REQUEST["TIPOSERVICIO"];
		$servicio["TERCERAEMPRESA"] = $_REQUEST["TERCERAEMPRESA"];
		$servicio["DNICLIENTE"] = $_REQUEST["DNICLIENTE"];
		$_SESSION["TRABAJADOR"] = $servicio;
		Header("Location: modificarTRABAJADOR.php");
	} else {
		$_SESSION["TRABAJADOR"] = $servicio;
		Header("Location: borrarTRABAJADOR.php");
	}
} else
	Header("Location: consultarservicios.php");
?>

?>
