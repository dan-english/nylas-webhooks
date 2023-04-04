<?php

header('Content-type: application/json');


$message_base="/tmp/";
$event_base="/tmp";

$token="__NYLAS_ACCESS_TOKEN__";
// $nylas_api_server = 'https://api.nylas.com';
$nylas_api_server = 'https://ireland.api.nylas.com';


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


?>