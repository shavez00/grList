<?php

session_start(); 

session_unset();
setcookie('login_user', "", time() - 3600);
unset($_COOKIE['login_user']);

?>