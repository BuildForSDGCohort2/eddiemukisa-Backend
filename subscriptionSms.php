<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;

// Set your app credentials
$username = "sandbox";
$apiKey   = "d9e4ce1cc9b12ff251d413a606369b0b32da36ef8648a8ce5cc095acdb8dfc36";

// Initialize the SDK
$AT       = new AfricasTalking($username, $apiKey);

// Get the sms service
$sms      = $AT->sms();

// Get the token service
$token    = $AT->token();

// Set your premium product shortCode and keyword
$shortCode   = '55555';
$keyword     = 'Awareness';

// Set the phone number you're subscribing
$phoneNumber = "+254727858544";

try {
    // Get a checkoutToken for the phone number you're subscribing
    $checkoutTokenResult = $token->createCheckoutToken([
        'phoneNumber'    => $phoneNumber
    ]);

    $checkoutToken       = $checkoutTokenResult->token;

    // Create the subscription
    $result = $sms->createSubscription([
        'shortCode'      => $shortCode,
        'keyword'        => $keyword,
        'phoneNumber'    => $phoneNumber,
        'checkoutToken'  => $checkoutToken
    ]);

    print_r($result);
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}
?>
