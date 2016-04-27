<?php

require_once('core.php');

$user = array();

$user['email'] = "shavez00@";
$user['password'] = "morgan08";

$user = new users($user);
//$user->register();

echo "<b>This test is for the register method in the user class.  If the result is 1 then a new user was registered.  If the result is 2 then there is already an existing user.</b></br>";
echo "<b>RegisterUser.php test</b></br>";

$result = $user->register();

echo var_dump($result) . " = user register method result</br>";

if ($result==1) {
	echo "User Register Green</br>";
	} elseif($result==2) {
		echo "User Register - Existing User validation Green</br>";
	} else {
		echo "User Register Red</br>";
	}