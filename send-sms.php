<?php
 
require "vendor/twilio/sdk/Services/Twilio.php";
 
// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "ACb96a18da857931b850c16568a0275715";
$AuthToken = "a4f4afdaa4f80f87e50d816b2ce7db9f";
 
$client = new Services_Twilio($AccountSid, $AuthToken);
 
$message = $client->account->messages->create(array(
    "From" => "+16307967918",
    "To" => "+13306714458",
    "Body" => "Test message!",
));
 
// Display a confirmation message on the screen
//echo "Sent message {$message->sid}";
?>