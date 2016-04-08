<?php

include_once('core.php');

if (!isset($_SESSION['login_user'])) var_dump($_SESSION);

$userId = (int)validator::testInput($_SESSION['login_user']['userId']);

$grDbAccess = new grDbAccess();
$grListId = $grDbAccess->getGrListId($userId);


if(empty($_REQUEST)) {
  if (isset($_SESSION)) {
  	if(isset($_SESSION['login_user'])) { 
	  	if($grListId !== NULL) {
		  	echo "Which Grocery List would you like to use?";
        foreach ($grListId as $grList) {
	       $name = $grList['grName'];
	       $listId = $grList['grListId'];
	       $url = "grocerylist.php?grName=$name&grListId=$listId";
	       echo "</br><a href=$url>$name</a></br>";
        }
      }
    }
  }
  exit;
}

$grListId = NULL;

if (isset($_REQUEST['grListId'])) $grListId = (int)validator::testInput($_REQUEST['grListId']);

$items = $grDbAccess->getGrListItems($grListId);
var_dump($items);

?>