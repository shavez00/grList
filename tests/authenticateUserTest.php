<?php

require_once('core.php');

$user = array();

if (isset($_REQUEST['email'])) $user['email'] = validator::testInput($_REQUEST['email']);
if (isset($_REQUEST['password'])) $user['password']= validator::testInput($_REQUEST['password']);

$user['email'] = "shavez00@yahoo.com";
$user['password'] = "morgan08";

$user = new users($user);
$userLogin = $user->userLogin();

echo "<b>AuthenticateUser.php test</b></br>";

if ($user instanceof users) {
  echo "User object Green</br>";
  echo "</br><pre>";
  print_r($user);
  echo "</pre></br>";
} else {
  echo "User object Red</br>";
}

if ($userLogin) {
	echo "User Login Green</br>";
	echo "</br><pre>";
  print_r($userLogin);
  echo "</pre></br>";
	} else {
		echo "User Login Red</br>";
	}