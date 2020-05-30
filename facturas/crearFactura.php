<?php
session_start();
require_once ("../gestionBD.php");

if(!isset($_SESSION['login']) or $_SESSION['perfil'] == "cliente")
	header("Location: ../index.php")
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/Proyecto.css" />
		<script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="../js/boton.js?v=<?= $version ?>"></script>
		<title>Creación de una factura</title>
	</head>

	<body>
		<?php
		include_once ("../cabecera.php");
		?>

		<header>
			<h2>Creación de facturas</h2>
			<p>
				En primer lugar rellene el formulario de la izquierda y haga click en enviar factura. A continuación, añada tantas filas en la tabla como lineas tenga la factura y seleccione en enviar tras haberlas rellenado
			</p>
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

			<form id="nuevaFactura" action="funcionCrearFactura.php" method="post">
				<label>ID de la factura: </label>
				<br>
				<br>
				<input type="text" id="idFactura" name="idFactura" placeholder="LLxxxx(2 mayús, 4 números)" pattern="[A-Z]{2}[0-9]{5}" required/>
				<br>
				<br>
				<label>Fecha de emision: </label>
				<br>
				<br>
				<input type="date" id="fechaEmision" name="fechaEmision" placeholder="dd/mm/aaaa" required/>
				<br>
				<br>
				<label>Fecha de vencimiento: </label>
				<br>
				<br>
				<input type="date" id="fechaVencimiento" name="fechaVencimiento" placeholder="dd/mm/aaaa" required/>
				<br>
				<br>
				<label>Tipo de Pago: </label>
				<br>
				<br>
				<input type="radio" id="transferenciaBancaria" name="tipoPago" value="Transferencia Bancaria" checked="true"/>
				<label>Transferencia Bancaria</label>
				<br>
				<br>
				<input type="radio" id="metalico" value="Metálico" name="tipoPago"/>
				<label>Metálico</label>
				<br>
				<br>
				<label>Precio sin IVA:</label>
				<br>
				<br>
				<input type="text" id="precioSinIva" value="100" name="precioSinIva" placeholder="Precio en euros" pattern="[0-9]+" required/>
				<br>
				<br>
				<label>IVA:</label>
				<br>
				<br>
				<input type="text" id="iva" name="iva" value="21" placeholder="0,21 x Precio Sin IVA" pattern="[0-9]+" required/>
				<br>
				<br>
				<label>Precio con IVA:</label>
				<br>
				<br>
				<input type="text" id="precioConIva" value="121" name="precioConIva" placeholder="1,21 x Precio Sin IVA" pattern="[0-9]+" required/>
				<br>
				<br>
				<label>DNI del cliente</label>
				<br>
				<br>
				<input id="dniCliente" value="00000001B" name="dniCliente" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" required>
				<br>
				<br>
				<input type="submit" id="facturacion" value="Enviar factura" onclick="enviarFactura()">
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

		<button id="lineasFacturacion" onclick="enviarLineasFactura()" style="visibility: hidden">
			Insertar lineas de la factura
		</button>

		<div id="test">

		</div>

		<script>
			function enviarFactura() {
				document.getElementById("facturacion").style.visibility = 'hidden';
				document.getElementById("lineasFacturacion").style.visibility = 'visible';
				
				$("#nuevaFactura").submit(function(e) {

					e.preventDefault();
					// avoid to execute the actual submit of the form.

					var form = $(this);
					var url = form.attr('action');

					$.ajax({
						type : "POST",
						url : url,
						data : form.serialize(), // serializes the form's elements.
						success : function(data) {
							alert(data);
						}
					});

				});
				
				
				
				// $.post("funcionCrearFactura.php", {
				// idFactura : $('#idFactura').val(),
				// fechaEmision : $('#fechaEmision').val(),
				// fechaVencimiento : $('#fechaVencimiento').val(),
				// tipoPago : $("input[type=radio]:checked").val(),
				// precioSinIva : $('#precioSinIva').val(),
				// iva : $('#iva').val(),
				// precioConIva : $('#precioConIva').val(),
				// dniCliente : $('#dniCliente').val()
				// }, function(data, success) {
				// $('#test').html(data);
				//
				// });

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
				var numeroFilas = document.getElementById("myTable").rows.length;
				var i;
				for ( i = 1; i < numeroFilas; i++) {
					$.post("crearLineaFactura.php", {
						cantidad : $("#cantidad" + i).val(),
						descripcion : $("#descripcion" + i).val(),
						precioUnitario : $("#precioUnitario" + i).val(),
						precioTotal : $("#precioTotal" + i).val(),
						oid_s : $("#oid_s" + i).val()
					}, function(data) {
						alert("Linea correctamente insertada");

					});
				}
				if(numeroFilas >1)
					document.getElementById("lineasFacturacion").style.visibility = 'hidden';
			}
		</script>

	</body>
</html>