<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/tarea.css">
  </head>
  <body>
  	<fieldset>
  		<legend>Preferencias</legend>
	<form action="">
		<span></span>
		<label class="etiqueta">Idioma:</label><br>
		<select name="idioma" id="">
			<option value="español">Español</option>
			<option value="ingles">Inglés</option>
		</select><br><br>
		<label class="etiqueta">Perfil público:</label><br>
		<select name="perfil" id="">
			<option value="si">si</option>
			<option value="no">no</option>
		</select><br><br>
		<label class="etiqueta">Zona Horaria:</label><br>
		<select name="hora" id="">
			<option value="GMT-2">GMT-2</option>
			<option value="GMT-1">GMT-1</option>
			<option value="GMT">GMT</option>
			<option value="GMT+1">GMT+1</option>
			<option value="GMT+2">GMT+2</option>
		</select><br><br>
		<input type="submit" value="Establecer preferencias">
	</form>

	<a href="">Mostrar preferencias</a>
	</fieldset>
</body>
</html>
