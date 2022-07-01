<?php

#####################################
#                                   #
#            MARCUS-DEV             # 
#                                   #
#####################################


$payload = file_get_contents('php://input');

$secret = "";


$headerName = 'x-cc-webhook-signature';

$headers = getallheaders();
$signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;


//SHA256 HMAC of payload with secret
$signature = hash_hmac('sha256', $payload, $secret);

//check if null
if($signraturHeader == null){
    die('Not Allowed');
}


if (hash_equals($signature, $signraturHeader)) {

    $jsonString = json_decode($payload, true);
    
    $id = $jsonString['event']['data']['id'];
    $event_type = $jsonString['event']['type'];

    if($event_type == 'charge:confirmed'){
            // do something
        

    }


}
?>