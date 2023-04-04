<?php
require_once('../includes.php');

$challenge_parameter = (isset($_GET["challenge"]) ? $_GET["challenge"] : null);

if ($challenge_parameter) {
  header('content-type: text/plain');
  echo  trim($challenge_parameter);
  exit();
}

# For extra security we should check the header for X-Nylas-Signature
# @todo https://developer.nylas.com/docs/developer-tools/webhooks/#verify-nylas-webhooks

# Now process the payload for the webhook

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

$message_id = $data['deltas'][0]['object_data']['id'];

## this will only return a valid response if you're requesting a message from the owner of the access token
## it will attempt to get a message from _any_ account that has a message updated
$message = getMessageById($message_id, $token, $nylas_api_server);


$file = $message_base."/nylas-message-updated.log";

file_put_contents($file, "*****************************************".PHP_EOL, FILE_APPEND | LOCK_EX);
file_put_contents($file, json_encode($message['subject']).PHP_EOL, FILE_APPEND | LOCK_EX);
file_put_contents($file, json_encode($data).PHP_EOL, FILE_APPEND | LOCK_EX);
file_put_contents($file, "*****************************************".PHP_EOL, FILE_APPEND | LOCK_EX);

?>
