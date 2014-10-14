<?php
require 'connectParse.php'; 
use Parse\ParseClient;
use Parse\ParseUser;
use Parse\ParseSessionStorage;

session_start();

// set session storage
ParseClient::setStorage( new ParseSessionStorage() );

$user_Name = $_POST["userName"];
$user_Pass = $_POST["userPass"];

try {
  $user = ParseUser::logIn($user_Name, $user_Pass);
  
  echo "works!";

  // Do stuff after successful login.
} catch (ParseException $error) {
  // The login failed. Check error to see why.
  echo "FAIL";
}

    $currentUser = ParseUser::getCurrentUser();
//$currentUser = $currentUser->get("username");
print_r( $currentUser);

$_SESSION['test'] = 42;
$test = 43;
echo $_SESSION['test'];

if (isset($_SESSION['test']))
{
    echo '<p>hell yaaa</p>';
}
else {
  echo '<p>shit</p>';
}
/*
require 'connectParse.php'; 

use Parse\ParseClient;
use Parse\ParseUser;
use Parse\ParseSessionStorage;

session_start();


// set session storage
ParseClient::setStorage( new ParseSessionStorage() );

try {
  $user = ParseUser::logIn("user", "pass");
  // Do stuff after successful login.
} catch (ParseException $error) {
  // The login failed. Check error to see why.
}

$currentUser = ParseUser::getCurrentUser();
$currentUser = $currentUser->get("username");
echo $currentUser;

<a href="/logout.php">logout</a>

*/

?>

<a href="/logout.php">logout</a>
