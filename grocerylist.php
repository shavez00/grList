<?php

include_once('core.php');

if (!isset($_SESSION['login_user'])) header("Location:index.php");

$userId = (int)validator::testInput($_SESSION['login_user']['userId']);

$grDbAccess = new grDbAccess();
$grListId = $grDbAccess->getGrListId($userId);

if(empty($_REQUEST)) {
  if (isset($_SESSION)) {
  	if(isset($_SESSION['login_user'])) { 
	  	if(!empty($grListId)) {
		  	echo "Which Grocery List would you like to use?";
        foreach ($grListId as $grList) {
	       $name = $grList['grName'];
	       $listId = $grList['grListId'];
	       $url = "grocerylist.php?grName=$name&grListId=$listId";
		      echo "</br><a href=$url>$name</a></br>";
        } 
      }  else {
	      echo <<<EOT
<!DOCTYPE HTML>
<html>
	<head>
	  <title>Grocery List</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	  <meta name="description" content="The HTML5 Herald"> 
		<meta name="author" content="SitePoint"> 
		<link rel="stylesheet" href="css/styles.css?v=1.0"> 
		<!--[if lt IE 9]> 
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
		<![endif]--> 
  </head> 
<body> 
  <script src="js/scripts.js"></script> 
  <form action="createList.php" method="post">
    Create grocery list: </br>
    Grocery list name: <input type="text" name="grName"></input></br>
    <br></br>
    <input type="submit" value="Create"></input>
  </form>
</body>
</html>
EOT;
	    }
    }
  }
  exit;
}

$grListId = NULL;

if (isset($_REQUEST['grListId'])) {
  $grListId = (int)validator::testInput($_REQUEST['grListId']);
  $_SESSION["grListId"] = $grListId;
} else {
  $grListId = (int)validator::testInput($_SESSION['grListId']);
}

/*
echo "<pre>";
var_dump($items);
echo "</pre>";
exit;
*/
//var_dump($_REQUEST);
if (empty($_REQUEST["item"])) {
echo <<<EOT
<!DOCTYPE HTML>
<html>
	<head>
	  <title>Grocery List</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	  <meta name="description" content="The HTML5 Herald"> 
		<meta name="author" content="SitePoint"> 
		<link rel="stylesheet" href="css/styles.css?v=1.0"> 
		<!--[if lt IE 9]> 
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
		<![endif]--> 
  </head> 
<body> 
  <script src="js/scripts.js"></script> 
  <form action="addItem.php" method="post">
    Add item to list: </br>
    item name: <input type="text" name="item"></input></br>
    quantity of items: <input type="number" name="qty"></input></br>
    measure: <input type="text" name="measure"></input></br>
    <br></br>
    <input type="submit" value="Add"></input>
  </form>
</body>
</html>

EOT;
}

$items = $grDbAccess->getGrListItems($grListId);
$count = 0;

echo "</br>Items on grocery list</br>";

foreach ($items as $item) {
	$count = $count + 1;
  $itemDesc = $grDbAccess->getItem($item["itemId"]);
  echo $count . ". " . $itemDesc["item"] . " " . $item["qty"] . " " . $itemDesc["measure"] . "<a href=removeItem.php?itemId=" . $itemDesc["itemId"] . "> remove</a>";
  echo "</br>";
}