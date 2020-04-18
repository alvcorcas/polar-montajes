<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Polar Montajes: Login</title>
</head>

<body>
	<header>
		<img src="imagenes/logo.png" alt="Instalaciones Eléctricas" ><h1>Polar Montajes</h1>
	<h2>Inicio de sesión</h2>
	</header>
	
<form id="id_For2" method="get" action="">
		<fieldset>
			<legend> Datos Personales </legend>
			<div>
				<label for ="dni"> DNI:..</label>
				<input id="dni" name="dni"  type="text" pattern = "^[0-9]{8}[A-Za-z]" />
			</div>
			<div>
				<label for="nombre"> Nombre*:</label>
				<input id="nombre" name="nombre" type="text"/>
			</div>
			<label> Perfil </label>
			
			<input type="radio" value="1" name="perfil" checked> Trabajador
				<input type="radio" value="1" name="perfil" > Cliente

			<div>
				<label for="email"> Email*:</label>
				<input id="email" name="email" type="email"/>
			</div>
		</fieldset>
	</form>
	
<form id="id_For3" method="get" action="">
		<fieldset>
			<legend> Datos de Usuario</legend>
			<div>
				<label for="usuario"> usuario:</label>
				<input id="usuario" name="user" type="text" placeholder="Mínimo 5 caracteres de letras " required />
			</div>
			<br>

				<label for="pass">contraseña:<em>*</em></label>
				<input type="password" name="pass" id="pass" placeholder="Mínimo 8 caracteres entre letras y dígitos" required />

				<br>
				<label for="confirmpass">Confirmar contraseña: </label>
				<input type="password" name="confirmpass" id="confirmpass" placeholder="Confirmación de contraseña" required />
				<br>
				</fieldset>
		</form>
		
<form id="id_For4" method="get" action="">	
		<fieldset>
			<legend> Dirección </legend>
			<div>
				<label for="calle"> Calle/Avda.:*</label>
				<input id="id_calle" name="calle" type="text" maxlength="80">
			</div>
			
			<div>
				<label for="provincia"> Provincia:*</label>
				<input id="id_provincia" name="provincia" type="text" maxlength="40">
			</div>
			
			<div>
				<label for="Municipio"> Municipio:*</label>
				<input id="id_Municipio" name="Municipio" type="text" maxlength="40">
			</div>
		</fieldset>
	</form>
			<form id="id_For4" method="get" action="">	
		<fieldset>
			<legend> Dirección </legend>
			<div>
				<label for="calle"> Calle/Avda.:*</label>
				<input id="id_calle" name="calle" type="text" maxlength="80">
			</div>
			
			<div>
				<label for="provincia"> Provincia:*</label>
				<input id="id_provincia" name="provincia" type="text" maxlength="40">
			</div>
			
			<div>
				<label for="Municipio"> Municipio:*</label>
				<input id="id_Municipio" name="Municipio" type="text" maxlength="40">
			</div>
		</fieldset>
	</form>
	<form>
		<input id="id_enviar" name"enviar" type="submit" value="Enviar">
	</form>
		</body>
</html>