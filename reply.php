<?php

/// SEND INITIAL TEXT MESSAGE, INSERT INTO DATABASE, AND EXIT WITH SUCCESS
require "vendor/twilio/sdk/Services/Twilio.php";
require 'connectTwilio.php';
require 'connectParse.php'; 
use Parse\ParseQuery;
use Parse\ParseObject;

if($_POST)
{
    
    //get twilio number from the TexterObject?
    //maybe get the user id from the url and query the object
    //hard code it in for now
    $twilioNumber = '+13126464724';         //assign the twilio number that OTP will be sending from
    
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	
		//exit script outputting json data
		$output = json_encode(
		array(
			'type'=>'error', 
			'text' => 'Request must come from Ajax'
		));
		
		die($output);
    } 
	
	//check $_POST vars are set, exit if any missing
	if(!isset($_POST["otpReply"]) || !isset($_POST["userPhone"]) )
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Input field is empty!'));
		die($output);
	}
    
    if(!isset($_POST["userID"]) )
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
		die($output);
	}

	$userID = $_POST["userID"]; // We get the darn user ID here

	//Sanitize input data using PHP filter_var().
	$adminReply        = filter_var($_POST["otpReply"], FILTER_SANITIZE_STRING);
    $userPhone        = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);
	

    ////Send confirmation text////
    /////////////////////////////
    
    $adminReply = str_replace('&#39;',"'",$adminReply);
    $adminReply = str_replace(';',"",$adminReply);
    $sms = $client->account->messages->sendMessage($twilioNumber, $userPhone, $adminReply);
 
    //set object for the recipient
    $texterObject = new ParseObject("Patients", $userID);
    $adminObject = new ParseObject("Patients", 'SubDMbKjkU');
    
    //insert ADMIN message into database 
    $message = new ParseObject("Messages");
    $message->set("content",$adminReply);
    $message->set("texter", $adminObject); //<- make this an object of type Texter.
    $message->set("receiver", $texterObject);  //<-make this an object of type Texter too
    $message->set("chatroom", $userID); //sets chatroom numbe
    $message->save();
   
    
    if (!$sms) {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send text message!'));
		die($output);
    }
    
    else{
		$output = json_encode(array('type'=>'message', 'text' => "Message sent! "));
		die($output);
	}

}
?>

