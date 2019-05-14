<?php 
session_start();
// si no se ha logeado
if(!isset($_SESSION['log'])){
  $ip = $_SERVER['REMOTE_ADDR']; 
  //echo "<h1>$ip</h1>";

  $info = $_SERVER['HTTP_USER_AGENT'];
  $info = explode("/", $info);
  $navegador = $info[0];
  //echo "<h1>$navegador</h1>";
  
  $info = $_SERVER['HTTP_USER_AGENT'];
  $info = explode(";", $info);
  $os = $info[1];
  //echo "<h1>$os</h1>";

  // $navegador = get_browser($_SERVER['HTTP_USER_AGENT'], true);

  // token ipinfo 8b58bb3cdfe0bb

  // creando fichero
  $mitxt = "acceso-denegado.txt";
  $fh = fopen($mitxt, 'a');

  // escribiendo
  $fh = fopen($mitxt, 'a') or die("no se puede abrtir el archivo");
  $stringData = "$ip\n$navegador\n$os\n\n";
  fwrite($fh, $stringData);
  fclose($fh);
  $stringData = str_replace(' ','',$str);
  $stringData = str_replace('\n',';',$str);
  //header("location: index.php?denegado=$stringData");
  header( "refresh:1;url=confirmarCompra.php?denegado=$stringData");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Proyecto de fotos</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/especifico.css">
</head>
<body>

<div class="header">
  <h1>Mi sitio web</h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
  <a href="info1.php">Info1</a>
  <a href="info2.php">Info2</a>
  <a href="info3.php">Info3</a>
  <a href="info4.php">Info4</a>
  <a href="info5.php">Info5</a>
  <a href="#" style="float:right">Link</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>Bienvenido</h2>
      <h3>Contenido1</h3>
      <h5>Title description, Dec 7, 2017</h5>

      <img class="todo-espacio" src="https://picsum.photos/1200/600" />
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>About Me</h2>
      <div class="fakeimg" style="height:100px;"><img class="todo-espacio" src="https://picsum.photos/200/100" /></div>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
    </div>
    <div class="card">
      <h3>Follow Me</h3>
      <p>Some text..</p>
    </div>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>
