<?php 
// Holds the Google application Client Id, Client Secret and Redirect Url
include_once('config.php');

// Holds the various APIs functions
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		// Get the access token 
		$data = GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
        echo "<pre>";
        echo "<b>_GET</b><br>";
        print_r($data);
        echo "</pre>";

		// Access Tokem
		$access_token = $data['access_token'];
		
		// Get user information
		$user_info = GetUserProfileInfo($access_token);
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <?php 
    foreach ($user_info as $key => $value) {
        echo $key;
        echo " - ";
        echo $value;
        echo "<br>";
    }

    echo "<pre>";
    echo "<b>_GET</b><br>";
    print_r($_GET);
    echo "</pre>";

    echo "<pre>";
    echo "<b>_POST</b><br>";
    print_r($_POST);
    echo "</pre>";

    if(isset($_SESSION)){
        echo "<pre>";
        echo "<b>_SESSION</b><br>";
        print_r($_SESSION);
        echo "</pre>";
    }
    
    echo "<pre>";
    echo "<b>_COOKIE</b><br>";
    print_r($_COOKIE);
    echo "</pre>";

    ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 align-self-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Enlace foto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td><?= $user_info['email'] ?></td>
                    <td><?= $user_info['name'] ?></td>
                    <td><img src="<?= $user_info['picture'] ?>" width="70%"/></td>
                    <td><a href="<?= $user_info['picture'] ?>"><?= $user_info['picture'] ?></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>