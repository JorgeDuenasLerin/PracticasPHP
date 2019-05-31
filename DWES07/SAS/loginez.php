<?php

require_once('config.php');

$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';

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
<html>
<head>....</head>

<body>
	.....
	
	<a href="<?= $login_url ?>">Login with Google</a>

	.....
</body>
</html>