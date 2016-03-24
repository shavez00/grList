<?php
require_once('core.php');

try {
	if (session_status()==1) {
		session_start();
 	} else {
		throw new Exception ("Session Start Error");
 	}
}
 catch (Exception $e) {
	echo "Error in the Users object register method, line " . __LINE__. "</br>";
 	echo $e->getMessage() . "</br>";
 	exit;
}

if (isset($_SESSION['login_user']))
 	$user['email'] = validator::testInput($_SESSION['login_user']);

try {
	$user = new users($user);
	$userId = NULL;  //Used for Exception testing of getGrListId method
	$userId = $user->getUserId();
	$grDbAccess = new grDbAccess();
	$grListId = NULL; //Used for Exception testing of getGrListId method
	$grListId = $grDbAccess->setGrListId($userId, "home");
	
	echo "groceryList.php test</br>";
		
	echo "User Id = $userId</br>";
	
	  echo "grListId returned from setGrListId method = $grListId </br>";

	if ($user instanceof users) {
		echo "User object Green</br>";
	} else {
		echo "USER OBJECT IS RED!!!!!!!!!!!!</br>";
	}

	if ($userId!==Null) {
		echo "UserId set is Green</br>";
	} else {
		echo "USERID SET IS RED!!!!!!!!!!!!!!!!</br>";
	}

	if ($grListId!==Null && !empty($grListId)) {
		echo "setGrListId is set and is Green</br>";
		echo var_dump($grListId) . " = grListId</br>";
	} elseif (empty($grListId)) {
		echo "SETGRLISTID IS RED, IT IS NOT WORKING!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		echo var_dump($grListId) . " = grListId</br>";
	} else {
		echo "SETGRLISTID IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
	}
	
	$grListId = NULL;
  $grListId = $grDbAccess->getGrListId($userId);

  	if ($grListId!==Null && !empty($grListId)) {
		  echo "grListId is set and is Green</br>";
		  echo "<pre>" . var_dump($grListId) . "</pre></br>";
	  } elseif (empty($grListId)) {
		  echo "GRLISTID IS RED, IT IS NOT EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo var_dump($grListId) . " = grListId</br>";
  	} else {
		  echo "GRLISTID IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}
} catch (Exception $e) {
	echo $e->getMessage();
}





?>