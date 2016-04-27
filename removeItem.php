<?php
include_once("core.php");

if (!isset($_SESSION['login_user'])) header("Location:index.php");

$itemId = (int)validator::testInput($_REQUEST['itemId']);
$grListId = (int)validator::testInput($_SESSION['grListId']);

$grDbAccess = new grDbAccess();

$result = $grDbAccess->removeItemFromList($grListId, $itemId);

header("Location:grocerylist.php?remove=true");

?>