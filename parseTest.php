<?php
require 'connectParse.php';

use Parse\ParseObject;
 
$testObject = ParseObject::create("TestObject");
$testObject->set("foo", "bar");
$testObject->save();

?>