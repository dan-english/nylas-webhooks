<?php
header('Content-type: application/json');

$logs_base="/home/dan/projects/nylas/webhooks/logs";

// $nylas_api_server = 'https://api.nylas.com';
$nylas_api_server = 'https://ireland.api.nylas.com';
$client_id = '_YOUR_NYLAS_CLIENT_ID_';
$client_secret = '_YOU_NYLAS_CLIENT_SECRET_';


function getMessageById($id, $token, $base) {

    $curl = curl_init();
    curl_setopt_array($curl, [
                  CURLOPT_URL => $base.'/messages/'.$id,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => [
                    "Authorization: Bearer $token"
                  ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true);
}




function makeCurlRequest($request_uri, $requestType="POST", $payload = [], $token='') {

    $encoded_payload = json_encode($payload);
    $url = 'https://ireland.api.nylas.com' . $request_uri;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token,
    ]);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_ENCODING, '');
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestType);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded_payload);

    $response = curl_exec($curl);
    #print($response);
    return json_decode($response, true);
}




?>