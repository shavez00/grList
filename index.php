<?php
try {
  if (session_status()==1) {
	  session_start();
  } else {
	  throw new Exception ("Session Start Error");
  }
} catch (Exception $e) {
  echo "Error in creating session on line " . __LINE__. " in file " . __FILE__ . "</br>";
  echo $e->getMessage() . "</br>";
  exit;
}

if (isset($_REQUEST['login']) && $_REQUEST['login'] == 0) echo "User login fail.  User with that email address exists.  Please check your password</br>";

if (!isset($_SESSION['login_user'])) include ("login.html");

if (isset($_SESSION['login_user'])) header("Location:grocerylist.php");

?>