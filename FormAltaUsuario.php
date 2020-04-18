<?php

include_once("cabecera.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/principal.css" />
  <title>Gestión de Polar Montajes: Usuarios</title>
</head>

<body>
	<form id="altaUsuario" method="get" action="accion_alta_usuario.php" novalidate="novalidate">
			<p>
				<i>Los campos obligatorios están marcados con </i><em>*</em>
			</p>
			<fieldset>
				<legend>
					Datos personales
				</legend>
				<label for="nif">NIF<em>*</em></label>
				<input id="nif" name="nif" type="text" placeholder="12345678X" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" required>
				<br>

				<label for="nombre">Nombre:<em>*</em></label>
				<input id="nombre" name="nombre" type="text" size="40" required/>
				<br>

				<label for="apellidos">Apellidos:</label>
				<input id="apellidos" name="apellidos" type="text" size="80" required/>
				<br>
					<label>Perfil:</label>
				<label>
					<input name="perfil" type="radio" value="ALUMNO"/>
					Trabajador</label>
				<label>
					<input name="perfil" type="radio" value="PDI" />
					Cliente</label>
					<br>
						<label for="email">Email:<em>*</em></label>
				<input id="email" name="email"  type="email" placeholder="usuario@dominio.extension" required/><br>

				<br>
			</fieldset>

			<fieldset>
				<legend>
					Datos de usuario
				</legend>
				<label for="usuario">Usuario:</label>
				<input id="usuario" name="usuario" type="text"  size="40" required placeholder="Mínimo 5 caracteres de letras" required />
				<br>

				<label for="pass">Password:<em>*</em></label>
				<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required />

				<br>
				<label for="confirmpass">Confirmar Password: </label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" required />
				<br>
				</fieldset>
				
			<fieldset>
				<legend>
					Dirección
				</legend>

				<label for="calle">Calle/Avda.:<em>*</em></label>
				<input id="calle" name="calle" type="text" size="80"/>
				<br>

				<label for="provincia">Provincia:<em>*</em></label>
				<input list="opcionesProvincias" name="provincia" id="provincia"/>
				<datalist id="opcionesProvincias">
				  	<option value="11">Cádiz</option>
					<option value="41">Sevilla</option>
					<option value="29" >Málaga</option>
					<option value="21">Huelva</option>
					<option value="14">Córdoba</option>
					<option value="23">Jaén</option>
					<option value="04">Almería</option>
					<option value="18">Granada</option>
					<option value="OT">Otra</option>
				</datalist>
				<br>
			</fieldset>
			<input type="submit" value="Enviar" />
		</form>
	</body>
</html>