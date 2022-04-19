<?php

// Eroor handling
ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

// Request
// Monitoring on https://webhook.site/#!/47165371-03b1-4fad-a778-1fc47dcadc94
$params = '{
    "url": "https://webhook.site/47165371-03b1-4fad-a778-1fc47dcadc94",
    "active": true,
    "content_type": "json",
    "event_types": [
        "payment_approved",
        "payment_pending",
        "payment_declined",
        "payment_expired",
        "payment_canceled",
        "payment_voided",
        "payment_void_declined",
        "payment_captured",
        "payment_capture_declined",
        "payment_capture_pending",
        "payment_refunded",
        "payment_refund_declined",
        "payment_refund_pending"
    ]
}';

$curl = curl_init();

// cURL
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sandbox.checkout.com/webhooks',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS => $params,
    CURLOPT_HTTPHEADER => array(
        'Authorization: sk_test_0b9b5db6-f223-49d0-b68f-f6643dd4f808',
        'Content-Type: application/json'
    ),
));

$response = curl_exec($curl);

$curlinfo = curl_getinfo($curl);
//echo '<pre>'; var_dump($curlinfo); echo '</pre>';

if($response) {
    $result = json_decode($response, true);

    echo '<pre><h2>Result:</h2>'; var_dump($result); echo '</pre>';
//    header('Location: '.$result['_links']['self']['href']);
//    exit();
}

curl_close($curl);


