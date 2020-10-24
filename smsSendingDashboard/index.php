<?php

require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;
//add code here
//add AT API Key
$username = "sandbox";
$apiKey = "d9e4ce1cc9b12ff251d413a606369b0b32da36ef8648a8ce5cc095acdb8dfc36";
$AT = new AfricasTalking($username, $apiKey);


//router
$router = new AltoRouter();
$router->map( 'GET', '/', function() {
    require __DIR__ . '/views/index.php';
});
$router->map( 'POST', '/auth/register/[*:phone]', function ($phone) {
    global $AT;
    $sms = $AT->sms();
    $response = $sms->send(array(
        "to" => $phone,
        "message" => "Welcome to Mental Auti-Awareness Company",
    ));
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($response);
});




$match = $router->match();
if( $match && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] );
} else {
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

?>
