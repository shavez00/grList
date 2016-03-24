<?php

if (!isset($_SESSION['login_user'])) header("Location:index.php");

var_dump($_SESSION);

?>