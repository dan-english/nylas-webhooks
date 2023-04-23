<?php
require_once('../includes.php');

## Send an email message for testing webhooks

$token="TOKEN_WITH_EMAIL_SCOPES";

$messagePayload =[
                "body" => "Just testing tracking webhooks!",
                "subject"=> "Testing A webhook",
                "to" => [
                    [
                        "name" => "Alex Li",
                        "email" => "alex.li@nylas.biz"
                    ]
                ],
               "tracking" => [
                            "links" => true,
                            "opens" => true,
                            "thread_replies" => true,
                            "payload" => "Any string you want!!"
                ]

];

$message = makeCurlRequest('/send', 'POST', $messagePayload, $token);
print(json_encode($message));

?>