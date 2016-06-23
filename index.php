<?php
try {
  if (session_status()==1) {
	  session_start();
  } elseif (session_status()==2) {
	  //do nothing session is staye started
  } else {
	  throw new Exception ("Session Start Error");
  }
} catch (Exception $e) {
  echo "Error in creating session on line " . __LINE__. " in file " . __FILE__ . "</br>";
  echo $e->getMessage() . "</br>";
  exit;
}

//removed because incorrect password is handled in login. php
//if (isset($_REQUEST['login']) && $_REQUEST['login'] == 0) echo "User login fail.  User with that email address exists.  Please check your password</br>";

if (!isset($_SESSION['login_user'])) include ("login.php");

if (isset($_SESSION['login_user'])) header("Location:grocerylist.php");

?>