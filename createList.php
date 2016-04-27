<?php
include_once("core.php");

if (!isset($_SESSION['login_user'])) header("Location:index.php");

$grName = validator::testInput($_REQUEST["grName"]);
$userId = (int)validator::testInput($_SESSION["login_user"]["userId"]);

$grDbAccess = new grDbAccess();

$grListId= $grDbAccess->setGrListId($userId, $grName);

header("Location:grocerylist.php?grListId=$grListId");
?>