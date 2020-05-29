<?php
session_start();

require_once ("../gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	// Inicializamos la variable con los datos del formulario asignando valores por defecto a los elementos
	$formulario['idfactura'] = "";
	$formulario[''] = "";
	$formulario['idfactura'] = "";
	$formulario['idfactura'] = "";
	$formulario['idfactura'] = "";

	// Guardamos los datos en la sesión
	$_SESSION['formulario'] = $formulario;
} else {
	//Si ya se ha completado el formulario
	$formulario = $_SESSION['formulario'];
}

if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
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
		<?php
		include_once ("../cabecera.php");
		?>

		<header>
			<h2>Creación de facturas: En primer lugar rellene el formulario de la izquierda y haga click en enviar factura. A continuación, añada tantas filas en la tabla como  lineas tenga la factura y seleccione en enviar lineasFactura</h2>
			<hr	 />
		</header>

		<ul>
			<li>
				<a href= "../principal/index.php">Polar Montajes:</a>
			</li>
			<li>
				<a href= "../principal/servicios.php">Servicio</a>
			</li>
			<li>
				<a href="../operarios/consultaTrabajadores.php">Trabajadores</a>
			</li>
			<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Cliente'){
			?>
			<li>
				<a href="../clientes/facturasPorCliente.php">Mis facturas</a>
			</li>
			<?php } ?>
			<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){
			?>
			<li>
				<a href="../facturas/consultaFacturas.php">Facturas</a>
			</li>
			<?php } ?>
			<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){
			?>
			<li>
				<a href="../clientes/consultaClientes.php">Clientes</a>
			</li>
			<?php } ?>
			<?php if(isset($_SESSION['login']) and $_SESSION['perfil'] == 'Trabajador'){
			?>
			<li>
				<a href="../pedidos/consultaPedidos.php">Pedidos</a>
			</li>
			<?php } ?>
			<li>
				<a href="contacto.php">Contact</a>
			</li>
			<li>
				<a href="about.php">About</a>
			</li>
			<li>
				<a href="../usuarios/login.php">Login</a>
			</li>
			<li>
				<a href="../usuarios/logout.php">Logout</a>
			</li>
		</ul>

		<br>
		<div style="display: flex">
			<!-- Formulario a rellenar con el contenido de la factura creada -->
			<form id="nuevaFactura" method="post" action="controladorFacturas.php">
				<label>ID de la factura: </label>
				<br>
				<br>
				<input type="text" name="IDFACTURA" placeholder="LLxxxx(2 mayús, 4 números)" pattern="[A-Z]{2}[0-9]{4}"/>
				<br>
				<br>
				<label>Fecha de emision: </label>
				<br>
				<br>
				<input type="date" name="FECHAEMISION" placeholder="dd/mm/aaaa"/>
				<br>
				<br>
				<label>Fecha de vencimiento: </label>
				<br>
				<br>
				<input type="date" name="FECHAVENCIMIENTO" placeholder="dd/mm/aaaa"/>
				<br>
				<br>
				<label>Tipo de Pago: </label>
				<br>
				<br>
				<input type="radio" name="tipoPago"/>
				<label>Transferencia Bancaria</label>
				<br>
				<br>
				<input type="radio" name="tipoPago"/>
				<label>Metálico</label>
				<br>
				<br>
				<label>Precio sin IVA:</label>
				<br>
				<br>
				<input type="text" name="precioSinIva" placeholder="Precio en euros" pattern="[0-9]"/>
				<br>
				<br>
				<label>IVA:</label>
				<br>
				<br>
				<input type="text" name="iva" placeholder="0,21 x Precio Sin IVA" pattern="[0-9]"/>
				<br>
				<br>
				<label>Precio con IVA:</label>
				<br>
				<br>
				<input type="text" name="precioConIva" placeholder="1,21 x Precio Sin IVA" pattern="[0-9]"/>
				<br>
				<br>
				<label>DNI del Operario</label>
				<br>
				<br>
				<input id="dniOperario" name="dniOperario" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula">
				<br>
				<br>
				<label>DNI del cliente</label>
				<br>
				<br>
				<input id="dniCliente" name="dniCliente" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula">
				<br>
				<br>
			</form>

			<table id="myTable" style="width:100%" >
				<tr>
					<th>Cantidad</th>
					<th>Descripcion</th>
					<th>Precio unidad</th>
					<th>Precio total</th>
					<th>ID del servicio que representa</th>
					<th>
					<button type="button" onclick="addRow()">
						Añadir fila
					</button></th>
					<th>
					<button type="button" onclick="deleteRow()">
						Eliminar fila
					</button></th>
				</tr>
			</table>
		</div>
		
		<button onclick="enviarLineasFactura()">
			Enviar lineas de factura
		</button>
		<button onclick="enviarFactura()">
			Enviar factura
		</button>
		
		<script>
			function enviarFactura(){
				
			}
			
			
			function addRow() {
				var table = document.getElementById("myTable");
				var row = table.insertRow();
				var cell1 = row.insertCell(0);
				var cell2 = row.insertCell(1);
				var cell3 = row.insertCell(2);
				var cell4 = row.insertCell(3);
				var cell5 = row.insertCell(4);
				var i = table.rows.length - 1;
				cell1.innerHTML = '<input type="text" id="cantidad' + i + '" name="cantidad" pattern="[0-9]"/>';
				cell2.innerHTML = '<input type="text" id="descripcion' + i + '" name="descripcion"/>';
				cell3.innerHTML = '<input type="text" id="precioUnitario' + i + '" name="precioUnitario" pattern="[0-9]"/>';
				cell4.innerHTML = '<input type="text" id="precioTotal' + i + '" name="precioTotal" pattern="[0-9]"/>';
				cell5.innerHTML = '<input type="text" id="oid_s' + i + '" name="OID_S" placeholder="Id numérico" pattern="[0-9]"/>';
			}

			function deleteRow() {
				var tabla = document.getElementById("myTable");
				var nFilas = tabla.rows.length;
				if (nFilas != 1)
					tabla.deleteRow(nFilas - 1);
			}

			function enviarLineasFactura() {
				var cantidad;
				var descripcion;
				var precioUnitario;
				var precioTotal;
				var oid_s;
				var numeroFilas = document.getElementById("myTable").rows.length;
				for (var i = 1; i < numeroFilas; i++) {
					cantidad = document.getElementById("cantidad" + i).value;
					// alert(cantidad);
					descripcion = document.getElementById("descripcion" + i).value;
					// alert(descripcion);
					precioUnitario = document.getElementById("precioUnitario" + i).value;
					// alert(precioUnitario);
					precioTotal = document.getElementById("precioTotal" + i).value;
					// alert(precioTotal);
					oid_s = document.getElementById("oid_s" + i).value;
					// alert(oid_s);
					alert("crearLineaFactura.php?cantidad=" + cantidad + "&descripcion=" + descripcion + "&precioUnitario=" + precioUnitario + "&precioTotal=" + precioTotal + "&oid_s=" + oid_s);
					var xhttp;
					xhttp = new XMLHttpRequest();
					xhttp.open("GET", "crearLineaFactura.php?cantidad=" + cantidad + "&descripcion=" + descripcion + "&precioUnitario=" + precioUnitario + "&precioTotal=" + precioTotal + "&oid_s=" + oid_s, true);
					xhttp.send();
				}
			}
		</script>

	</body>
</html>