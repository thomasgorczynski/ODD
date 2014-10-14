<?php
require "vendor/twilio/sdk/Services/Twilio.php";
require 'connectTwilio.php';
require 'connectParse.php'; 
use Parse\ParseObject;

if($_POST)
{
    
  //Sanitize input data using PHP filter_var().
	$user_Name        = $_POST["userName"];
	$user_Phone       = $_POST["userPhone"];
  $user_Phone = chr(43) . "1" . $user_Phone; 
  $twilio_num       = '+13126464724';
  
  $text = "Hey " . $user_Name . ", thanks for signing up with ODD! So I know for sure that you are human, respond with 'gypsy'"; 

  //TWILIO - TESTED AND WORKS - MESSAGE IS SENT TO USER
  $message = $client->account->messages->create(array(
      "From" => $twilio_num,
      "To" => $user_Phone,
      "Body" => $text));


  //Parse - TESTED AND WORKS - USER INFO ENDERED INTO PARSE
  $texter = new ParseObject("Patients");
  $texter->set("name", $user_Name);
  $texter->set("phone", $user_Phone);
  $texter->set("auth", 0); //ARE WE DOING AN AUTH?
  $texter->save();

    //output message to the user//
  if (!$message) {
    $output = json_encode(array('type'=>'error', 'text' => 'Could not send text message!'));
    die($output);
  }

  else{
    $output = json_encode(array('type'=>'message', 'text' => "Hi"));
    die($output);
  }

    
    
}
?>

