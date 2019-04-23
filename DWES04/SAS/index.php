<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="DWES04_TAR_R05_tarea.css">
  </head>
  <body>
    <fieldset>
      <legend>Preferencias</legend>

      <form action="">

        <b>Idioma:</b>
        <select name="idioma">      
          <option value="español">español</option>
          <option value="ingles">inglés</option>
        </select><br><br>

        <b>Perfil público:</b>
        <select name="perfil">      
          <option value="no">no</option>
          <option value="si">si</option>
        </select><br><br>

        <b>Zona horaria:</b>
        <select name="zona">      
          <option value="GMT-2">GMT-2</option>
          <option value="GMT-1">GMT-1</option>
          <option value="GMT">GMT</option>
          <option value="GMT+1">GMT+1</option>
          <option value="GMT+2">GMT+2</option>
        </select><br><br>

        <input type="submit" value="Establecer preferencias"><br>
        <a href="mostrar.php">Mostrar preferencias</a>

      </form>
      
    </fieldset>
  </body>
</html>
