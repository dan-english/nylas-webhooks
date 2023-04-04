<?php
require_once('../includes.php');

$curl = curl_init();

curl_setopt_array($curl, [
              CURLOPT_URL => $nylas_api_server.'/send',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "body" : "Just testing tracking webhooks!",
                "subject": "Testing A webhook",
                "to": [
                    {
                        "name": "Alex Li",
                        "email": "alex.li@nylas.biz"
                    }
                ],
                "tracking": {
                            "links": true,
                            "opens": true,
                            "thread_replies": true,
                            "payload": "Any string you want!!"
                        }
              }',
              CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer '.$token
              ],
]);

$response = curl_exec($curl);

curl_close($curl);

echo $response;
?>