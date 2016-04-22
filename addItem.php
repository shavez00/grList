<?php

include_once("core.php");

if (!isset($_SESSION['login_user'])) header("Location:index.php");

$userId = (int)validator::testInput($_SESSION['login_user']['userId']);

$grDbAccess = new grDbAccess();

$grListId = (int)$_SESSION["grListId"];

if (isset($_REQUEST["item"]))$items = $grDbAccess->setItem($_REQUEST);

if (is_array($items)) {
  foreach ($items as $item) {
	       $name = $item['item'];
	       $itemId = $item['itemId'];
	       $url = "addItem.php?itemName=$name&itemId=$itemId";
		      echo "</br><a href=$url>$name</a></br>";
        }
}


if (!empty($_REQUEST["itemName"])) {
	
	$result = $grDbAccess->addItemToList($_SESSION["grListId"],$_REQUEST["itemId"]);

	header("Location:grocerylist.php");
}
?>