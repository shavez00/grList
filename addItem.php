<?php

include_once("core.php");

if (!isset($_SESSION['login_user'])) header("Location:index.php");

if (empty($_REQUEST['item']) && empty($_REQUEST["itemName"])) header("Location:grocerylist.php");


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
	       $url = "addItem.php?itemName=" . urlencode($name) . "&itemId=$itemId&qty=" . urlencode($qty);
		      echo "</br><a href=$url>$name</a></br>";
        }
} elseif(isset($items)) {
	$grDbAccess->addItemToList($grListId, $items, $qty);
	 header("Location:grocerylist.php?additem=true");
}


if (!empty($_REQUEST["itemName"])) {
	$result = $grDbAccess->addItemToList($_SESSION["grListId"],$_REQUEST["itemId"], $qty);
	header("Location:grocerylist.php");
}
?>