<?php
session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();
$consulta = "CALL insertar_lineaPEDIDO(:cantidad, :precioTotal, :oid_p, :oid_prod)";
$stmt = $conexion -> prepare($consulta);
$stmt -> bindParam(':cantidad', $_GET['cantidad']);
$stmt -> bindParam(':precioTotal', $_GET['precioTotal']);
$stmt -> bindParam(':oid_p', $_SESSION['idPedido']);
$stmt -> bindParam(':oid_prod', $_GET['oid_prod']);
$stmt -> execute();
cerrarConexionBD($conexion);
?>