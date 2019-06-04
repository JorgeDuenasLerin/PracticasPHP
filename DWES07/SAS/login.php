<?php 
require_once "metodos.php";
$instancia = new metodos();

$mensaje = "";

if(isset($_POST['login'])){
  if(isset($_POST['user'])){
    if(empty($_POST['user'])){
      $mensaje = "No has introducido email o user";
    }
    if(empty($_POST['password'])){
      $mensaje = "No has introducido contraseña";
    }
    if(!empty($_POST['user']) && !empty($_POST['password'])){
      $instancia->iniciarSesion($_POST['user'], $_POST['password']);
      echo "<pre>";
      echo "<b>{instancia}</b>";
      print_r($instancia);
      echo "</pre>";
      if (!$instancia) {
        $mensaje = "Username o correo ya registrado, utiliza otro";
      } else {
        header('location: index.php');
      }
    } else {
      $mensaje = "Rellena los campos para logearte";
    }
  }// isset user

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
          <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
          <a href="" class="btn btn-block btn-outline-info"> <i class="fab fa-google"></i>   Login via Google</a>
          <hr>
          <p class="text-danger text-center"><?= $mensaje ?></p>
          <form method="POST">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
              </div>
              <input name="user" class="form-control" placeholder="Email or user" type="text" value="Usuario3@gmail.com">
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



          <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
                <label class="custom-control-label" for="defaultUnchecked">Mantener sesión iniciada</label>
            </div>
            <br>
            <button type="submit" name="login" class="btn btn-primary btn-block"> Iniciar sesión  </button>
          </div> <!-- form-group// -->
          <p class="text-center"><a href="reset.php" class="btn">¿Olvidaste la contraseña?</a></p>
          <p class="text-center"><a href="register.php" class="btn">¿No tienes cuenta?<br>Registrate aquí</a></p>
          </form>
        </article>
      </div> <!-- card.// -->
    </aside> 
  </div> <!-- row.// -->
</div> <!-- container.// -->
</body>
</html>