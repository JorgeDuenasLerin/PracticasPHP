<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                        <!-- EL CLIENT ID DE MI APP -->
  <meta name="google-signin-client_id" content="243108833266-4fb4pv78g97envvlhimeldn6r6aieprp.apps.googleusercontent.com">
  <title>Document</title>
  <!-- Libraria de la plataforma de Google -->
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <!-- Mi script -->
  <script src="script.js"></script>
</head>
<body>
<div class="g-signin2" data-onsuccess="onSignIn"></div>
<div class="data">
  <p>Detallis del perfil</p>
  <img id="pic" class="img-circle" width="100" height="100"/>
  <p>Email Address</p>
  <p id="email" class="alert alert-danger"></p>
  <button onclick="signOut()" class="btn btn-danger">SingOut</button>
</div>
</body>
</html>