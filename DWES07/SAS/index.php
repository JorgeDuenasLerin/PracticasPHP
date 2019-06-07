<?php 
if(isset($_SESSION)){
  echo "<pre>";
  echo "<b>{value}</b>";
  print_r($_SESSION);
  echo "</pre>";
}
echo "<pre>";
echo "<b>{_GET}</b>";
print_r($_GET);
echo "</pre>";

echo "<pre>";
echo "<b>{_POST}</b>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
echo "<b>{_COOKIES}</b>";
print_r($_COOKIES);
echo "</pre>";


$arrayErrores = [
  "90" => "Contraseña incorrecta",
  "80" => "No existe usuario con ese correo",
  "70" => "No existe usuario con ese nickname",
  "60" => "No existe usuario con ese id",
  "50" => "No existe el usuario introducido",
  "40" => "Ya existe ese usuario, introduce otro",
  "30" => "Este correo ya esta registrado, introduce otro",
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>
<h1>INDEX.PHP</h1>
<?php ?>
</body>
</html>