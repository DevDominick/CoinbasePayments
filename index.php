<?php

#####################################
#                                   #
#            MARCUS-DEV             # 
#                                   #
#####################################


$post = array(
    "name" =>" subscription",
    "description" => "x Days of x subscription",
    "local_price" => array(
        'amount' => 20,
        'currency' => 'USD'
    ),
    "pricing_type" => "fixed_price"
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.commerce.coinbase.com/charges');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-Cc-Api-Key: '.$coinbase_api;
$headers[] = 'X-Cc-Version: 2018-03-22';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response, true);
$uqid = $response['data']['id'];
$url = $response['data']['hosted_url'];
header("Location: ".$url);

?>