<?php

// Error handling
ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

// Request
$params = '{
    "source": {
        "type": "token",
        "token": "'.$_GET['token'].'",
    },
    "amount": 6510,
    "currency": "EUR",
    "3ds": {
        "enabled": true
    },
    "reference": "'.uniqid().'",
    "description": "3 t-shirts",
    "customer": {
        "email": "'.$_GET['email'].'",
        "name": "'.$_GET['name'].'",
    },
    "success_url": "'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER["HTTP_HOST"].strtok($_SERVER["REQUEST_URI"],'?').'?success",
    "failure_url": "'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$_SERVER["HTTP_HOST"].strtok($_SERVER["REQUEST_URI"],'?').'?fail",
}';
//echo '<pre>'; var_dump($params); echo '</pre>';

// cURL
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.sandbox.checkout.com/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
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

//    echo '<pre><h2>Result:</h2>'; var_dump($result); echo '</pre>';
//    echo '<pre>'; var_dump($result['_links']['redirect']['href']); echo '</pre>';

    // 3DS redirection
    header('Location: '.$result['_links']['redirect']['href']);
    exit();
}

curl_close($curl);
