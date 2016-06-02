<?php

include_once('core.php');
include('header.php');

if (!isset($_SESSION['login_user'])) header("Location:index.php");

echo '<div class="container">
            <div style="float: left"><h6><a href=session.php>Log out</a></h6></div>
            <div style="float: right"><h6><a href=grocerylist.php>Select different list</a></h6></div>
          </div>';

$userId = (int)validator::testInput($_SESSION['login_user']['userId']);

$grDbAccess = new grDbAccess();
$grListId = $grDbAccess->getGrListId($userId);

if(empty($_REQUEST)) {
  if (isset($_SESSION)) {
  	if(isset($_SESSION['login_user'])) { 
	  	if(!empty($grListId)) {
		  	echo '<div class="container"><div class="row"><div class="one-half column" style="margin-top: 0%"><h4>Which Grocery List would you like to use?</h4>';
			  echo '<table>';
        foreach ($grListId as $grList) {
	       $name = $grList['grName'];
	       $listId = $grList['grListId'];
	       $url = "grocerylist.php?grName=$name&grListId=$listId";
		      echo "<tr><p><td><a href=$url>$name</a></td>";
		      echo "<td><a href=shareList.php?grListId=$listId>share list</a></td></p></tr>";
        } 
        echo '</table></div></div></div>';
      }  else {
	      echo <<<EOT

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
  $grName = validator::testInput($_REQUEST['grName']);
  $_SESSION["grName"] = $grName;
} else {
  $grListId = (int)validator::testInput($_SESSION['grListId']);
  $grName = validator::testInput($_SESSION['grName']);
}

$items = $grDbAccess->getGrListItems($grListId);
$count = 0;


echo '<div class="container"><div class="row"><div class="one-half column" style="margin-top: 0%"><h2>Items on grocery list - ' . $grName . '</h2></br><table>';

foreach ($items as $item) {
	$count = $count + 1;
  $itemDesc = $grDbAccess->getItem($item["itemId"]);
  echo '<tr><td><h6>' . $itemDesc["item"] . '</h6></td><td><h6> ' . $item["qty"] . ' ' . $itemDesc["measure"] . '</h6></td><td> <h6><a href=removeItem.php?itemId=' . $itemDesc["itemId"] . '> remove</a></h6></td>';
}

echo '</table></div></div></div>';

if (empty($_REQUEST["item"])) {
echo <<<EOT
  
  <div class="container"><div class="row"><div class="one-half column" style="margin-top: 0%">
  <form action="addItem.php" method="post">
    <h2>Add item to list: </h2></br>
    <h5>item name: <input type="text" name="item"></input></br>
    quantity of items: <input type="number" name="qty"></input></br>
    measure: <input type="text" name="measure"></input></br>
    <br></br></h5>
    <input type="submit" value="Add"></input>
  </form>
  </div></div></div>

EOT;
}