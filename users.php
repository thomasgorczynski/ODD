<?php
require 'connectParse.php'; //PARSE LIBRARY
  use Parse\ParseQuery; //object class
  use Parse\ParseUser;


    //get info from Texters where auth is 1
    $query = new ParseQuery("Patients");
    $query->equalTo("auth", 1);
    $results = $query->find();

    // Do something with the returned ParseObject values
    for ($i = 0; $i < count($results); $i++) { 
        $object = $results[$i];
        $userID = $object->getObjectId();
        $userName = $object->get("name");
        $userPhone = $object->get("phone");
        $twilioPhone = '+13126464724';

        //Add code for indicator
        //get messages for the current user in the loop
        $chatroom = $userID;
        $query = new ParseQuery("Messages"); //new query
        $query->equalTo("chatroom", $chatroom); //return all of the messages that are in the current chatroom
        $query->descending("createdAt"); //sort by time
        $lastMessageObject = $query->first();
        $lastMessageObject->fetch();
        $lastMessageSenderObject = $lastMessageObject->get("texter");
        $lastMessageSenderObject->fetch();
        $lastMessageSenderPhone = $lastMessageSenderObject->get("phone");

        if($lastMessageSenderPhone != $twilioPhone){
          //show indicator
          echo '***Go To Conversation: <a href="http://odd.seanandthomas.com/conversation11.php?id=' . $userID . '&name=' . $userName . '"> '. $userName . '</a></br>';
        } else{
          echo 'Go To Conversation: <a href="http://odd.seanandthomas.com/conversation11.php?id=' . $userID . '&name=' . $userName . '"> '. $userName . '</a></br>';
        }
      }

  

?>