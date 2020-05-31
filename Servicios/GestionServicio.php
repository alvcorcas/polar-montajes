<?php

function consultarservicios($conexion) {
	$consulta = "SELECT * FROM SERVICIO";
	return $conexion -> query($consulta);
}

function alta_servicio($conexion, $servicio) {
$fechaInicio = date('d/m/Y', strtotime($servicio["FECHAINICIO"]));
$fechaFin = date('d/m/Y', strtotime($servicio["FECHAFIN"]));

	try {
		$consulta = "CALL insertar_servicio(:tiempoempleado, :fechainicio, :fechafin, :tiposervicio, :terceraempresa, :dnicliente)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':tiempoempleado', $servicio["TIEMPOEMPLEADO"]);
		$stmt -> bindParam(':fechainicio', $fechaInicio);
		$stmt -> bindParam(':fechafin', $fechaFin);
		$stmt -> bindParam(':tiposervicio', $servicio["TIPOSERVICIO"]);
		$stmt -> bindParam(':terceraempresa', $servicio["TERCERAEMPRESA"]);
		$stmt -> bindParam(':dnicliente', $servicio["DNICLIENTE"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();

		return false;
	}
}
?>
