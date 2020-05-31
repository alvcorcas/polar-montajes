	<?php


function alta_periodo($conexion, $vacaciones) {
	
$fechaInicio = date('d/m/Y', strtotime($vacaciones["FECHAINICIO"]));
$fechaFin = date('d/m/Y', strtotime($vacaciones["FECHAFIN"]));

	try {
		$consulta = "CALL solicitud_vacaciones(:fechainicio, :fechafin, :tipovacaciones, :dnioperario)";
			$stmt = $conexion -> prepare($consulta);
			$stmt -> bindParam(':fechainicio', $fechaInicio);
			$stmt -> bindParam(':fechafin', $fechaFin);
			$stmt -> bindParam(':tipovacaciones', $vacaciones["TIPOVACACIONES"]);
			$stmt -> bindParam(':dnioperario', $vacaciones["DNIOPERARIO"]);
			$stmt -> execute();
		
	
			

		return true;
	} catch(PDOException $e) {
		$_SESSION['excepcion'] = $e -> GetMessage();

		return false;
	}
}
?>
