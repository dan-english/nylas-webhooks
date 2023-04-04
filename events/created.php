<?php
$challenge_parameter = (isset($_GET["challenge"]) ? $_GET["challenge"] : null);

if ($challenge_parameter) {
  header('content-type: text/plain');
  echo  trim($challenge_parameter);
  exit();
}

# For extra security we should check the header for X-Nylas-Signature
# @todo https://developer.nylas.com/docs/developer-tools/webhooks/#verify-nylas-webhooks

# Now process the payload for the webhook


print ('Event Created Webhook');

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);
$file=$event_base."/nylas-event-created.log";
file_put_contents($file, json_encode($data).PHP_EOL, FILE_APPEND | LOCK_EX);



?>
