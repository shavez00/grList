<?php

require_once('core.php');

$user = array();

if (isset($_REQUEST['email'])) $user['email'] = validator::testInput($_REQUEST['email']);
if (isset($_REQUEST['password'])) $user['password']= validator::testInput($_REQUEST['password']);

$user = new users($user);
$loginSuccess = $user->userLogin();

if ($loginSuccess) header("Location:index.php");

$registerNewUser = $user->register();

if ($registerNewUser==1) header("Location:index.php");

if ($registerNewUser==2) header("Location:index.php?login=0");

echo "ERROR IN " . __FILE__ . " AT " . __LINE__;
