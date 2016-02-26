<?php

require_once('core.php');

$user = array();

if ($_REQUEST['email']) $user['email'] = validator::testInput($_REQUEST['email']);
if ($_REQUEST['password']) $user['password']= validator::testInput($_REQUEST['password']);

$user = new users($user);
$userExists = $user->register();

if ($userExists == 2) header("Location: registration.php?userExists=1");