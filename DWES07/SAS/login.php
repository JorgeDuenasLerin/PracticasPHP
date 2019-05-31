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
  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

  <!-- Mi script -->
  <script src="js/script.js"></script>
  <!-- <link rel="stylesheet" href="css/signupgoogle.css"> -->

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
    <aside class="col-12">
      <div class="card">
        <article class="card-body">
          <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
          <div id="gSignInWrapper">
          <div class="g-signin2" data-width="360" data-height="40" data-longtitle="true" data-onsuccess="onSignIn"></div>
          <hr>
          <p class="text-success text-center">Some message goes here</p>
          <form>
          <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="" class="form-control" placeholder="Email or login" type="email">
          </div> <!-- input-group.// -->
          </div> <!-- form-group// -->
          <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
              <input class="form-control" placeholder="******" type="password">
          </div> <!-- input-group.// -->
          </div> <!-- form-group// -->
          <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block"> Login  </button>
          </div> <!-- form-group// -->
          <p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
          </form>
        </article>
      </div> <!-- card.// -->
    </aside> 
  </div> <!-- row.// -->
</div> <!-- container.// -->
<script>
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

    Session["id"] = profile.getId();
    Session["Name"] = profile.getName();
    Session["image"] = profile.getImageUrl();
    Session["email"] = profile.getEmail();

    // $(".g-signin2").css("display", "none");
    // $(".data").css("display", "block");
    // $("#pic").attr("src", profile.getImageUrl());
    // $("#email").text(profile.getEmail());

    var myUserEntity = {};
    myUserEntity.Id = profile.getId();
    myUserEntity.Name = profile.getName();
    
    //Store the entity object in sessionStorage where it will be accessible from all pages of your site.
    sessionStorage.setItem('myUserEntity',JSON.stringify(myUserEntity));

    alert(profile.getName()); 
    window.location.href='index.php';
  }

function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
    alert('User signed out.');
    $(".g-signin2").css("display", "block");
    $(".data").css("display", "none");
  });
}

function onSuccess(googleUser) {
  console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
}
function onFailure(error) {
  console.log(error);
}
function renderButton() {
  gapi.signin2.render('my-signin2', {
    'scope': 'profile email',
    'width': 240,
    'height': 50,
    'longtitle': true,
    'theme': 'dark',
    'onsuccess': onSuccess,
    'onfailure': onFailure
  });
}

function checkIfLoggedIn()
{
  if(sessionStorage.getItem('myUserEntity') == null){
    //Redirect to login page, no user entity available in sessionStorage
    window.location.href='login.php';
  } else {
    //User already logged in
    var userEntity = {};
    userEntity = JSON.parse(sessionStorage.getItem('myUserEntity'));
    console.log('Haz lo que quieras aqui, esta logeado');
  }
}

signOut();
gapi.auth.authorize(
    { 
        'client_id': CLIENT_ID, 
        'scope': SCOPES, 
        'immediate': false,
        cookie_policy: 'single_host_origin',
        response_type: 'token id_token'
    },
    function (authResult) {   gapi.auth.signOut();}
);

// checkIfLoggedIn();
  </script>
</body>
</html>