<?php 
require_once "metodos.php";
$metodo = new metodos();

$mensaje = "";

if(isset($_POST['reset'])){
    if(!empty($_POST['email'])){
      $existeCorreo = $metodo->restablecerContra($_POST['email']);
      if(!$existeCorreo){
        $mensaje = "No existe ese correo";
      } else {
        // echo "si que existe";
      }
    } else {
      $mensaje = "Introduce un correo porfavor";
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
          <h4 class="card-title text-center mb-4 mt-1">Reset Password</h4>
          <hr>
          <p class="text-danger text-center"><?= $mensaje ?></p>
          <form method="POST">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-user"></i> </span>
              </div>
              <input name="email" class="form-control" placeholder="Email" type="email">
            </div> <!-- input-group.// -->
          </div> <!-- form-group// -->
          
            <div class="form-group">
                <br>
                <button type="submit" name="reset" class="btn btn-primary btn-block">Resetear contraseña</button>
            </div> <!-- form-group// -->
          </form>
        </article>
      </div> <!-- card.// -->
    </aside> 
  </div> <!-- row.// -->
</div> <!-- container.// -->
</body>
</html>