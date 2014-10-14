<?php

require 'connectParse.php'; 

use Parse\ParseClient;
use Parse\ParseUser;
use Parse\ParseSessionStorage;
session_start();

echo $_SESSION['test'];
 
$currentUser = ParseUser::getCurrentUser(); 
print_r( $currentUser . "he" );

?>