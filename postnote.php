<?php
require 'connectParse.php'; 
use Parse\ParseQuery;
use Parse\ParseObject;

$note = $_POST["note_reply"];

$userID = $_POST["id"]; // We get the darn user ID here
$userName = $_POST["name"];


$message = new ParseObject("Notes");
    $message->set("content",$note);
    $message->set("userID", $userID); //sets chatroom numbe
    $message->save();

header("Location: http://odd.seanandthomas.com/conversation11.php?id=" . $userID . "&name=" . $userName);

?>