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




// Set your app credentials -FETCH
$username = "sandbox";
$apiKey   = "d9e4ce1cc9b12ff251d413a606369b0b32da36ef8648a8ce5cc095acdb8dfc36";

// Initialize the SDK
$AT       = new AfricasTalking($username, $apiKey);

// Get the sms service
$sms      = $AT->sms();

// Set your premium product shortCode and keyword
$shortCode     = "55555";
$keyword       = "Awareness";

// Our API will return 100 subscription numbers at a time back to you,
// starting with what you currently believe is the lastReceivedId.
// Specify 0 for the first time you access the method
// and the ID of the last subscription we sent you on subsequent calls
$lastReceivedId = 2007961;

try {
    // Fetch all subscriptions using a loop
    do {
        $subscriptions = $sms->fetchSubscriptions([
            'shortCode'      => $shortCode,
            'keyword'        => $keyword,
            'lastReceivedId' => $lastReceivedId
        ]);

        foreach($subscriptions as $subscription) {
            print_r($subscription);

            // Reassign the lastReceivedId
            $lastReceivedId = $subscription->id;
        }
    } while (count($results) > 0);

    // NOT: Be sure to save the lastReceivedId for next time
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}




// Set your app credentials- DELETE
$username = "sandbox";
$apiKey   = "d9e4ce1cc9b12ff251d413a606369b0b32da36ef8648a8ce5cc095acdb8dfc36";

// Initialize the SDK
$AT       = new AfricasTalking($username, $apiKey);

// Get the sms service
$sms      = $AT->sms();

// Set your premium product shortCode and keyword
$shortCode   = '55555';
$keyword     = 'Awareness';

// Set the phone number you're unsubscribing
$phoneNumber = "+254727858544";

try {
    // Delete the subscription
    $result = $sms->deleteSubscription([
        'shortCode'   => $shortCode,
        'keyword'     => $keyword,
        'phoneNumber' => $phoneNumber
    ]);

    print_r($result);
} catch(Exception $e) {
    echo "Error: ".$e->getMessage();
}



?>
