<?php

require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
$username   = "sandbox";
$apiKey     = "d9e4ce1cc9b12ff251d413a606369b0b32da36ef8648a8ce5cc095acdb8dfc36";


// Initialize the SDK
$AT         = new AfricasTalking($username, $apiKey);

// Get the SMS service
$sms        = $AT->sms();

// Set the numbers you want to send to in international format
$recipients = "+254727858544";

// Set your message
// $message    = "Welcome to Mental Auti-Awareness,
//  Raising awareness of mental health and mental health problems. Stopping the stigmatisation and discrimination mental health carries.
//  Providing user friendly services that enable easy access to professional help wherever you are. Good Mental Health for all!
//  Visit https://mentalauti-awareness.herokuapp.com/ and Dial *384*74079# for more information and needed help ASAP.";


 $message = "Welcome to Mental Auti-Awareness,Raising awareness of mental health and mental health problems, Providing user friendly services.
 Visit https://mentalauti-awareness.herokuapp.com/ and Dial *384*74079# for more information.";

// Set your shortCode or senderId
$from       = "MAAwareness";

try {
    // Thats it, hit send and we'll take care of the rest
    $result = $sms->send([
        'to'      => $recipients,
        'message' => $message,
        'from'    => $from
    ]);

    print_r($result);
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}





 ?>
