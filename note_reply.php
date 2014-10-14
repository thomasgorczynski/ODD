<?php

require 'connectParse.php'; 
use Parse\ParseQuery;
use Parse\ParseObject;

$output = json_encode(array('type'=>'note_error', 'text' => 'Input field is empty!'));
		die($output);

if($_POST)
{
    

	//check $_POST vars are set, exit if any missing
	if(!isset($_POST["noteReply"]) ) )
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
	$adminReply        = filter_var($_POST["noteReply"], FILTER_SANITIZE_STRING);
	

    ////Send confirmation text////
    /////////////////////////////
    
    $adminReply = str_replace('&#39;',"'",$adminReply);
    $adminReply = str_replace(';',"",$adminReply);
    
    //insert ADMIN message into database 
    $message = new ParseObject("Notes");
    $message->set("content",$adminReply);
    $message->set("chatroom", $userID); //sets chatroom numbe
    $message->save();
   
    
    if (!$sms) {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not save note!'));
		die($output);
    }
    
    else{
		$output = json_encode(array('type'=>'message', 'text' => "Note saved!"));
		die($output);
	}

}
?>

