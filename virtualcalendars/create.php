<?php
include_once("../includes.php");
/**
https://nylas-webhook.dev-site.io/create-virtual-calendar
**/

$test_email = "test_account_".rand();

$output = [
    'process' => 'Create Virtual Account & Calendar',
    'email_address' => $test_email
];

$auth_payload = [
            "client_id" => $client_id,
            "provider"=> "nylas",
            "scopes"=> "calendar",
            "email"=> $test_email,
            "name"=> "Virtual Calendar",
            "settings"=> ["a"=>"1"]
        ];

$code = makeCurlRequest('/connect/authorize','POST', $auth_payload);

if($code['code']) {
    $output['code'] = $code['code'];

    $token_payload = [
        "client_id" => $client_id,
        "client_secret"=> $client_secret,
        "code"=> $code['code']
    ];

    $token  = makeCurlRequest('/connect/token', 'POST', $token_payload);
    $output['nylas_access_token'] = $token['access_token'];
    $output['nylas_account_id'] = $token['account_id'];

    if($token['access_token']) {
    // Create a calendar on this Virtual Account
        $calendar_payload = [
            "name" => "My Virtual Calendar",
            "description" => "My Virtual Calendar Description",
            "location" => "Metaverse",
            "timezone" => "Europe/London",
        ];

        $calendar = makeCurlRequest('/calendars', 'POST', $calendar_payload, $token['access_token']);
        $output['calendar_id'] = $calendar['id'];

        if ($calendar['id']) {

            $event_payload = [
                 "title"=>"Example Event",
                 "calendar_id"=> $calendar['id'],
                 "when" => [
                        "start_time"=> time(),
                        "end_time"=> time()
                 ],
                "location"=> "Coffee Shop",
                "participants"=> [
                    [
                        "email"=> "nylatest2@nylatest.onmicrosoft.com",
                        "name"=> "Sarah Nylanaut"
                    ]
                ]
             ];

            $event = makeCurlRequest('/events', 'POST', $event_payload, $token['access_token']);
            $output['event_id'] = $event['id'];
            print(json_encode($output));

        }
    }
}
?>
