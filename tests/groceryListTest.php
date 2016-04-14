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
		
	echo "</br><b>This tests the grDbAccess class and it's methods</b></br>";
	
	echo "</br><b>groceryList.php test</b></br>";
	
	echo "Data in the currently active Sessions</br>";
	echo "<pre>";
  print_r($_SESSION);
  echo "</pre></br>";
  /*exit to stop execution to see what's in the session
	exit;
	*/
	
	echo "User Id = $userId</br>";
	
	if ($userId!==Null) {
		echo "getUserId method is Green</br>";
	} else {
		echo "GETUSERID METHOD IS RED!!!!!!!!!!!!!!!! - line # " . __LINE__ . "</br>";
	}
	
	$grDbAccess = new grDbAccess();
	$grListId = NULL; //Used for Exception testing of getGrListId method
	$grListId = $grDbAccess->setGrListId($userId, "work");

	if (isset($grListId)) {
	  echo "</br>grListId returned from setGrListId method = $grListId </br>";
	  echo var_dump($grListId) . " = grListId returned from setGrListId method</br>";
	}  else {
	  echo "</br>grListId is not set by setGrListId method</br>";
	  echo var_dump($grListId) . " = grListId returned from setGrListId method</br>";
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

$itemArray = ["item"=>"juice", "measure"=>"size"];

$result = NULL;
$result = $grDbAccess->setItem($itemArray);

  	if (!empty($result) && !empty($itemArray)) {
		  echo "setItem method is working and is Green</br>";
		  echo"setItem itemId:</br><pre>";
		   print_r($result);
		   echo" </pre></br>";
	  } elseif (empty($result)) {
		  echo "SETITEM IS RED, IT IS EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo var_dump($itemArray) . " = item</br>";
  	} else {
		  echo "SETITEM IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}
		
$grListItems = NULL;
$itemId = NULL;
$itemId = (int)$result[0]["itemId"];
$grListId2 = (int)$grListId[0]["grListId"];
$grListItems = $grDbAccess->addItemToList($grListId2, $itemId);

  	if (!empty($grListItems) && !empty($grListId)) {
		  echo "addItemToList method is working and is Green</br>";
		  echo "addItemToList result:</br><pre>";
		   print_r($grListItems);
		   echo" </pre></br>";
	  } elseif (empty($grListItems)) {
		  echo "ADDITEMTOLIST IS RED, IT IS EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo var_dump($grListId2) . " = grListId</br>";
		  echo var_dump($itemId) . " = itemId</br>";
		  echo var_dump($grListItems) . " = itemId</br>";
  	} else {
		  echo "ADDITEMTOLIST IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}
		
echo "<br>";
		
$grListItems = NULL;
$grListItems = $grDbAccess->getGrListItems($grListId[0]['grListId']);

  	if (!empty($grListItems) && !empty($grListId)) {
		  echo "getGrListItems method is working and is Green</br>";
		  echo"grListItems object/s:</br><pre>";
		   print_r($grListItems);
		   echo" </pre></br>";
	  } elseif (empty($grListItems)) {
		  echo "GRLISTITEMS IS RED, IT IS EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo "<pre>";
		  echo var_dump($grListId[0]) . " = grListId</br>";
		  echo "</pre>";
  	} else {
		  echo "GRLISTITEMS IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}
		
$itemId = 2;
$item = $grDbAccess->getItem($itemId);

  	if (!empty($itemId) && !empty($item)) {
		  echo "getItem method is working and is Green</br>";
		  echo"getItem object/s:</br><pre>";
		   print_r($item);
		   echo" </pre></br>";
	  } elseif (empty($item)) {
		  echo "GETITEM METHOD IS RED, IT IS EMPTY!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		  echo "<pre>";
		  echo var_dump($item) . " = item</br>";
		  echo "</pre>";
  	} else {
		  echo "GETITEM METHOD IS RED!!!!!!!!!!!!!!!!!!!!!!!!</br>";
		}
} catch (Exception $e) {
	echo $e->getMessage();
}




?>