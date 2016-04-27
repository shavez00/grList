<?php

include_once("core.php");

if (!isset($_SESSION['login_user'])) header("Location:index.php");

if (empty($_REQUEST['item'])) header("Location:grocerylist.php");


$userId = (int)validator::testInput($_SESSION['login_user']['userId']);

$qty = validator::testInput($_REQUEST["qty"]);

if (isset($_REQUEST["itemId"])) $itemId = (int)validator::testInput($_REQUEST["itemId"]);

$grDbAccess = new grDbAccess();

$grListId = (int)$_SESSION["grListId"];

if (isset($_REQUEST["item"]))$items = $grDbAccess->setItem($_REQUEST);

if (isset($items) && is_array($items)) {
  foreach ($items as $item) {
	       $name = $item['item'];
	       $itemId = $item['itemId'];
	       $url = "addItem.php?itemName=$name&itemId=$itemId&qty=$qty";
		      echo "</br><a href=$url>$name</a></br>";
        }
} else {
	$grDbAccess->addItemToList($grListId, $itemId, $qty);
  header("Location:grocerylist.php?additem=true");
}


if (!empty($_REQUEST["itemName"])) {
	
	$result = $grDbAccess->addItemToList($_SESSION["grListId"],$_REQUEST["itemId"]);

	header("Location:grocerylist.php");
}
?>