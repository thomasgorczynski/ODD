<?php
require "vendor/twilio/sdk/Services/Twilio.php";
require 'connectTwilio.php';    
require 'connectParse.php'; //PARSE LIBRARY
    use Parse\ParseObject; //object class
    use Parse\ParseQuery; //object class


	echo '<?xml version="1.0" encoding="UTF-8" ?>';
    
    //Thomas fill in these//
    $authCode = 'gypsy';
    $congratsMessage = "BOOM!!! You're human! My name is Alice. I'll help guide you towards unique and undiscovered experiences in Cincinnati. BUT, before we can go any further... 
You've been invited to meet me, personally, at an undisclosed location in OTR. Off the menu drinks have been prepared for your arrival. If interested, reply 'YES' or 'NO' — I suggest you say 'HELL YES'!";
    $userSentWrongAuthCodemessage = "Sorry I didnt understand that! If you are human, respond with 'gypsy'";
    $repeatResponse = 'Looks like you have already activated Alice!!';
    $unsubscribe = 'peace out';  
    $unsubscribeResponse = 'Well you are lame.'; 
    //Thomas fill in these//

    //user info grabbed from twilio api
    $userPhone = $_REQUEST['From'];
	$content = $_REQUEST['Body'];
    $twilioPhone = $_REQUEST['To']; //

    //Query for the Texter ID based on phone number
    $query = new ParseQuery("Patients");
    $query->equalTo("phone", $userPhone);
    $results = $query->find();
    $currentUser = $results[0]; //set an object as the current user
    $userID=$currentUser->getObjectId();      //get the id of the current user
    
    $adminObject = new ParseObject("Patients", 'SubDMbKjkU'); //get the object of the admin id:SubDMbKjkU
    
    $check = $currentUser->get("auth"); //gets the auth number from parse
    
    if($check==1){
        //you are authed so just record message in parse
        $message = new ParseObject("Messages");
        $message->set("content",$content);
        $message->set("texter", $currentUser);
        $message->set("receiver", $adminObject); //<- make this an object of type Texter. 
        $message->set("chatroom", $userID);
        $message->save();
    
     //TWILIO - TESTED AND WORKS - MESSAGE IS SENT TO USER
        $message = $client->account->messages->create(array(
            "From" => '+13126464724',
            "To" => '+18472261310',
            "Body" => 'Thomas! Someone sent you a text. Time to respond AF'));

      
        echo '<Response>';
        echo '</Response>';
    }
    

    if($check==0){
        //you are not authed 
        $response = 'default';
        $success = false;
    
        // Check if we've got good data
        if ( (strlen($userPhone) >= 10) && (strlen($content) >= 1) ) {
            // Check if they are to be verified
            if ( strcasecmp($content, $authCode ) == 0 ) {
                $success = true;
            }

            // Check if they are to be unsubscribed
            elseif ( strcasecmp($content, $unsubscribe) == 0 ) {
                $response = $unsubscribeResponse;
                $success = true;
            }

            else {
                    $response = $userSentWrongAuthCodemessage;
                    $success = false;
            }     
        }
        else {
            $response = $userSentWrongAuthCodemessage;
            $success = false;
        }

        //get the user name from our database
        $user_name = $currentUser->get("name");
    
        echo '<Response>'; //Begin the response
        echo '<Message>';

        if ( $success ) {
             
             $response = $congratsMessage;
            // Authenticate the insert
            $currentUser->set("auth", 1); //ARE WE DOING AN AUTH?
            $currentUser->set("chatroom", $userID);
            $currentUser->save();
        }
        echo $response . '</Message>';
        echo '</Response>';
    }

?>