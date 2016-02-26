<?php

require_once('core.php');

$user = array();

if ($_REQUEST['email']) $user['email'] = validator::testInput($_REQUEST['email']);
if ($_REQUEST['password']) $user['password']= validator::testInput($_REQUEST['password']);

$user = new users($user);
$user->register();

var_dump($user);