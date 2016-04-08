<?php

require_once('core.php');

$user = array();

if (isset($_REQUEST['email'])) $user['email'] = validator::testInput($_REQUEST['email']);
if (isset($_REQUEST['password'])) $user['password']= validator::testInput($_REQUEST['password']);

$user['email'] = "shavez00@yahoo.com";
$user['password'] = "morgan08";

$user = new users($user);
//$user->register();

echo "<b>RegisterUser.php test</b></br>";

if ($user instanceof users) {
  echo "User object Green</br>";
} else {
  echo "User object Red</br>";
}

$result = $user->register();

if ($result==1) {
	echo "User Register Green</br>";
	} elseif($result==2) {
		echo "User Register - Existing User validation Green</br>";
	} else {
		echo "User Register Red</br>";
	}
	
//$userExists = $user->register();