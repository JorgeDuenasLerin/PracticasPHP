<?php 
require_once "metodos.php";
$metodo = new metodos();

$mensaje = "";

require_once('config.php');
$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';


$arrayRegistro = [
  "10" => "Registrado correctamente",
  "11" => "Ya existe ese correo",
  "12" => "Ya existe ese usuario",
  "13" => "No se ha podido insertar ese usuario",
];

if(isset($_POST['register'])){
  if(!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $metodo->registrarUsuario($_POST['user'], $_POST['email'], $_POST['password']);
    $metodo = (array)$metodo;

    // comprobar si un objeto esta vacio | 2 formas 
    // $arr = (array)$resultado;
    // if (empty($arr)) {
    //     // do stuff
    // }
     
    //$metodo = (string)$metodo;
    //var_dump((string) $metodo);
    //$metodo = strval($metodo);
    //$metodo = print_r($metodo,true);

    if($metodo['codigo'] == "10"){
      // echo "<h1>register.php | usuario insertado correctamente</h1>";
      echo '<div class="alert alert-success" role="alert">
                  Te registraste correctamente, redirigiendo!
                </div>';
      header("Refresh:4; url=index.php");
    } else {
        foreach ($arrayRegistro as $key => $value) {
          if($key == $metodo['codigo']){
            $mensaje = $value;
            // echo "<h1>register.php | $mensaje</h1>";
          }
        }
    }
  } else {
    $mensaje = "Rellene todos los campos";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <!-- Boostrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <style>
    /* *{outline:1px solid red;} */

    body, html{height:100%;}

  </style>
  
</head>
<body>
<div class="container d-flex h-100 w-50">
  <div class="row justify-content-center align-self-center w-100">
    <aside class="col-md-12 col-md-offset-3 text-center">
      <div class="card">
        <article class="card-body">
          <h4 class="card-title text-center mb-4 mt-1">Sign up</h4>
          <a href="<?= $login_url ?>" class="btn btn-block btn-outline-info"> <i class="fab fa-google"></i>   Login via Google</a>
          <hr>
          <p class="text-danger text-center"><?= $mensaje ?></p>
          <form method="POST">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
              </div>
              <input name="user" class="form-control" placeholder="User" type="text" value="Usuario3">
            </div> <!-- input-group.// -->
          </div> <!-- form-group// -->

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
              </div>
              <input name="email" class="form-control" placeholder="Email" type="email" value="Usuario3@gmail.com">
            </div> <!-- input-group.// -->
          </div> <!-- form-group// -->

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
              </div>
                <input name="password" class="form-control" placeholder="******" type="password" value="12345">
            </div> <!-- input-group.// -->
          </div> <!-- form-group// -->

          <hr>

          <div class="form-group"> 
            <button type="submit" name="register" class="btn btn-primary btn-block">Registrarse</button>
          </div> <!-- form-group// -->
          <p class="text-center"><a href="login.php" class="btn">¿Ya tienes cuenta?<br>Inicia sesión</a></p>
          </form>
        </article>
      </div> <!-- card.// -->
    </aside> 
  </div> <!-- row.// -->
</div> <!-- container.// -->
</body>
</html>