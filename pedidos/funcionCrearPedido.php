<?php
session_start();
require_once ("../gestionBD.php");
$conexion = crearConexionBD();
$consulta = "CALL insertar_pedido(:fecha, :precio, :nombreEmpresa, :dniOperario)";
$stmt = $conexion -> prepare($consulta);
$fecha = date('d/m/Y', strtotime($_GET['fecha']));
$stmt -> bindParam(':fecha', $fecha);
$stmt -> bindParam(':precio', $_GET['precio']);
$stmt -> bindParam(':nombreEmpresa', $_GET['nombreEmpresa']);
$stmt -> bindParam(':dniOperario', $_SESSION['login']);
$stmt -> execute();
$sh = $conexion->prepare('SELECT sec_pedido.CURRVAL FROM dual');
$sh->execute();
$insertId = $sh->fetchColumn(0);
$_SESSION['idPedido'] = $insertId;
cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
		<script src="js/boton.js?v=<?= $version ?>"></script>
		<title>Creación de una factura</title>
	</head>
	<body>

		<?php echo $_GET['fecha']; ?><br>
		<?php echo $_GET['precio']; ?><br>
		<?php echo $_GET['nombreEmpresa']; ?><br>
		<?php echo $_SESSION['login']; ?><br>
		<?php echo $_SESSION['idPedido']; ?><br>
		<p>
			http://localhost:81/IISSI/polar-montajes/pedidos/funcionCrearPedido.php?fechaPedido=&precio=&nombreEmpresa=&dniCliente=
		</p>

	</body>

</html>