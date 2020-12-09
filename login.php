<?php
require 'google-api/vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('733316931061-8r3mqbar6pggt1k7s6vn8qdajk4kag0k.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('wUTaNwCv4FEQzVz0S4f161SI');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/google_login/login.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // getting profile information
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    // showing profile info
    echo "<pre>";
    var_dump($google_account_info);

else: 
    // Google Login Url = $client->createAuthUrl(); 
?>

    <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>">Login</a>

<?php endif; ?>