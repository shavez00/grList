<?php

//should refactor to use switch instead of if.
//should refactor to set error code in the beginning and then insert it in each of the header statements instead of hardcoding

require_once('core.php');

$user = array();

if (isset($_REQUEST['email'])) $user['email'] = validator::testInput($_REQUEST['email']);
if (isset($_REQUEST['password'])) $user['password']= validator::testInput($_REQUEST['password']);
if (isset($_REQUEST['password'])) $password = validator::testInput($_REQUEST['password']);
if (isset($_REQUEST['passwordConfirm'])) $passwordConfirm = validator::testInput($_REQUEST['passwordConfirm']);

$validEmail = preg_match("/(.*@[a-zA-Z0-9]*\.)+((net)|(org)|(com))/", $user["email"]);

if ($validEmail == 0) {
  header('Location:login.php?error=5');
  exit;
}	

if ($_REQUEST['email'] == NULL) {
  header('Location:login.php?error=5');
  exit;
}
if ($_REQUEST["password"]!=NULL) {
	
if (isset($passwordConfirm)) {
	if ($password == NULL || $passwordConfirm == NULL) header('Location:login.php?error=3&email=' . $user["email"]);
  if (strcmp($password, $passwordConfirm) !== 0) header("Location:login.php?error=3&email=" . $user["email"]);
  if (strcmp($password, $passwordConfirm) == 0) $registerUser = new users($user);
  $registerNewUser = $registerUser->register();
}

$users = new users($user);
$loginSuccess = $users->userLogin();

var_dump($loginSuccess);
//exit;

if ($loginSuccess == 1) {
  header("Location:index.php");
  exit;
}

//password is incorrect
if ($loginSuccess == 2) {
  header("Location:login.php?error=2&email=" . $user["email"]);
  exit;
}

//user does not exist
if ($loginSuccess == 0) {
	header('Location:login.php?error=0&email=' . $user["email"]);
  exit;
}

//removed because code above now deals with correct and incorrect password, no need to defer to index.php anymore
//if ($registerNewUser==1) header("Location:index.php");
//if ($registerNewUser==2) header("Location:index.php?login=0");

echo "ERROR IN " . __FILE__ . " AT " . __LINE__;
} else {
  header('Location:login.php?error=4&email=' . $user["email"]);
}
