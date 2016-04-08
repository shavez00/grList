<?php
require_once('core.php');

//clear user varible in case being used elsewhere
$user = NULL;

if (isset($_SESSION['login_user']))
 	$login_user = $_SESSION['login_user'];
	/*test to see what $login_user equals
	var_dump($login_user);
	exit;
	*/

try {
	$user = new users($login_user);
	/*var dump out $user object to see if user object is created correctly
	var_dump($user);
	exit;
	*/
	
	$userId = NULL;  //Used for Exception testing of getGrListId method
	
	$userId = $user->getUserId();
	/*see output of getUserId method
	var_dump($userId);
	exit;
	*/
	
	$grDbAccess = new grDbAccess();
	$grListId = NULL; //Used for Exception testing of getGrListId method
	$grListId = $grDbAccess->setGrListId($userId, "work");
	
	echo "</br><b>groceryList.php test</b></br>";
	
	echo "Registered Sessions</br>";
	echo "<pre>";
  print_r($_SESSION);
  echo "</pre></br>";
  /*exit to stop execution to see what's in the session
	exit;
	*/
	
	echo "User Id = $userId</br>";
	
	if ($user instanceof users) {
		echo "User object Green</br>";
	} else {
		echo "USER OBJECT IS RED!!!!!!!!!!!! - line # " . __LINE__ . "</br>";
	}

	if ($userId!==Null) {
		echo "UserId set is Green</br>";
	} else {
		echo "USERID SET IS RED!!!!!!!!!!!!!!!! - line # " . __LINE__ . "</br>";
	}
	
	if (isset($grListId)) {
	  echo "</br>grListId returned from setGrListId method = $grListId </br>";
	}  else {
	  echo "</br>grListId is not set by setGrListId method</br>";
	}
	

	if ($grListId!==Null && !empty($grListId)) {
		echo "setGrListId is set and is Green</br>";
		echo var_dump($grListId) . " = grListId</br>";
	} elseif (empty($grListId)) {
		echo "SETGRLISTID IS RED, IT IS NOT WORKING!!!!!!!!!!!!!!!!!!!!!!!!</br>";
	} else {
		echo "SETGRLISTID IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		echo var_dump($grListId) . " = grListId</br>";
	}
	
	$grListId = NULL;
  $grListId = $grDbAccess->getGrListId($userId);

  	if ($grListId!==Null && !empty($grListId)) {
		  echo "getGrListId method is working and is Green</br>";
		  echo"grList Id object/s:</br><pre>";
		   print_r($grListId);
		   echo" </pre></br>";
	  } elseif (empty($grListId)) {
		  echo "GRLISTID IS RED, IT IS EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo var_dump($grListId) . " = grListId</br>";
  	} else {
		  echo "GRLISTID IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}

$itemArray = ["item"=>NULL];

$result = NULL;
$result = $grDbAccess->setItem($itemArray);

  	if (!empty($result) && !empty($item)) {
		  echo "setItem method is working and is Green</br>";
		  echo"setItem object/s:</br><pre>";
		   print_r($result);
		   echo" </pre></br>";
	  } elseif (empty($result)) {
		  echo "SETITEM IS RED, IT IS EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo var_dump($item) . " = item</br>";
  	} else {
		  echo "SETITEM IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}
		
$grListItems = NULL;
$grListItems = $grDbAccess->getGrListItems($grListId[0]['grListId']);

  	if (!empty($grListItems) && !empty($grListId)) {
		  echo "getGrListItems method is working and is Green</br>";
		  echo"grListItems object/s:</br><pre>";
		   print_r($grListItems);
		   echo" </pre></br>";
	  } elseif (empty($grListItems)) {
		  echo "GRLISTITEMS IS RED, IT IS EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo var_dump($grListId[0]) . " = grListId</br>";
  	} else {
		  echo "GRLISTITEMS IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}
} catch (Exception $e) {
	echo $e->getMessage();
}




?>