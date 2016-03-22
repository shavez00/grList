<?php

require_once('core.php');

$user = array();

if (isset($_REQUEST['email'])) $user['email'] = validator::testInput($_REQUEST['email']);
if (isset($_REQUEST['password'])) $user['password']= validator::testInput($_REQUEST['password']);

$user['email'] = "shavez00@yahoo.com";
$user['password'] = "morgan08";

$user = new users($user);
$userLogin = $user->userLogin();

echo "AuthenticateUser.php test</br>";

if (!$userLogin) header("Location:../registration.html");

if ($user instanceof users) {
  echo "User object Green</br>";
} else {
  echo "User object Red</br>";
}

if ($userLogin) {
	echo "User Login Green</br>";
	} else {
		echo "User Login Red</br>";
	}