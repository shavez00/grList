<?php

require_once('core.php');

if ($_REQUEST['email']) $email = validator::testInput($_REQUEST['email']);
if ($_REQUEST['password']) $password = validator::testInput($_REQUEST['password']);
$password = password_hash($password, PASSWORD_DEFAULT);

echo "email = $email<br>";
echo "password = $password<br>";