<?php

require_once '../../vendor/autoload.php';

// init configuration
$clientID = '1028952529412-shjc0u294r4a2lken9k14tdqcbqthte0.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/Codingo/public/php/google-redirect.php';


// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
?>